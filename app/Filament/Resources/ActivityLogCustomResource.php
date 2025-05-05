<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogCustomResource\Pages;
use App\Filament\Resources\ActivityLogCustomResource\RelationManagers;
use App\Models\ActivityLogCustom;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Rmsramos\Activitylog\Resources\ActivityLogResource;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class ActivityLogCustomResource extends ActivityLogResource implements HasShieldPermissions
{
    public static function getPermissionPrefixes(): array
    {
        return [
            'viewAny',
            'view',
        ];
    }

    public static function getNavigationGroup(): string
    {
        return __('Users Managements');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivityLogCustoms::route('/'),
        ];
    }
}
