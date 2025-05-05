<?php

namespace App\Filament\Pages;

use App\Filament\Resources\UserResource;
use Jeffgreco13\FilamentBreezy\Pages\MyProfilePage;

class AccountSettings extends MyProfilePage
{
    public static function getNavigationGroup(): ?string
    {
        return null;
    }

    public static function getNavigationLabel(): string
    {
        return __('My Profile');
    }

    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->can('page_AccountSettings');
    }
}

