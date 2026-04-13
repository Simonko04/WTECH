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
        .bundle-img { aspect-ratio: 7/5; width: 100%; object-fit: cover; }
        .product-img { aspect-ratio: 3/2; width: 100%; object-fit: cover; }
        .section-title { position: relative; display: inline-block; }
        .section-title:after {
            content: ''; position: absolute; width: 60%; height: 3px;
            background: #dc3545; bottom: -6px; left: 20%;
        }
        .card-img-top { aspect-ratio: 25/16; object-fit: cover; width: 100%; }
        .bundle-card { cursor: pointer; transition: box-shadow 0.2s; }
        .bundle-card:hover { box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.2) !important; }
    </style>
</head>
<body class="bg-white d-flex flex-column min-vh-100">

<header class="border-bottom bg-white shadow-sm">
    <div class="container py-3">
        <div class="d-flex align-items-center">
            <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none me-auto">
                <span class="logo-placeholder text-danger">LOGO</span>
                <span class="ms-3 fw-bold fs-4 text-dark d-none d-sm-flex">kvetinarstvo.sk</span>
            </a>
            <form class="flex-grow-1 mx-4 d-none d-lg-flex" method="GET" action="{{ url('/search') }}">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Hľadať produkty..." aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
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
            <form method="GET" action="{{ url('/search') }}">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Hľadať produkty..." aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
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
                <a href="{{ url('/search?category[]=2') }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('img/romantic.jpg') }}" class="card-img-top" alt="Romantika">
                        <div class="card-body"><h6 class="fw-medium">Romantika & Narodeniny</h6></div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ url('/search?category[]=1') }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('img/wedding.jpg') }}" class="card-img-top" alt="Svadba">
                        <div class="card-body"><h6 class="fw-medium">Svadby & Oslavy</h6></div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ url('/search?category[]=3') }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('img/sympathy.jpg') }}" class="card-img-top" alt="Sústrasť">
                        <div class="card-body"><h6 class="fw-medium">Sústrasť</h6></div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ url('/search?category[]=4') }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('img/corporate.jpg') }}" class="card-img-top" alt="Firemné">
                        <div class="card-body"><h6 class="fw-medium">Firemné darčeky</h6></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container pb-5" id="produkty">
        <h2 class="text-center mb-4 section-title">Odporúčame dnes</h2>
        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 border-0 shadow">
                            <img src="{{ asset($product->images->first()->path ?? 'img/placeholder.jpg') }}"
                                 alt="{{ $product->name }}"
                                 class="product-img">
                            <div class="card-body text-center p-3">
                                <p class="mb-1 fw-medium">{{ $product->name }}</p>
                                <p class="text-muted mb-0">{{ $product->price }}€</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ url('/search') }}" class="btn btn-outline-dark">Zobraziť všetky kvety →</a>
        </div>
    </div>

    {{-- Bundle Modal --}}
    <div class="modal fade" id="bundleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Pridať balík do košíka?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-3">
                    <p class="text-muted mb-1" id="bundle-names"></p>
                    <p class="fw-bold fs-5 mt-2">Spolu: <span id="bundle-price"></span>€</p>
                </div>
                <div class="modal-footer border-0 justify-content-center gap-2">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Zrušiť</button>
                    <form method="POST" action="{{ route('cart.addBundle') }}" id="bundle-form">
                        @csrf
                        <input type="hidden" name="product1_id" id="bundle-p1">
                        <input type="hidden" name="product2_id" id="bundle-p2">
                        <button type="submit" class="btn btn-danger px-4">Pridať do košíka</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(session('bundle_success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('bundle_success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <div class="container pb-5">
        <h2 class="text-center mb-4 section-title">Balíky kvetov</h2>
        <div class="row g-4">
            @foreach($bundles as $bundle)
                @php
                    $p1 = $bundle->values()[0];
                    $p2 = $bundle->values()[1];
                    $totalPrice = $p1->price + $p2->price;
                @endphp
                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow bundle-card"
                         onclick="openBundleModal(
                             {{ $p1->id }}, {{ $p2->id }},
                             '{{ addslashes($p1->name) }}', '{{ addslashes($p2->name) }}',
                             '{{ number_format($totalPrice, 2) }}'
                         )">
                        <div class="card-body p-3">
                            <div class="row g-3">
                                <div class="col-6">
                                    <img src="{{ asset($p1->images->first()->path ?? 'img/placeholder.jpg') }}"
                                         alt="{{ $p1->name }}" class="bundle-img rounded">
                                </div>
                                <div class="col-6">
                                    <img src="{{ asset($p2->images->first()->path ?? 'img/placeholder.jpg') }}"
                                         alt="{{ $p2->name }}" class="bundle-img rounded">
                                </div>
                            </div>
                            <div class="mt-3 text-center">
                                <p class="mb-1 fw-medium">{{ $p1->name }} & {{ $p2->name }}</p>
                                <p class="text-muted mb-0">{{ number_format($totalPrice, 2) }}€</p>
                            </div>
                        </div>
                        <div class="card-footer bg-light text-center">
                            <small class="text-muted">Balík kvetov</small>
                        </div>
                    </div>
                </div>
            @endforeach
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
<script>
function openBundleModal(p1id, p2id, p1name, p2name, price) {
    document.getElementById('bundle-p1').value = p1id;
    document.getElementById('bundle-p2').value = p2id;
    document.getElementById('bundle-names').textContent = p1name + ' + ' + p2name;
    document.getElementById('bundle-price').textContent = price;
    new bootstrap.Modal(document.getElementById('bundleModal')).show();
}
</script>
</body>
</html>
