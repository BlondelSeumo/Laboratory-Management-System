<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       
       
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(\Schema::hasTable('settings'))
        {
            $mail=setting('emails');

            if(!empty($mail))
            {
                $config = array(
                    'driver' => 'smtp',
                    'host' => $mail['host'],
                    'port' => $mail['port'],
                    'from' => array('address' => $mail['from_address'], 'name' => $mail['from_name']),
                    'encryption' => $mail['encryption'],
                    'username' => $mail['username'],
                    'password' => $mail['password'],
                    'sendmail' => '/usr/sbin/sendmail -bs',
                    'pretend' => false
                );
                
                \Config::set('mail',$config);
            }
        }
    }
}
