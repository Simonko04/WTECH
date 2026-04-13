<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KVETY - Checkout</title>
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

<main class="container py-5 flex-grow-1">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/cart') }}" class="text-decoration-none text-muted">Košík</a></li>
            <li class="breadcrumb-item active text-muted" aria-current="page">Checkout</li>
        </ol>
    </nav>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <h1 class="text-center mb-5 display-5 fw-bold">Checkout</h1>

    <form method="POST" action="{{ route('checkout.store') }}">
        @csrf
        <div class="row g-5">

            {{-- ĽAVÁ STRANA --}}
            <div class="col-lg-7">
                <div class="card shadow-sm h-100">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Fakturačné údaje</h4>

                        @guest
                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        @endguest

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Meno</label>
                                <input type="text" name="billing_name"
                                       class="form-control @error('billing_name') is-invalid @enderror"
                                       value="{{ old('billing_name', Auth::user()?->name) }}">
                                @error('billing_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Priezvisko</label>
                                <input type="text" name="billing_surname"
                                       class="form-control @error('billing_surname') is-invalid @enderror"
                                       value="{{ old('billing_surname', Auth::user()?->surname) }}">
                                @error('billing_surname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Krajina</label>
                            <input type="text" name="billing_country"
                                   class="form-control @error('billing_country') is-invalid @enderror"
                                   value="{{ old('billing_country') }}">
                            @error('billing_country')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Adresa ulice</label>
                            <div class="row g-2">
                                <div class="col-md-8">
                                    <input type="text" name="billing_street"
                                           class="form-control @error('billing_street') is-invalid @enderror"
                                           value="{{ old('billing_street') }}" placeholder="Názov ulice">
                                    @error('billing_street')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="billing_house_number"
                                           class="form-control @error('billing_house_number') is-invalid @enderror"
                                           value="{{ old('billing_house_number') }}" placeholder="Číslo domu">
                                    @error('billing_house_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Mesto</label>
                                <input type="text" name="billing_city"
                                       class="form-control @error('billing_city') is-invalid @enderror"
                                       value="{{ old('billing_city') }}">
                                @error('billing_city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">PSČ</label>
                                <input type="text" name="billing_psc"
                                       class="form-control @error('billing_psc') is-invalid @enderror"
                                       value="{{ old('billing_psc') }}" placeholder="000 00">
                                @error('billing_psc')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="same_address"
                                       id="sameAddress" {{ old('same_address') ? 'checked' : '' }}>
                                <label class="form-check-label fw-medium" for="sameAddress">
                                    Použiť rovnakú adresu ako fakturačnú
                                </label>
                            </div>
                        </div>

                        <div id="shippingFields">
                            <h5 class="mb-3">Doručovacia adresa</h5>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Meno</label>
                                    <input type="text" name="shipping_name"
                                           class="form-control @error('shipping_name') is-invalid @enderror"
                                           value="{{ old('shipping_name') }}">
                                    @error('shipping_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Priezvisko</label>
                                    <input type="text" name="shipping_surname"
                                           class="form-control @error('shipping_surname') is-invalid @enderror"
                                           value="{{ old('shipping_surname') }}">
                                    @error('shipping_surname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Krajina</label>
                                <input type="text" name="shipping_country"
                                       class="form-control @error('shipping_country') is-invalid @enderror"
                                       value="{{ old('shipping_country') }}">
                                @error('shipping_country')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Adresa ulice</label>
                                <div class="row g-2">
                                    <div class="col-md-8">
                                        <input type="text" name="shipping_street"
                                               class="form-control @error('shipping_street') is-invalid @enderror"
                                               value="{{ old('shipping_street') }}" placeholder="Názov ulice">
                                        @error('shipping_street')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="shipping_house_number"
                                               class="form-control @error('shipping_house_number') is-invalid @enderror"
                                               value="{{ old('shipping_house_number') }}" placeholder="Číslo domu">
                                        @error('shipping_house_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Mesto</label>
                                    <input type="text" name="shipping_city"
                                           class="form-control @error('shipping_city') is-invalid @enderror"
                                           value="{{ old('shipping_city') }}">
                                    @error('shipping_city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">PSČ</label>
                                    <input type="text" name="shipping_psc"
                                           class="form-control @error('shipping_psc') is-invalid @enderror"
                                           value="{{ old('shipping_psc') }}" placeholder="000 00">
                                    @error('shipping_psc')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- PRAVÁ STRANA --}}
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
                                <span class="text-muted" id="shippingPrice">
                                    {{ number_format($shippingCost, 2) }}€
                                </span>
                            </div>
                            <div class="d-flex justify-content-between fs-5 fw-bold">
                                <span>Celkom</span>
                                <span id="totalPrice">{{ number_format($total, 2) }}€</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">Spôsob dopravy</h5>
                            <div class="list-group">
                                <label class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <input class="form-check-input me-2" type="radio" name="shipping_method"
                                               value="standard" {{ $shipping === 'standard' ? 'checked' : '' }}>
                                        <span>Štandardná doprava</span>
                                        <small class="text-muted d-block">Dodanie do 2-3 pracovných dní</small>
                                    </div>
                                    <span class="fw-medium">3.99€</span>
                                </label>
                                <label class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <input class="form-check-input me-2" type="radio" name="shipping_method"
                                               value="express" {{ $shipping === 'express' ? 'checked' : '' }}>
                                        <span>Express Shipping</span>
                                        <small class="text-muted d-block">Dodanie do 24 hodín</small>
                                    </div>
                                    <span class="fw-medium">7.99€</span>
                                </label>
                                <label class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <input class="form-check-input me-2" type="radio" name="shipping_method"
                                               value="pickup" {{ $shipping === 'pickup' ? 'checked' : '' }}>
                                        <span>Vyzdvihnutie v predajni</span>
                                        <small class="text-muted d-block">Pripravené za 2 hodiny - predajňa v Bratislave</small>
                                    </div>
                                    <span class="fw-medium text-success">Zadarmo</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 py-3 fs-5 fw-bold">
                            Pokračovať
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
<script>
    const checkbox = document.getElementById('sameAddress');
    const fields   = document.getElementById('shippingFields');

    function toggle() {
        fields.style.display = checkbox.checked ? 'none' : 'block';
    }
    checkbox.addEventListener('change', toggle);
    toggle();

    const subtotal = {{ $subtotal }};
    const shippingPrices = { standard: 3.99, express: 7.99, pickup: 0.00 };

    document.querySelectorAll('input[name="shipping_method"]').forEach(radio => {
        radio.addEventListener('change', function () {
            const cost = shippingPrices[this.value];
            document.getElementById('shippingPrice').textContent =
                cost === 0 ? 'Zadarmo' : cost.toFixed(2) + '€';
            document.getElementById('totalPrice').textContent =
                (subtotal + cost).toFixed(2) + '€';
        });
    });
</script>
</body>
</html>
