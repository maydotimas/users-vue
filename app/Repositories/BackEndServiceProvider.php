<?php


namespace App\Repositories;


use Illuminate\Support\ServiceProvider;

class BackEndServiceProvider extends ServiceProvider
{
    public function register(){
        $this->app->bind(
            'App\Repositories\PostRepositoryInterface',
            'App\Repositories\PostRepository'
        );
    }
}