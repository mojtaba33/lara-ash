<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('reCaptcha',function (){
            return '<script src="https://www.google.com/recaptcha/api.js?render={{config(\'services.captcha.site_key\')}}"></script>
                    <script>
                        grecaptcha.ready(function() {
                            grecaptcha.execute("{{config(\'services.captcha.site_key\')}}", {action: \'submit\'}).then(function(token) {
                                // Add your logic to submit to your backend server here.
                                var captcha = document.getElementById(\'re_captcha\');
                                captcha.value = token;
                            });
                        });
                    </script>
                    <input type="hidden" name="re_captcha" id="re_captcha">';
        });
    }
}
