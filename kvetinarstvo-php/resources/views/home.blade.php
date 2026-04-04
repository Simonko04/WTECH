<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kvetinarstvo.sk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .logo-placeholder { font-size: 1.8rem; font-weight: 900; }
        .hero-banner { overflow: hidden; height: 480px; position: relative; }
        .hero-banner img { width: 100%; height: 100%; object-fit: cover; }
        .hero-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(rgba(0,0,0,0.35), rgba(0,0,0,0.45));
            display: flex; align-items: center; justify-content: center;
            text-align: center; color: white;
        }
        .bundle-img { width: 100%; height: 130px; object-fit: cover; }
        .product-img { width: 100%; height: 220px; object-fit: cover; }
        .section-title { position: relative; display: inline-block; }
        .section-title:after {
            content: ''; position: absolute; width: 60%; height: 3px;
            background: #dc3545; bottom: -6px; left: 20%;
        }
    </style>
</head>
<body class="bg-white d-flex flex-column min-vh-100">

<header class="border-bottom bg-white shadow-sm">
    <div class="container py-3">
        <div class="d-flex align-items-center">
            <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none me-auto">
                <span class="logo-placeholder text-danger">LOGO</span>
                <span class="ms-3 fw-bold fs-4 text-dark">kvetinarstvo.sk</span>
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

<main class="flex-grow-1">

    <div class="hero-banner">
        <img src="{{ asset('img/banner.jpg') }}" class="img-fluid w-100" alt="Hero image">
        <div class="hero-overlay">
            <div>
                <h1 class="display-4 fw-bold mb-3">Čerstvé kvety priamo k vám</h1>
                <p class="lead mb-4">Rýchle doručenie • Kvalitné aranžmány • Každý deň nové</p>
                <a href="#produkty" class="btn btn-danger btn-lg px-5">Objednať teraz</a>
            </div>
        </div>
    </div>

    <div class="bg-light py-4">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-6 col-md-3">
                    <i class="bi bi-truck fs-1 text-danger mb-2"></i>
                    <p class="small fw-medium mb-0">Doručenie do 24 hodín</p>
                </div>
                <div class="col-6 col-md-3">
                    <i class="bi bi-flower1 fs-1 text-danger mb-2"></i>
                    <p class="small fw-medium mb-0">Čerstvé kvety denne</p>
                </div>
                <div class="col-6 col-md-3">
                    <i class="bi bi-shield-check fs-1 text-danger mb-2"></i>
                    <p class="small fw-medium mb-0">Záruka spokojnosti</p>
                </div>
                <div class="col-6 col-md-3">
                    <i class="bi bi-gift fs-1 text-danger mb-2"></i>
                    <p class="small fw-medium mb-0">Darčekové balenie zdarma</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <h2 class="text-center mb-4 section-title">Pre akú príležitosť hľadáte?</h2>
        <div class="row g-3 text-center">
            <div class="col-6 col-md-3">
                <a href="{{ url('/search') }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('img/romantic.jpg') }}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="Romantika">
                        <div class="card-body"><h6 class="fw-medium">Romantika & Narodeniny</h6></div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ url('/search') }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('img/wedding.jpg') }}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="Svadba">
                        <div class="card-body"><h6 class="fw-medium">Svadby & Oslavy</h6></div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ url('/search') }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('img/sympathy.jpg') }}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="Sústrasť">
                        <div class="card-body"><h6 class="fw-medium">Sústrasť</h6></div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ url('/search') }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('img/corporate.jpg') }}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="Firemné">
                        <div class="card-body"><h6 class="fw-medium">Firemné darčeky</h6></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container pb-5" id="produkty">
        <h2 class="text-center mb-4 section-title">Odporúčame dnes</h2>
        <div class="row g-4">
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow">
                    <img src="{{ asset('img/rose.jpg') }}" alt="Rose Elegance" class="product-img">
                    <div class="card-body text-center p-3">
                        <p class="mb-1 fw-medium">Rose Elegance</p>
                        <p class="text-muted mb-0">12.99€</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow">
                    <img src="{{ asset('img/orchid.jpg') }}" alt="Orchid Grace" class="product-img">
                    <div class="card-body text-center p-3">
                        <p class="mb-1 fw-medium">Orchid Grace</p>
                        <p class="text-muted mb-0">18.75€</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow">
                    <img src="{{ asset('img/lily.jpg') }}" alt="Lily Serenity" class="product-img">
                    <div class="card-body text-center p-3">
                        <p class="mb-1 fw-medium">Lily Serenity</p>
                        <p class="text-muted mb-0">13.80€</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow">
                    <img src="{{ asset('img/pheon.jpg') }}" alt="Peony Charm" class="product-img">
                    <div class="card-body text-center p-3">
                        <p class="mb-1 fw-medium">Peony Charm</p>
                        <p class="text-muted mb-0">14.30€</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ url('/search') }}" class="btn btn-outline-dark">Zobraziť všetky kvety →</a>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body p-3">
                        <div class="row g-3">
                            <div class="col-6"><img src="{{ asset('img/rose.jpg') }}" alt="Rose in bundle" class="bundle-img"></div>
                            <div class="col-6"><img src="{{ asset('img/pheon.jpg') }}" alt="Peony in bundle" class="bundle-img"></div>
                        </div>
                        <div class="mt-3 text-center">
                            <p class="mb-1 fw-medium">Romantic Rose & Peony</p>
                            <p class="text-muted mb-0">22.50€</p>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-center"><small class="text-muted">Balík kvetov</small></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body p-3">
                        <div class="row g-3">
                            <div class="col-6"><img src="{{ asset('img/tulip.jpg') }}" alt="Tulip in bundle" class="bundle-img"></div>
                            <div class="col-6"><img src="{{ asset('img/daisy.jpg') }}" alt="Daisy in bundle" class="bundle-img"></div>
                        </div>
                        <div class="mt-3 text-center">
                            <p class="mb-1 fw-medium">Spring Tulip & Daisy</p>
                            <p class="text-muted mb-0">19.99€</p>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-center"><small class="text-muted">Balík kvetov</small></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow">
                    <div class="card-body p-3">
                        <div class="row g-3">
                            <div class="col-6"><img src="{{ asset('img/orchid.jpg') }}" alt="Orchid in bundle" class="bundle-img"></div>
                            <div class="col-6"><img src="{{ asset('img/lily.jpg') }}" alt="Lily in bundle" class="bundle-img"></div>
                        </div>
                        <div class="mt-3 text-center">
                            <p class="mb-1 fw-medium">Premium Orchid & Lily</p>
                            <p class="text-muted mb-0">27.40€</p>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-center"><small class="text-muted">Balík kvetov</small></div>
                </div>
            </div>
        </div>
    </div>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
