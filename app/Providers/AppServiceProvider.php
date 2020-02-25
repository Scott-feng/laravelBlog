<?php

namespace App\Providers;

use App\Models\Link;
use App\Models\User;
use App\Models\Reply;
use App\Models\Topic;
use App\Observers\LinkObserver;
use App\Observers\ReplyObserver;
use App\Observers\TopicObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use App\Services\EsEngine;
use Laravel\Scout\EngineManager;
use Elasticsearch\ClientBuilder as ElasticBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        resolve(EngineManager::class)->extend('es', function($app) {
            return new EsEngine(ElasticBuilder::create()
                ->setHosts(config('scout.elasticsearch.hosts'))
                ->build(),
                config('scout.elasticsearch.index')
            );

            //return new EsEngine();
        });

        Reply::observe(ReplyObserver::class);
        Topic::observe(TopicObserver::class);
        User::observe(UserObserver::class);
        Link::observe(LinkObserver::class);


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        if (app()->isLocal()) {
            $this->app->register('VIACreative\SudoSu\ServiceProvider');
        }

    }
}
