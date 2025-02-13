<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RuntimeException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->validateObfuscatorKey();
    }

    private function validateObfuscatorKey(): void
    {
        $key = config('obfuscator.key') ?? env('OBFUSCATOR_KEY');
        
        if (empty($key)) {
            throw new RuntimeException('OBFUSCATOR_KEY must be set in .env file');
        }

        if (strlen($key) < 32) {
            $key = str_pad($key, 32, $key); // Pad the key if it's too short
            config(['obfuscator.key' => $key]);
        }
    }
}
