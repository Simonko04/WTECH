<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KVETY - O nás</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-accent: #d63384;
        }

        .logo-placeholder {
            font-size: 1.8rem;
            font-weight: 900;
        }

        .about-logo {
            max-width: 12rem;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-white">

    <!-- HEADER -->
    <header class="border-bottom bg-white shadow-sm">
        <div class="container py-3">
            <div class="d-flex align-items-center">
                <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none me-auto">
                    <span class="logo-placeholder text-danger">LOGO</span>
                    <span class="ms-3 fw-bold fs-4 text-dark d-none d-sm-flex">kvetinarstvo.sk</span>
                </a>
                <form class="flex-grow-1 mx-4 d-none d-lg-flex">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
                    </div>
                </form>
                <div class="d-flex gap-4 align-items-center">
                    <a href="{{ url('/wishlist') }}" class="text-dark"><i class="bi bi-heart fs-3"></i></a>
                    @auth
                        <a href="{{ url('/profile') }}" class="text-dark"><i class="bi bi-person-circle fs-3"></i></a>
                    @else
                        <a href="{{ route('login') }}" class="text-dark"><i class="bi bi-person-circle fs-3"></i></a>
                    @endauth
                    <a href="{{ url('/cart') }}" class="text-dark"><i class="bi bi-cart fs-3"></i></a>
                </div>
            </div>
            <div class="mt-3 d-lg-none">
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <main class="container py-5 flex-grow-1">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-decoration-none text-muted">Home</a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">About us</li>
            </ol>
        </nav>

        <!-- Logo / obrázok firmy -->
        <figure class="text-center mb-5">
            <img src="{{ asset('img/kvet.jpg') }}" alt="Logo kvetinarstvo.sk" class="about-logo img-fluid">
        </figure>

        <!-- Motivačný slogan -->
        <section class="mb-4" aria-label="Motivačný slogan">
            <div class="bg-light p-5 rounded shadow-sm text-center">
                <p class="fs-5 fw-light m-0">
                    „Každý kvet rozpráva príbeh. Nechajte nás pomôcť vám vyrozprávať ten váš."
                </p>
            </div>
        </section>

        <!-- Kontakt -->
        <section class="mb-4" aria-label="Kontaktné informácie">
            <div class="bg-light p-5 rounded shadow-sm">
                <h2 class="h5 fw-semibold mb-4 pb-2 border-bottom">Kontakt</h2>
                <address class="d-flex flex-column gap-3 fs-6 m-0">
                    <div class="d-flex flex-sm-row flex-column justify-content-between">
                        <span class="text-muted">E-mail:</span>
                        <a href="mailto:info@kvetinarstvo.sk" class="fw-medium text-dark text-decoration-none">
                            info@kvetinarstvo.sk
                        </a>
                    </div>
                    <div class="d-flex flex-sm-row flex-column justify-content-between">
                        <span class="text-muted">Telefón:</span>
                        <a href="tel:+421900000000" class="fw-medium text-dark text-decoration-none">
                            +421 900 000 000
                        </a>
                    </div>
                    <div class="d-flex flex-sm-row flex-column justify-content-between">
                        <span class="text-muted">Adresa:</span>
                        <span class="fw-medium text-dark text-sm-end">
                            Kvetná 1<br>811 01 Bratislava
                        </span>
                    </div>
                    <div class="d-flex flex-sm-row flex-column justify-content-between">
                        <span class="text-muted">Otváracie hodiny:</span>
                        <span class="fw-medium text-dark text-sm-end">
                            Po–Pi: 8:00 – 18:00<br>So: 9:00 – 13:00
                        </span>
                    </div>
                </address>
            </div>
        </section>

        <!-- Právne normy -->
        <section aria-label="Právne informácie">
            <div class="bg-light p-5 rounded shadow-sm">
                <h2 class="h5 fw-semibold mb-4 pb-2 border-bottom">Právne normy atď.</h2>
                <dl class="d-flex flex-column gap-3 fs-6 m-0">
                    <div>
                        <dt class="fw-medium text-dark mb-1">Obchodné podmienky</dt>
                        <dd class="text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</dd>
                    </div>
                    <div>
                        <dt class="fw-medium text-dark mb-1">Ochrana osobných údajov (GDPR)</dt>
                        <dd class="text-muted mb-0">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</dd>
                    </div>
                    <div>
                        <dt class="fw-medium text-dark mb-1">Reklamačný poriadok</dt>
                        <dd class="text-muted mb-0">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</dd>
                    </div>
                </dl>
            </div>
        </section>

    </main>

    <footer class="bg-light py-5 border-top">
        <div class="container">
            <div class="row text-start">
                <div class="col-md-4 mb-4 mb-md-0">
                    <a href="{{ url('/about') }}" class="text-decoration-none text-dark d-block">
                        <h6 class="fw-bold">Kvetinárstvo.sk</h6>
                    </a>
                    <p class="text-muted small mb-2">Prinášame čerstvé kvety pre každú príležitosť. Rýchle doručenie, kvalitné aranžmány a spokojní zákazníci.</p>
                    <a href="{{ url('/about') }}" class="text-decoration-none small fw-medium text-dark">O nás →</a>
                    <p class="text-muted small mb-0">© 2026 Kvetinarstvo.sk</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h6 class="fw-bold">Kontakt</h6>
                    <ul class="list-unstyled small text-muted">
                        <li>Hlavná 123</li>
                        <li>811 01 Bratislava, Slovensko</li>
                        <li class="mt-2">Tel: +421 900 123 456</li>
                        <li>Email: info@kvetinarstvo.sk</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold">Informácie</h6>
                    <ul class="list-unstyled small text-muted">
                        <li>IČO: 12345678</li>
                        <li>DIČ: 2023456789</li>
                        <li>Otváracie hodiny: Po–Pi 8:00 – 18:00</li>
                        <li>So 9:00 – 14:00</li>
                        <li class="mt-2">Doručenie v rámci SR</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center small text-muted">Navrhnuté pre demo účely • Obsahuje vymyslené údaje</div>
        </div>
    </footer>

</body>
</html>
