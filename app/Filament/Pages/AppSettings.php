<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use CWSPS154\AppSettings\Page\AppSettings as BaseAppSettings;

class AppSettings extends BaseAppSettings
{
    public static function getNavigationLabel(): string
    {
        return __('app.settings');
    }

    public function getTitle(): string
    {
        return __('app.settings');
    }


    public static function getNavigationGroup(): ?string
    {
        return __('settings');
    }

    public static function getNavigationSort(): ?int
    {
        return 100;
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
        return $user->can('page_AppSettings');
    }
}
