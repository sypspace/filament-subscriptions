<?php

namespace SYPSpace\FilamentSubscriptions;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use SYPSpace\FilamentSubscriptions\Services\FilamentSubscriptionServices;

class FilamentSubscriptionsServiceProvider extends ServiceProvider
{
   public function register(): void
   {
      //Register generate command
      $this->commands([
         \SYPSpace\FilamentSubscriptions\Console\FilamentSubscriptionInstall::class,
      ]);

      //Register Config file
      $this->mergeConfigFrom(__DIR__ . '/../config/filament-subscriptions.php', 'filament-subscriptions');

      //Publish Config
      $this->publishes([
         __DIR__ . '/../config/filament-subscriptions.php' => config_path('filament-subscriptions.php'),
      ], 'filament-subscriptions-config');

      //Register Migrations
      $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

      //Publish Migrations
      $this->publishes([
         __DIR__ . '/../database/migrations' => database_path('migrations'),
      ], 'filament-subscriptions-migrations');
      //Register views
      $this->loadViewsFrom(__DIR__ . '/../resources/views', 'filament-subscriptions');

      //Publish Views
      $this->publishes([
         __DIR__ . '/../resources/views' => resource_path('views/vendor/filament-subscriptions'),
      ], 'filament-subscriptions-views');

      //Register Langs
      $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'filament-subscriptions');

      //Publish Lang
      $this->publishes([
         __DIR__ . '/../resources/lang' => base_path('lang/vendor/filament-subscriptions'),
      ], 'filament-subscriptions-lang');

      $this->app->bind('filament-subscriptions', function () {
         return new FilamentSubscriptionServices();
      });
   }

   public function boot(): void {}
}
