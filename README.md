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

## 📦 Skenario Instalasi

### 🎨 **Skenario 1: UI + Authentication (Lengkap)**

Instalasi lengkap dari awal:

```bash
# Install UI package
composer require agustra/adminlte-v4-package

# Install authentication package
composer require agustra/adminlte-auth-package

# Publish assets UI
php artisan adminlte:publish-assets

# Install authentication system
php artisan adminlte:install-auth

# Jalankan migration
php artisan migrate
```

### 🔧 **Skenario 2: Tambah Authentication ke UI yang Sudah Ada**

Jika sudah ada `agustra/adminlte-v4-package`:

```bash
# Install authentication package
composer require agustra/adminlte-auth-package

# Install authentication system
php artisan adminlte:install-auth

# Jalankan migration
php artisan migrate
```

### 🔐 **Skenario 3: Hanya Authentication (Custom UI)**

Jika ingin menggunakan authentication dengan UI custom:

```bash
# Install authentication package (akan auto-install UI dependency)
composer require agustra/adminlte-auth-package

# Install authentication tanpa UI
php artisan adminlte:install-auth --no-ui

# Jalankan migration
php artisan migrate
```

## ⚙️ Konfigurasi (Opsional)

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