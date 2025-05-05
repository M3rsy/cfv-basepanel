<?php

namespace App\Filament\Resources\ActivityLogCustomResource\Pages;

use App\Filament\Resources\ActivityLogCustomResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActivityLogCustoms extends ListRecords
{
    protected static string $resource = ActivityLogCustomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
