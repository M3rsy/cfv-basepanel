<x-filament-breezy::grid-section md=2 :title="__('filament-breezy::default.profile.browser_sessions.title')" :description="__('filament-breezy::default.profile.browser_sessions.description')">
    <x-filament::card>
        <x-filament-panels::form>
            {{ $this->form }}
        </x-filament-panels::form>

        <x-filament-actions::modals />
    </x-filament::card>
</x-filament-breezy::grid-section>
