# AdminLTE Authentication Package

Authentication system for AdminLTE v4 with Laravel integration.

## Features

- ✅ Login/Logout with AdminLTE styling
- ✅ User Registration (optional)
- ✅ Forgot Password & Reset
- ✅ User Profile Management
- ✅ Role & Permission (Spatie Permission)
- ✅ Avatar Upload
- ✅ Remember Me functionality
- ✅ Seamless AdminLTE integration

## Installation

### 1. Install Package
```bash
composer require agustra/adminlte-auth-package
```

### 2. Install Authentication
```bash
php artisan adminlte:install-auth
```

### 3. Configure (Optional)
```bash
php artisan vendor:publish --tag=adminlte-auth-config
```

## Usage

### Routes
- `/login` - Login page
- `/register` - Registration page (if enabled)
- `/forgot-password` - Password reset request
- `/profile` - User profile management

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
- Avatar support
- Phone & address fields
- Spatie Permission integration

```php
use AgusUsk\AdminLteAuth\Models\User;

$user = User::find(1);
$user->assignRole('admin');
$avatarUrl = $user->avatar_url;
```

## Requirements

- PHP ^8.2
- Laravel ^11.0
- agustra/adminlte-v4-package

## License

MIT License