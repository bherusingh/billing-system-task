# Laravel Billing System

A comprehensive billing system built with Laravel that allows authenticated users to create, manage, and send invoices with PDF generation and queued email functionality.

## Features

- **Authentication & User Management**: Laravel's built-in authentication system
- **Invoice CRUD Operations**: Create, Read, Update, Delete invoices
- **PDF Generation**: Generate professional PDF invoices using DomPDF
- **Queued Email Sending**: Send invoices via email with PDF attachments using Laravel's queue system
- **User Context**: Pre-filled biller information from authenticated user
- **Responsive UI**: Modern, responsive interface built with Tailwind CSS
- **Comprehensive Testing**: PHPUnit tests covering all major functionality

## Requirements

- PHP 8.2+
- Laravel 12.0+
- MySQL/PostgreSQL/SQLite
- Composer
- Node.js (for frontend assets)

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd billing-system
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   Update your `.env` file with your database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=billing_system
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Configure queue**
   Set the queue connection to database in your `.env`:
   ```
   QUEUE_CONNECTION=database
   ```

7. **Run migrations**
   ```bash
   php artisan migrate
   ```

8. **Create queue table**
   ```bash
   php artisan queue:table
   php artisan migrate
   ```

9. **Seed the database**
   ```bash
   php artisan db:seed
   ```

10. **Build frontend assets**
    ```bash
    npm run build
    ```

## Usage

### Starting the Application

1. **Start the Laravel development server**
   ```bash
   php artisan serve
   ```

2. **Start the queue worker** (in a separate terminal)
   ```bash
   php artisan queue:work
   ```

3. **Access the application**
   Navigate to `http://localhost:8000`

### Default Login Credentials

After seeding the database, you can log in with:
- **Email**: `test@example.com`
- **Password**: `password`

### Creating Invoices

1. Log in to the application
2. Click "New Invoice" button
3. Fill in the client details (biller information is pre-filled)
4. Enter the amount and description
5. Click "Create Invoice"

### Managing Invoices

- **View All Invoices**: Dashboard shows all your invoices
- **Edit Invoice**: Click the edit icon to modify invoice details
- **Delete Invoice**: Click the delete icon to remove an invoice
- **View Invoice**: Click the view icon to see invoice details

### PDF Generation

1. Navigate to any invoice detail page
2. Click "Download PDF" button
3. The PDF will be generated and downloaded automatically

### Sending Invoices via Email

1. Navigate to any invoice detail page
2. Enter the recipient email address (defaults to client email)
3. Click "Send Invoice" button
4. The invoice will be queued for sending with PDF attachment

## Testing

### Running Tests

```bash
php artisan test
```

### Test Coverage

The test suite includes:

- **Invoice CRUD Operations**: Create, read, update, delete functionality
- **Authentication**: User access control and authorization
- **PDF Generation**: Proper headers and content type verification
- **Email Functionality**: Job dispatching and email sending with attachments
- **Validation**: Form validation and error handling
- **User Isolation**: Users can only access their own invoices

### Key Test Files

- `tests/Feature/InvoiceTest.php` - Main feature tests
- `app/Http/Requests/StoreInvoiceRequest.php` - Form validation
- `app/Policies/InvoicePolicy.php` - Authorization policies

## Architecture

### Models

- **User**: Laravel's default user model with invoice relationship
- **Invoice**: Invoice model with user relationship and fillable fields

### Controllers

- **InvoiceController**: Handles all invoice CRUD operations, PDF generation, and email sending

### Jobs

- **SendInvoiceJob**: Queued job for sending invoices via email with PDF attachments

### Mail

- **InvoiceMailable**: Mailable class for sending invoice emails with PDF attachments

### Policies

- **InvoicePolicy**: Authorization policies ensuring users can only access their own invoices

### Views

- **invoices/index.blade.php**: Invoice listing page
- **invoices/create.blade.php**: Invoice creation form
- **invoices/edit.blade.php**: Invoice editing form
- **invoices/show.blade.php**: Invoice detail page with actions
- **invoices/pdf.blade.php**: PDF template for invoice generation
- **emails/invoice.blade.php**: Email template for invoice emails

## Configuration

### Queue Configuration

The system uses database queues for email sending. Ensure your `.env` has:

```
QUEUE_CONNECTION=database
```

### PDF Configuration

The system uses `barryvdh/laravel-dompdf` for PDF generation. Configuration is handled automatically.

### Email Configuration

Configure your email settings in `.env`:

```
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

## Database Schema

### Users Table
- `id` (primary key)
- `name`
- `email`
- `password`
- `email_verified_at`
- `remember_token`
- `created_at`
- `updated_at`

### Invoices Table
- `id` (primary key)
- `user_id` (foreign key to users)
- `client_name`
- `client_email`
- `amount` (decimal)
- `description`
- `created_at`
- `updated_at`

### Jobs Table
- `id` (primary key)
- `queue`
- `payload`
- `attempts`
- `reserved_at`
- `available_at`
- `created_at`

## Security Features

- **Authentication**: Laravel's built-in authentication system
- **Authorization**: Policy-based authorization for invoice access
- **User Isolation**: Users can only access their own invoices
- **Form Validation**: Comprehensive validation for all inputs
- **CSRF Protection**: Built-in CSRF protection for all forms

## Performance Considerations

- **Queue System**: Email sending is queued to prevent blocking
- **Database Indexing**: Proper foreign key relationships
- **Pagination**: Invoice listing is paginated for better performance
- **PDF Caching**: PDFs are generated on-demand

## Troubleshooting

### Common Issues

1. **Queue not processing**
   - Ensure queue worker is running: `php artisan queue:work`
   - Check queue table exists: `php artisan queue:table`

2. **PDF not generating**
   - Check DomPDF is installed: `composer require barryvdh/laravel-dompdf`
   - Verify storage permissions

3. **Email not sending**
   - Check email configuration in `.env`
   - Verify queue worker is running
   - Check mail logs: `php artisan queue:failed`

4. **Authentication issues**
   - Clear cache: `php artisan config:clear`
   - Regenerate keys: `php artisan key:generate`

### Debug Commands

```bash
# Check failed jobs
php artisan queue:failed

# Retry failed jobs
php artisan queue:retry all

# Clear all caches
php artisan optimize:clear

# Check queue status
php artisan queue:work --once
```
