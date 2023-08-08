<?php

namespace App\Providers;

use App\Rules\SingleByteRule;
use Illuminate\Support\ServiceProvider;

class CustomValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app['validator']->extend('single_byte_rule', function ($attribute, $value, $parameters, $validator) {
            $rule = new SingleByteRule();
            return $rule->passes($attribute, $value);
        });

        $this->app['validator']->replacer('single_byte_rule', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'Trường '.$attribute.' phải chỉ chứa ký tự có kích thước 1 byte.');
        });
    }
}
