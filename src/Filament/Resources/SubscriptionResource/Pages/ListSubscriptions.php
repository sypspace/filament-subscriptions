<?php

namespace SYPSpace\FilamentSubscriptions\Filament\Resources\SubscriptionResource\Pages;

use Filament\Resources\Pages\ManageRecords;
use SYPSpace\FilamentSubscriptions\Filament\Resources\SubscriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubscriptions extends ManageRecords
{
    protected static string $resource = SubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
