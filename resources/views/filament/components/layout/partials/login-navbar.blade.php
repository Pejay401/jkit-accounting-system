@php
    $config = config('filament-login');
    $logo = asset($config['logo']);
    $companyName = $config['company_name'];
@endphp

{{-- Top contact bar --}}
<div class="login-topbar">
    <div class="login-container login-topbar-inner">
        <div class="login-topbar-contacts">
            <a href="mailto:{{ $config['contact_email'] }}" class="login-topbar-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="login-icon-sm">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>
                <span>{{ $config['contact_email'] }}</span>
            </a>
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $config['contact_phone']) }}" class="login-topbar-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="login-icon-sm">
                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                </svg>
                <span>{{ $config['contact_phone'] }}</span>
            </a>
        </div>

        <div class="login-topbar-social">
            @if (filled($config['social']['facebook'] ?? null))
                <a href="{{ $config['social']['facebook'] }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="login-icon-sm">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </a>
            @endif
            @if (filled($config['social']['linkedin'] ?? null))
                <a href="{{ $config['social']['linkedin'] }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="login-icon-sm">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                </a>
            @endif
            @if (filled($config['social']['youtube'] ?? null))
                <a href="{{ $config['social']['youtube'] }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="login-icon-sm">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                </a>
            @endif
        </div>
    </div>
</div>

{{-- Main navbar --}}
<nav class="login-navbar">
    <div class="login-container login-navbar-inner">
        <a href="#" class="login-brand">
            @if (file_exists(public_path($config['logo'])))
                <img src="{{ $logo }}" alt="{{ $companyName }}" class="login-brand-logo">
            @else
                <span class="login-brand-text">{{ $companyName }}</span>
            @endif
        </a>

        <ul class="login-nav-links">
            @foreach ($config['nav_links'] as $link)
                <li>
                    <a
                        href="{{ $link['url'] }}"
                        @class(['login-nav-link', 'login-nav-link-active' => $link['active'] ?? false])
                    >
                        {{ $link['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
