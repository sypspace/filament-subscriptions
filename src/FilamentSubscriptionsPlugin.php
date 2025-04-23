<?php

namespace SYPSpace\FilamentSubscriptions;

use Filament\Navigation\MenuItem;
use Nwidart\Modules\Module;
use SYPSpace\FilamentSubscriptions\Filament\Pages\Billing;
use SYPSpace\FilamentSubscriptions\Filament\Resources\PlanResource;
use SYPSpace\FilamentSubscriptions\Filament\Resources\SubscriptionResource;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class FilamentSubscriptionsPlugin implements Plugin
{
    public bool $showUserMenu = true;
    public bool $withoutResources = false;
    private bool $isActive = true;

    public function getId(): string
    {
        return 'filament-subscriptions';
    }

    public function isActive(bool $isActive = false): static
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function showUserMenu(bool $showUserMenu): static
    {
        $this->showUserMenu = $showUserMenu;
        return $this;
    }

    public function withoutResources(bool $withoutResources = true): static
    {
        $this->withoutResources = $withoutResources;
        return $this;
    }

    public function register(Panel $panel): void
    {
        // if (class_exists(Module::class) && \Nwidart\Modules\Facades\Module::find('FilamentSubscriptions')?->isEnabled()) {
        //     $this->isActive = true;
        // } else {
        //     $this->isActive = true;
        // }

        if ($this->isActive) {
            $panel
                ->pages([
                    Billing::class
                ]);
        }

        if (!$this->withoutResources) {
            $panel
                ->resources([
                    PlanResource::class,
                    SubscriptionResource::class,
                ]);
        }
    }

    public function boot(Panel $panel): void
    {
        if ($this->isActive) {
            if ($this->showUserMenu && !filament()->hasTenancy()) {
                $panel->userMenuItems([
                    MenuItem::make()
                        ->label(trans('filament-subscriptions::messages.menu'))
                        ->icon('heroicon-s-credit-card')
                        ->url(route('filament.' . $panel->getId() . '.tenant.billing'))
                ]);
            }
        }
    }

    public static function make(): static
    {
        return new static();
    }
}
