@php
    use Filament\Support\Enums\Width;

    $livewire ??= null;
    $renderHookScopes = isset($livewire) ? $livewire->getRenderHookScopes() : null;
    $maxContentWidth ??= (filament()->getSimplePageMaxContentWidth() ?? Width::Medium);

    if (is_string($maxContentWidth)) {
        $maxContentWidth = Width::tryFrom($maxContentWidth) ?? $maxContentWidth;
    }

    $config = config('filament-login');
    $backgroundImage = asset($config['background_image']);
    $logo = asset($config['logo']);
    $companyName = $config['company_name'];
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
    @include('filament.components.layout.partials.login-styles')

    <div class="login-page">
        @include('filament.components.layout.partials.login-navbar')

        <div class="login-hero" style="background-image: url('{{ $backgroundImage }}');">
            <div class="login-hero-overlay"></div>

            <div class="login-hero-content">
                <main id="fi-main-content" tabindex="-1" class="login-card">
                    <div class="login-card-logo">
                        @if (file_exists(public_path($config['logo'])))
                            <img src="{{ $logo }}" alt="{{ $companyName }}">
                        @else
                            <div class="login-card-logo-fallback">{{ $companyName }}</div>
                        @endif
                    </div>

                    <div class="login-card-branding">
                        <strong>J&amp;K IT Solution</strong>
                        <span>Accounting management portal</span>
                    </div>

                    {{ $slot }}
                </main>
            </div>
        </div>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIMPLE_LAYOUT_END, scopes: $renderHookScopes) }}
    </div>
</x-filament-panels::layout.base>