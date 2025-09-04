# AdminLTE Authentication Package

Authentication system for AdminLTE v4 with Laravel integration.

## Features

- ✅ Login/Logout with AdminLTE v4 styling
- ✅ User Registration (configurable)
- ✅ Forgot Password & Reset
- ✅ User Profile Management
- ✅ Role & Permission (Spatie Permission)
- ✅ Remember Me functionality
- ✅ Responsive AdminLTE v4 design
- ✅ CSRF Protection
- ✅ Session Management

## 📦 Installation

### Quick Install (Recommended)

```bash
# Install both UI and Auth packages
composer require agustra/adminlte-v4-package agustra/adminlte-auth-package

# Publish AdminLTE assets
php artisan adminlte:publish-assets

# Install authentication system
php artisan adminlte:install-auth

# Run migrations
php artisan migrate
```

### Add Auth to Existing AdminLTE UI

If you already have `agustra/adminlte-v4-package`:

```bash
# Install authentication package
composer require agustra/adminlte-auth-package

# Install authentication system
php artisan adminlte:install-auth

# Run migrations
php artisan migrate
```

## ⚙️ Konfigurasi (Opsional)

```bash
php artisan vendor:publish --tag=adminlte-auth-config
```

## Usage

### Available Routes
- `/login` - Login page
- `/register` - Registration page (if enabled)
- `/forgot-password` - Password reset request
- `/reset-password/{token}` - Password reset form
- `/profile` - User profile management
- `/logout` - Logout (POST)
- `/dashboard` - Protected dashboard (requires auth)

### Configuration

Edit `config/adminlte-auth.php`:

```php
return [
    'enable_registration' => true,
    'enable_password_reset' => true,
    'enable_remember_me' => true,
    
    'redirects' => [
        'after_login' => '/dashboard',
        'after_logout' => '/login',
    ],
];
```

### Protecting Routes

```php
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
```

### User Model

The package provides an extended User model with:
- Spatie Permission integration
- Standard Laravel authentication
- Profile management

```php
use AgusUsk\AdminLteAuth\Models\User;

$user = User::find(1);
$user->assignRole('admin');
$user->givePermissionTo('edit posts');
```

## Requirements

- PHP ^8.2
- Laravel ^12.0
- agustra/adminlte-v4-package ^1.0
- spatie/laravel-permission ^6.0

## License

MIT License