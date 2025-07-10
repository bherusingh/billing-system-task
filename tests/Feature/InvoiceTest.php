<?php

namespace Tests\Feature;

use App\Jobs\SendInvoiceJob;
use App\Mail\InvoiceMailable;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_invoice_can_be_created()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $response = $this->post(route('invoices.store'), [
            'client_name' => 'Test Client',
            'client_email' => 'client@test.com',
            'amount' => 100.50,
            'description' => 'Test service description'
        ]);
        
        $response->assertRedirect(route('invoices.index'));
        $this->assertDatabaseHas('invoices', [
            'user_id' => $user->id,
            'client_name' => 'Test Client',
            'client_email' => 'client@test.com',
            'amount' => 100.50,
            'description' => 'Test service description'
        ]);
    }

    public function test_invoice_creation_requires_authentication()
    {
        $response = $this->post(route('invoices.store'), [
            'client_name' => 'Test Client',
            'client_email' => 'client@test.com',
            'amount' => 100,
            'description' => 'Test service'
        ]);
        
        $response->assertRedirect('/login');
    }

    public function test_invoice_validation_works()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $response = $this->post(route('invoices.store'), [
            'client_name' => '',
            'client_email' => 'invalid-email',
            'amount' => 'not-a-number',
            'description' => ''
        ]);
        
        $response->assertSessionHasErrors(['client_name', 'client_email', 'amount', 'description']);
    }

    public function test_invoice_can_be_updated()
    {
        $user = User::factory()->create();
        $invoice = Invoice::factory()->for($user)->create();
        $this->actingAs($user);
        
        $response = $this->put(route('invoices.update', $invoice), [
            'client_name' => 'Updated Client',
            'client_email' => 'updated@test.com',
            'amount' => 200.00,
            'description' => 'Updated description'
        ]);
        
        $response->assertRedirect(route('invoices.index'));
        $this->assertDatabaseHas('invoices', [
            'id' => $invoice->id,
            'client_name' => 'Updated Client',
            'client_email' => 'updated@test.com',
            'amount' => 200.00,
            'description' => 'Updated description'
        ]);
    }

    public function test_invoice_can_be_deleted()
    {
        $user = User::factory()->create();
        $invoice = Invoice::factory()->for($user)->create();
        $this->actingAs($user);
        
        $response = $this->delete(route('invoices.destroy', $invoice));
        
        $response->assertRedirect(route('invoices.index'));
        $this->assertDatabaseMissing('invoices', ['id' => $invoice->id]);
    }

    public function test_user_cannot_access_other_users_invoices()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $invoice = Invoice::factory()->for($user1)->create();
        $this->actingAs($user2);
        
        $response = $this->get(route('invoices.show', $invoice));
        $response->assertForbidden();
    }

    public function test_pdf_download_returns_correct_headers()
    {
        $invoice = Invoice::factory()->for(User::factory())->create();
        $this->actingAs($invoice->user);

        $response = $this->get(route('invoices.pdf', $invoice));
        
        $response->assertHeader('content-type', 'application/pdf');
        $response->assertHeader('content-disposition', 'attachment; filename=invoice_' . $invoice->id . '.pdf');
    }

    public function test_send_invoice_dispatches_job()
    {
        Bus::fake();
        $invoice = Invoice::factory()->for(User::factory())->create();
        $this->actingAs($invoice->user);

        $response = $this->post(route('invoices.send', $invoice), [
            'email' => 'client@example.com'
        ]);
        
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Invoice sent to queue successfully!');
        Bus::assertDispatched(SendInvoiceJob::class);
    }

    public function test_send_invoice_job_creates_email_with_attachment()
    {
        Mail::fake();
        $invoice = Invoice::factory()->for(User::factory())->create();
        
        $job = new SendInvoiceJob($invoice, 'test@example.com');
        $job->handle();
        
        Mail::assertSent(InvoiceMailable::class, function ($mail) use ($invoice) {
            return $mail->hasTo('test@example.com') && 
                   $mail->invoice->id === $invoice->id;
        });
    }

    public function test_send_invoice_validation_works()
    {
        $invoice = Invoice::factory()->for(User::factory())->create();
        $this->actingAs($invoice->user);

        $response = $this->post(route('invoices.send', $invoice), [
            'email' => 'invalid-email'
        ]);
        
        $response->assertSessionHasErrors(['email']);
    }

    public function test_invoice_list_shows_only_user_invoices()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        
        $invoice1 = Invoice::factory()->for($user1)->create();
        $invoice2 = Invoice::factory()->for($user2)->create();
        
        $this->actingAs($user1);
        $response = $this->get(route('invoices.index'));
        
        $response->assertSee($invoice1->client_name);
        $response->assertDontSee($invoice2->client_name);
    }

    public function test_create_form_prefills_biller_information()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ]);
        $this->actingAs($user);
        
        $response = $this->get(route('invoices.create'));
        
        $response->assertSee('John Doe');
        $response->assertSee('john@example.com');
    }
}
