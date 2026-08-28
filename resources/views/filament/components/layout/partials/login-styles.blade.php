<style>
    /* ── Reset Filament defaults on login page ── */
    .fi-body.fi-panel-admin:has(.login-page) {
        background: #fff !important;
    }

    .login-page {
        min-height: 100dvh;
        display: flex;
        flex-direction: column;
    }

    .login-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .login-icon-sm {
        width: 1rem;
        height: 1rem;
        flex-shrink: 0;
    }

    /* ── Top contact bar ── */
    .login-topbar {
        background: #374151;
        color: #fff;
        font-size: 0.8125rem;
        position: relative;
        z-index: 30;
    }

    .login-topbar-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 2.25rem;
    }

    .login-topbar-contacts {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .login-topbar-item {
        display: flex;
        align-items: center;
        gap: 0.375rem;
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: color 0.15s;
    }

    .login-topbar-item:hover {
        color: #fff;
    }

    .login-topbar-social {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .login-topbar-social a {
        color: rgba(255, 255, 255, 0.85);
        transition: color 0.15s;
        display: flex;
    }

    .login-topbar-social a:hover {
        color: #fff;
    }

    /* ── Main navbar ── */
    .login-navbar {
        background: #fff;
        border-bottom: 1px solid #e5e7eb;
        position: relative;
        z-index: 25;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
    }

    .login-navbar-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 4rem;
    }

    .login-brand {
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .login-brand-logo {
        height: 3rem;
        width: auto;
        object-fit: contain;
    }

    .login-brand-text {
        font-size: 1.25rem;
        font-weight: 700;
        color: #374151;
        letter-spacing: -0.02em;
    }

    .login-nav-links {
        display: flex;
        align-items: center;
        gap: 2rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .login-nav-link {
        font-size: 0.9375rem;
        font-weight: 500;
        color: #374151;
        text-decoration: none;
        transition: color 0.15s;
    }

    .login-nav-link:hover,
    .login-nav-link-active {
        color: #2563eb;
    }

    /* ── Hero / background area ── */
    .login-hero {
        flex: 1;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: calc(100dvh - 6.25rem);
    }

    .login-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg,
                rgba(0, 0, 0, 0.25) 0%,
                rgba(0, 0, 0, 0.4) 50%,
                rgba(0, 0, 0, 0.55) 100%);
    }

    .login-hero-content {
        position: relative;
        z-index: 2;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1.5rem;
    }

    /* ── Premium glass login card ── */
    .login-card {
        position: relative;
        width: 100%;
        max-width: 26rem;
        isolation: isolate;
        overflow: hidden;
        border-radius: 1rem;
        padding: 2.25rem 2rem 2.5rem;
        color: #fff;

        /* Frosted glass */
        background: rgba(255, 255, 255, 0.07);
        backdrop-filter: blur(28px) saturate(160%);
        -webkit-backdrop-filter: blur(28px) saturate(160%);

        /* Premium border + depth */
        border: 1px solid rgba(255, 255, 255, 0.22);
        box-shadow:
            0 8px 32px rgba(0, 0, 0, 0.28),
            0 2px 8px rgba(0, 0, 0, 0.12),
            inset 0 1px 0 rgba(255, 255, 255, 0.25),
            inset 0 -1px 0 rgba(255, 255, 255, 0.06);
    }

    /* Top shine highlight */
    .login-card::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: inherit;
        pointer-events: none;
        background: linear-gradient(145deg,
                rgba(255, 255, 255, 0.18) 0%,
                rgba(255, 255, 255, 0.04) 35%,
                transparent 60%);
        z-index: 0;
    }

    /* Subtle inner vignette for depth */
    .login-card::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: inherit;
        pointer-events: none;
        box-shadow: inset 0 0 60px rgba(0, 0, 0, 0.15);
        z-index: 0;
    }

    .login-card>* {
        position: relative;
        z-index: 1;
    }

    .login-card-logo {
        display: flex;
        justify-content: center;
        margin-bottom: 2rem;
    }

    .login-card-logo img {
        height: 4.5rem;
        width: auto;
        object-fit: contain;
        filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.3));
    }

    .login-card-logo-fallback {
        font-size: 1.125rem;
        font-weight: 700;
        color: #fff;
        letter-spacing: -0.02em;
        text-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
    }

    .login-card-branding {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
        margin: -1rem 0 1.75rem;
        text-align: center;
    }

    .login-card-branding strong {
        color: #fff;
        font-size: 1rem;
        font-weight: 700;
        letter-spacing: 0.01em;
    }

    .login-card-branding span {
        color: rgba(255, 255, 255, 0.78);
        font-size: 0.75rem;
        letter-spacing: 0.02em;
    }

    /* ── Filament form overrides inside card ── */
    .login-card .fi-simple-page {
        color: #fff;
        background: transparent !important;
    }

    .login-card .fi-simple-page-content {
        gap: 1.375rem;
    }

    .login-card .fi-fo-field-wrp-label span,
    .login-card .fi-fo-field-wrp-label {
        color: rgba(255, 255, 255, 0.92) !important;
        font-size: 0.8125rem !important;
        font-weight: 500 !important;
        letter-spacing: 0.01em;
    }

    .login-card .fi-input-wrp {
        background: rgba(255, 255, 255, 0.06) !important;
        border-color: rgba(255, 255, 255, 0.2) !important;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1) !important;
        border-radius: 0.5rem !important;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }

    .login-card .fi-input-wrp:focus-within {
        background: rgba(255, 255, 255, 0.1) !important;
        border-color: rgba(255, 255, 255, 0.45) !important;
        box-shadow:
            inset 0 1px 2px rgba(0, 0, 0, 0.08),
            0 0 0 3px rgba(255, 255, 255, 0.08) !important;
    }

    .login-card .fi-input {
        color: #fff !important;
        background: transparent !important;
        font-size: 0.9375rem !important;
    }

    .login-card .fi-input::placeholder {
        color: rgba(255, 255, 255, 0.38) !important;
    }

    /* Password reveal button */
    .login-card .fi-input-wrp suffix actions button,
    .login-card .fi-input-wrp .fi-icon-btn {
        color: rgba(255, 255, 255, 0.5) !important;
    }

    .login-card .fi-ac-btn-action {
        background: #405CD6 !important;
        background-image: none !important;
        color: #111827 !important;
    }

    .login-card .fi-ac-btn-action:hover {
        background: #405CD6 !important;
    }

    .login-card .fi-ac-actions {
        margin-top: 0.5rem;
    }

    .login-card .fi-ac-btn-action {
        width: 100%;
    }

    /* Strip all Filament default card chrome */
    .login-card .fi-simple-main,
    .login-card .fi-fo-field-wrp,
    .login-card form {
        background: transparent !important;
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
        ring: none !important;
        --tw-ring-shadow: none !important;
    }

    /* ── Mobile responsive ── */
    @media (max-width: 640px) {
        .login-topbar-contacts {
            gap: 0.75rem;
        }

        .login-topbar-item span {
            display: none;
        }

        .login-nav-links {
            gap: 1rem;
        }

        .login-nav-link {
            font-size: 0.8125rem;
        }

        .login-brand-logo {
            height: 2rem;
        }

        .login-card {
            padding: 1.75rem 1.5rem 2rem;
            border-radius: 0.875rem;
        }
    }
</style>