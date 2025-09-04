<?php

namespace AgusUsk\AdminLteAuth\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallAuthCommand extends Command
{
    protected $signature = 'adminlte:install-auth {--force : Overwrite existing files}';
    protected $description = 'Install AdminLTE authentication system';

    public function handle()
    {
        $this->info('Installing AdminLTE Authentication...');

        // Publish config
        $this->call('vendor:publish', [
            '--tag' => 'adminlte-auth-config',
            '--force' => $this->option('force')
        ]);

        // Run migrations
        if ($this->confirm('Do you want to run migrations?', true)) {
            $this->call('migrate');
        }

        // Install Spatie Permission
        if ($this->confirm('Do you want to install Spatie Permission?', true)) {
            $this->call('vendor:publish', [
                '--provider' => 'Spatie\Permission\PermissionServiceProvider'
            ]);
            $this->call('migrate');
        }

        // Update User model in config/auth.php
        $this->updateAuthConfig();

        // Create storage link for avatars
        if (!File::exists(public_path('storage'))) {
            $this->call('storage:link');
        }

        $this->info('✅ AdminLTE Authentication installed successfully!');
        $this->line('');
        $this->line('Next steps:');
        $this->line('1. Update your routes/web.php if needed');
        $this->line('2. Visit /login to test authentication');
        $this->line('3. Configure email settings for password reset');
    }

    protected function updateAuthConfig()
    {
        $authConfigPath = config_path('auth.php');
        
        if (File::exists($authConfigPath)) {
            $content = File::get($authConfigPath);
            
            // Update user model
            $content = str_replace(
                "'model' => App\\Models\\User::class,",
                "'model' => AgusUsk\\AdminLteAuth\\Models\\User::class,",
                $content
            );
            
            File::put($authConfigPath, $content);
            $this->info('Updated auth.php configuration');
        }
    }
}