<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KVETY - Platba</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root { --primary-accent: #d63384; }
        .logo-placeholder { font-size: 1.8rem; font-weight: 900; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-white">

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

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/cart') }}" class="text-decoration-none text-muted">Košík</a></li>
            <li class="breadcrumb-item"><a href="{{ route('checkout.index') }}" class="text-decoration-none text-muted">Checkout</a></li>
            <li class="breadcrumb-item active text-muted" aria-current="page">Platba</li>
        </ol>
    </nav>

    <h1 class="text-center mb-5 display-5 fw-bold">Checkout</h1>

    <form method="POST" action="{{ route('checkout.payment.process') }}">
        @csrf
        <div class="row g-5 justify-content-center">

            <div class="col-lg-7">
                <div class="card shadow-sm h-100">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Platba</h4>
                        <h5 class="mb-3">Vyberte spôsob platby</h5>
                        <div class="list-group">
                            <label class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <input class="form-check-input me-3" type="radio" name="payment_method" value="card" checked>
                                    <i class="bi bi-credit-card fs-4 me-2 text-primary"></i>
                                    <div>
                                        <span class="fw-medium">Kreditná / debetná karta</span>
                                        <small class="text-muted d-block">Visa, Mastercard</small>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right text-muted"></i>
                            </label>
                            <label class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <input class="form-check-input me-3" type="radio" name="payment_method" value="apple">
                                    <i class="bi bi-apple fs-4 me-2"></i>
                                    <span class="fw-medium">Apple Pay</span>
                                </div>
                                <i class="bi bi-chevron-right text-muted"></i>
                            </label>
                            <label class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <input class="form-check-input me-3" type="radio" name="payment_method" value="google">
                                    <i class="bi bi-google fs-4 me-2"></i>
                                    <span class="fw-medium">Google Pay</span>
                                </div>
                                <i class="bi bi-chevron-right text-muted"></i>
                            </label>
                            <label class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <input class="form-check-input me-3" type="radio" name="payment_method" value="bank">
                                    <i class="bi bi-bank fs-4 me-2 text-success"></i>
                                    <div>
                                        <span class="fw-medium">Prevod na účet</span>
                                        <small class="text-muted d-block">Platba do 3 pracovných dní</small>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right text-muted"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm h-100">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Vaša objednávka</h4>

                        <div class="bg-light p-3 rounded mb-4">
                            @foreach ($cart as $item)
                                <div class="d-flex justify-content-between mb-2">
                                    <span>{{ $item['name'] }} <span class="text-muted">× {{ $item['quantity'] }}</span></span>
                                    <span class="text-muted">{{ number_format($item['price'] * $item['quantity'], 2) }}€</span>
                                </div>
                            @endforeach
                            <hr>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-medium">Doprava</span>
                                <span class="text-muted">
                                    {{ $shippingCost == 0 ? 'Zadarmo' : number_format($shippingCost, 2) . '€' }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between fs-5 fw-bold">
                                <span>Celkom</span>
                                <span>{{ number_format($total, 2) }}€</span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 py-3 fs-5 fw-bold">
                            Zaplatiť
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>

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
