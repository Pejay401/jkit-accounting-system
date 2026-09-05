@php
    $companyName = config('filament-login.company_name', 'JKIT Accounting');
    $email = config('filament-login.contact_email', 'support@jkit.com');
    $phone = config('filament-login.contact_phone', '(+63) 9764618736');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us | {{ $companyName }}</title>
    <style>
        :root {
            --ink: #18212b;
            --muted: #65717d;
            --paper: #f7f8fa;
            --card: #ffffff;
            --line: #e5e8ec;
            --accent: #c77925;
            --accent-dark: #955719;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            color: var(--ink);
            background: var(--paper);
            font-family: "Instrument Sans", "Segoe UI", sans-serif;
        }

        a {
            color: inherit;
        }

        .about-page {
            min-height: 100vh;
        }

        .about-topbar {
            padding: 0.65rem 5vw;
            color: #fff;
            background: #28333d;
            font-size: 0.78rem;
        }

        .about-topbar-inner,
        .about-nav-inner,
        .about-wrap {
            width: min(1120px, 90vw);
            margin: 0 auto;
        }

        .about-topbar-inner {
            display: flex;
            justify-content: flex-end;
            gap: 1.25rem;
        }

        .about-topbar a {
            text-decoration: none;
            opacity: 0.88;
        }

        .about-topbar a:hover {
            opacity: 1;
        }

        .about-nav {
            background: #fff;
            border-bottom: 1px solid var(--line);
        }

        .about-nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 4.5rem;
        }

        .about-brand {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            color: var(--ink);
            font-weight: 700;
            text-decoration: none;
        }

        .about-brand img {
            width: 3rem;
            height: 3rem;
            object-fit: contain;
        }

        .about-links {
            display: flex;
            gap: 1.5rem;
            font-size: 0.9rem;
        }

        .about-links a {
            text-decoration: none;
            color: var(--muted);
        }

        .about-links a:hover,
        .about-links .active {
            color: var(--accent-dark);
        }

        .about-hero {
            padding: 6rem 0 5rem;
            background: linear-gradient(120deg, #fff 0%, #fff 54%, #f3e7d7 100%);
        }

        .about-hero-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 4rem;
            align-items: center;
        }

        .about-eyebrow {
            margin: 0 0 1rem;
            color: var(--accent-dark);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        h1,
        h2,
        p {
            margin-top: 0;
        }

        h1 {
            max-width: 700px;
            margin-bottom: 1.3rem;
            font-size: clamp(2.6rem, 6vw, 5rem);
            line-height: 1.02;
            letter-spacing: -0.045em;
        }

        .about-lead {
            max-width: 600px;
            color: var(--muted);
            font-size: 1.08rem;
            line-height: 1.75;
        }

        .about-hero-card {
            padding: 2rem;
            border: 1px solid rgba(199, 121, 37, 0.25);
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.75);
            box-shadow: 0 18px 40px rgba(34, 42, 50, 0.08);
        }

        .about-hero-card strong {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .about-hero-card p {
            margin-bottom: 0;
            color: var(--muted);
            line-height: 1.65;
        }

        .about-section {
            padding: 5rem 0;
        }

        .about-section-heading {
            max-width: 650px;
            margin-bottom: 2.2rem;
        }

        .about-section-heading h2 {
            margin-bottom: 0.7rem;
            font-size: 2rem;
            letter-spacing: -0.03em;
        }

        .about-section-heading p {
            color: var(--muted);
            line-height: 1.7;
        }

        .about-services {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .about-service {
            padding: 1.5rem;
            border: 1px solid var(--line);
            border-radius: 0.8rem;
            background: var(--card);
        }

        .about-service-number {
            color: var(--accent);
            font-size: 0.78rem;
            font-weight: 700;
        }

        .about-service h3 {
            margin: 1.3rem 0 0.6rem;
            font-size: 1.05rem;
        }

        .about-service p {
            margin-bottom: 0;
            color: var(--muted);
            font-size: 0.9rem;
            line-height: 1.65;
        }

        .about-contact {
            padding: 3rem 0;
            color: #fff;
            background: #28333d;
        }

        .about-contact-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
        }

        .about-contact h2 {
            margin-bottom: 0.5rem;
            font-size: 1.65rem;
        }

        .about-contact p {
            margin-bottom: 0;
            color: rgba(255, 255, 255, 0.72);
        }

        .about-contact-links {
            display: grid;
            gap: 0.5rem;
            text-align: right;
        }

        .about-contact-links a {
            color: #f5d7ad;
            text-decoration: none;
        }

        @media (max-width: 720px) {

            .about-topbar-inner,
            .about-nav-inner {
                width: min(92vw, 1120px);
            }

            .about-topbar-inner {
                justify-content: flex-start;
                flex-wrap: wrap;
            }

            .about-nav-inner {
                align-items: flex-start;
                flex-direction: column;
                gap: 0.8rem;
                padding: 1rem 0;
            }

            .about-links {
                gap: 1rem;
                flex-wrap: wrap;
            }

            .about-hero {
                padding: 4rem 0;
            }

            .about-hero-grid,
            .about-services {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .about-section {
                padding: 3.5rem 0;
            }

            .about-contact-inner {
                align-items: flex-start;
                flex-direction: column;
            }

            .about-contact-links {
                text-align: left;
            }
        }
    </style>
</head>

<body>
    <div class="about-page">
        <div class="about-topbar">
            <div class="about-topbar-inner">
                <a href="mailto:{{ $email }}">{{ $email }}</a>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}">{{ $phone }}</a>
            </div>
        </div>

        <nav class="about-nav">
            <div class="about-nav-inner">
                <a class="about-brand" href="/admin/login">
                    <img src="{{ asset(config('filament-login.logo')) }}" alt="{{ $companyName }}">
                    <span>{{ $companyName }}</span>
                </a>
                <div class="about-links">
                    <a href="/">Home</a>
                    <a class="active" href="/about">About Us</a>
                    <a href="/admin/login">Login</a>
                </div>
            </div>
        </nav>

        <main>
            <section class="about-hero">
                <div class="about-wrap about-hero-grid">
                    <div>
                        <p class="about-eyebrow">J&amp;K IT Solution</p>
                        <h1>Technology that keeps your business moving.</h1>
                        <p class="about-lead">
                            {{ $companyName }} helps businesses manage their technology, accounting operations, and
                            day-to-day digital work with practical, dependable support.
                        </p>
                    </div>
                    <div class="about-hero-card">
                        <strong>Built for clearer business operations</strong>
                        <p>From organized sales records to reliable IT support, we make essential work easier to track,
                            understand, and act on.</p>
                    </div>
                </div>
            </section>

            <section class="about-section">
                <div class="about-wrap">
                    <div class="about-section-heading">
                        <p class="about-eyebrow">What we do</p>
                        <h2>Practical support for growing teams.</h2>
                        <p>Our services combine technical know-how with a clear understanding of the work businesses
                            need to get done.</p>
                    </div>
                    <div class="about-services">
                        <article class="about-service">
                            <span class="about-service-number">01</span>
                            <h3>IT support</h3>
                            <p>Responsive technical assistance and maintenance that keeps your team productive.</p>
                        </article>
                        <article class="about-service">
                            <span class="about-service-number">02</span>
                            <h3>Network setup</h3>
                            <p>Reliable connectivity and small-office network solutions designed around your needs.</p>
                        </article>
                        <article class="about-service">
                            <span class="about-service-number">03</span>
                            <h3>Business systems</h3>
                            <p>Clearer records and organized workflows for sales, accounting, and everyday operations.
                            </p>
                        </article>
                    </div>
                </div>
            </section>

            <section class="about-contact">
                <div class="about-wrap about-contact-inner">
                    <div>
                        <h2>Let’s make your systems work better.</h2>
                        <p>Talk with the J&amp;K IT Solution team about your business needs.</p>
                    </div>
                    <div class="about-contact-links">
                        <a href="mailto:{{ $email }}">{{ $email }}</a>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}">{{ $phone }}</a>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>