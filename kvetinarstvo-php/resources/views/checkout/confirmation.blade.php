<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KVETY - Potvrdenie objednávky</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root { --primary-accent: #d63384; }
        .logo-placeholder { font-size: 1.8rem; font-weight: 900; }
        .success-box {
            min-height: 320px; display: flex; flex-direction: column;
            justify-content: center; align-items: center;
            background: #f8f9fa; border: 1px solid #dee2e6;
            border-radius: 0.375rem; text-align: center;
        }
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
            <li class="breadcrumb-item active text-muted" aria-current="page">Potvrdenie objednávky</li>
        </ol>
    </nav>

    <h1 class="text-center mb-5 display-5 fw-bold">Checkout</h1>

    <div class="row g-5 justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-4 text-center">Objednávka potvrdená</h4>

                    <div class="success-box w-100 p-4">
                        <i class="bi bi-check-circle-fill text-success mb-3" style="font-size: 4rem;"></i>
                        <h5 class="fw-bold mb-3">Platba úspešná</h5>

                        <div class="mb-2">
                            <strong>ID objednávky:</strong>
                            #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                        </div>
                        <div class="mb-2">
                            <strong>Celková suma:</strong>
                            {{ number_format($order->price_total, 2) }}€
                        </div>
                        <div class="mb-2">
                            <strong>Spôsob platby:</strong>
                            {{ match($order->payment_method) {
                                'card'   => 'Kreditná / debetná karta',
                                'apple'  => 'Apple Pay',
                                'google' => 'Google Pay',
                                'bank'   => 'Prevod na účet',
                                default  => $order->payment_method
                            } }}
                        </div>
                        <div class="mb-4">
                            <strong>Doručenie na:</strong>
                            @if($order->shippingAddress)
                                {{ $order->shippingAddress->street }},
                                {{ $order->shippingAddress->psc }} {{ $order->shippingAddress->city }}
                            @else
                                {{ $order->billingAddress->street }},
                                {{ $order->billingAddress->psc }} {{ $order->billingAddress->city }}
                            @endif
                        </div>

                        <a href="{{ url('/') }}" class="btn btn-dark px-5 py-2 fs-5">
                            Späť na hlavnú stránku
                        </a>
                    </div>

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
