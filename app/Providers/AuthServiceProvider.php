<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        try {
            // TODO: Only for testing porpuses
            if (empty(env('PASSPORT_CLIENT_SECRET'))) {
                $this->setPassportClient();
            }
        } catch(\Illuminate\Database\QueryException $exception) {
            // nothing to do here
            // dd($exception->getMessage());
        } catch(Exception $exception) {
            // dd($exception->getMessage());
            // nothing to do here
        }
    }

    /**
     * This function is just for the testing purposes
     * So that the tester doesn't have to set passport client secret in the .env file manually.
     */
    public function setPassportClient(): void
    {
        $query = 'select * from oauth_clients where `personal_access_client` = ? and `password_client` = ?';
        $oauth_client = collect(DB::select($query, [0, 1]))->first();

        if ($oauth_client) {
            $this->app->config->set('services.passport.client_id', $oauth_client->id);
            $this->app->config->set('services.passport.client_secret', $oauth_client->secret);
        }
    }
}
