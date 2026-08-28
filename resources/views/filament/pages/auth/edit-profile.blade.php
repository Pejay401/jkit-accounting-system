@php
    $user = $this->getUser();
    $avatarUrl = filled($user->avatar_url)
        ? url('storage/' . ltrim($user->avatar_url, '/'))
        : null;
    $initials = collect(preg_split('/\s+/', trim($user->name)))
        ->filter()
        ->map(fn($part) => strtoupper(substr($part, 0, 1)))
        ->take(2)
        ->implode('');
@endphp

<x-filament-panels::page>
    <style>
        .jk-profile-shell {
            --jk-ink: #17202a;
            --jk-muted: #68727d;
            --jk-line: #e7e9ec;
            --jk-paper: #ffffff;
            --jk-accent: #c77925;
            display: grid;
            grid-template-columns: minmax(230px, 0.72fr) minmax(0, 2fr);
            gap: 2rem;
            align-items: start;
        }

        .jk-profile-rail,
        .jk-profile-main {
            min-width: 0;
        }

        .jk-profile-rail {
            position: sticky;
            top: 1.5rem;
        }

        .jk-profile-card,
        .jk-activity-card {
            border: 1px solid var(--jk-line);
            border-radius: 18px;
            background: var(--jk-paper);
            box-shadow: 0 12px 30px rgba(23, 32, 42, 0.06);
        }

        .jk-profile-card {
            overflow: hidden;
            border-top: 3px solid var(--jk-accent);
        }

        .jk-profile-cover {
            height: 92px;
            background: linear-gradient(135deg, #f5d7ad 0%, #f7efe4 52%, #e7eef0 100%);
        }

        .jk-profile-card-body {
            padding: 0 1.4rem 1.4rem;
        }

        .jk-profile-kicker {
            margin-top: 1.15rem;
            color: var(--jk-accent);
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .jk-profile-avatar {
            display: flex;
            width: 92px;
            height: 92px;
            align-items: center;
            justify-content: center;
            margin-top: -46px;
            overflow: hidden;
            border: 5px solid var(--jk-paper);
            border-radius: 50%;
            background: var(--jk-accent);
            color: #fff;
            font-size: 1.55rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            box-shadow: 0 5px 14px rgba(23, 32, 42, 0.16);
        }

        .jk-profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .jk-profile-name {
            margin: 1rem 0 0.25rem;
            color: var(--jk-ink);
            font-size: 1.35rem;
            font-weight: 700;
            letter-spacing: -0.025em;
        }

        .jk-profile-email {
            overflow-wrap: anywhere;
            color: var(--jk-muted);
            font-size: 0.82rem;
        }

        .jk-profile-facts {
            display: grid;
            gap: 0.85rem;
            margin-top: 1.25rem;
            padding-top: 1.15rem;
            border-top: 1px solid var(--jk-line);
        }

        .jk-profile-fact {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            color: var(--jk-muted);
            font-size: 0.8rem;
        }

        .jk-profile-fact strong {
            color: var(--jk-ink);
            font-weight: 600;
            text-align: right;
        }

        .jk-activity-card {
            margin-top: 1.25rem;
            padding: 1.25rem;
        }

        .jk-card-heading {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            color: var(--jk-ink);
            font-size: 0.9rem;
            font-weight: 700;
        }

        .jk-card-heading-icon {
            display: grid;
            width: 2rem;
            height: 2rem;
            place-items: center;
            border-radius: 9px;
            background: #fff4e5;
            color: var(--jk-accent);
        }

        .jk-card-subtitle {
            margin: 0.2rem 0 0 2.7rem;
            color: var(--jk-muted);
            font-size: 0.75rem;
        }

        .jk-empty-activity {
            margin-top: 1.2rem;
            padding: 1.2rem 0.6rem 0.35rem;
            border-top: 1px dashed var(--jk-line);
            text-align: center;
        }

        .jk-empty-activity-icon {
            color: #b9c0c7;
        }

        .jk-empty-activity strong {
            display: block;
            margin-top: 0.6rem;
            color: var(--jk-ink);
            font-size: 0.82rem;
        }

        .jk-empty-activity p {
            margin: 0.3rem auto 0;
            max-width: 15rem;
            color: var(--jk-muted);
            font-size: 0.75rem;
            line-height: 1.55;
        }

        .jk-profile-main>.fi-sc-form,
        .jk-profile-main>form {
            min-width: 0;
        }

        .dark .jk-profile-shell {
            --jk-ink: #f5f7f9;
            --jk-muted: #9ba5b0;
            --jk-line: rgba(255, 255, 255, 0.11);
            --jk-paper: #18191c;
        }

        .dark .jk-profile-cover {
            background: linear-gradient(135deg, #553814 0%, #302a24 55%, #202a2d 100%);
        }

        .dark .jk-card-heading-icon {
            background: rgba(245, 158, 11, 0.12);
        }

        @media (max-width: 900px) {
            .jk-profile-shell {
                grid-template-columns: 1fr;
            }

            .jk-profile-rail {
                position: static;
                display: grid;
                grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
                gap: 1rem;
            }

            .jk-activity-card {
                margin-top: 0;
            }
        }

        @media (max-width: 600px) {
            .jk-profile-shell {
                gap: 1.25rem;
            }

            .jk-profile-rail {
                display: block;
            }

            .jk-activity-card {
                margin-top: 1.25rem;
            }
        }
    </style>

    <div class="jk-profile-shell">
        <aside class="jk-profile-rail">
            <section class="jk-profile-card">
                <div class="jk-profile-cover"></div>
                <div class="jk-profile-card-body">
                    <div class="jk-profile-avatar">
                        @if ($avatarUrl)
                            <img src="{{ $avatarUrl }}" alt="{{ $user->name }}">
                        @else
                            {{ $initials }}
                        @endif
                    </div>

                    <div class="jk-profile-kicker">Workspace account</div>
                    <h2 class="jk-profile-name">{{ $user->name }}</h2>
                    <div class="jk-profile-email">{{ $user->email }}</div>

                    <div class="jk-profile-facts">
                        <div class="jk-profile-fact">
                            <span>Account</span>
                            <strong>Administrator</strong>
                        </div>
                        <div class="jk-profile-fact">
                            <span>Member since</span>
                            <strong>{{ $user->created_at?->format('M Y') ?? 'Recently' }}</strong>
                        </div>
                    </div>
                </div>
            </section>

            <section class="jk-activity-card">
                <div class="jk-card-heading">
                    <span class="jk-card-heading-icon">
                        <x-filament::icon icon="heroicon-o-clock" style="width: 1rem; height: 1rem;" />
                    </span>
                    <span>Recent activity</span>
                </div>
                <div class="jk-card-subtitle">Your account timeline</div>

                <div class="jk-empty-activity">
                    <x-filament::icon icon="heroicon-o-inbox" class="jk-empty-activity-icon"
                        style="width: 2rem; height: 2rem;" />
                    <strong>No activity yet</strong>
                    <p>Updates and account actions will appear here when you get started.</p>
                </div>
            </section>
        </aside>

        <main class="jk-profile-main">
            {{ $this->content }}
        </main>
    </div>
</x-filament-panels::page>