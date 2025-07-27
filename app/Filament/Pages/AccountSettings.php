<?php

namespace App\Filament\Pages;

use App\Filament\Resources\UserResource;
use Jeffgreco13\FilamentBreezy\Pages\MyProfilePage;

class
AccountSettings extends MyProfilePage
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
        if (! auth()->check()) {
            return false;
        }

        $user = auth()->user();

        // Si es super_admin siempre tiene acceso
        if ($user->hasRole('super_admin')) {
            return true;
        }

        // Para el resto de roles se aplica el permiso normal
        return $user->can('page_AccountSettings');
    }
}

