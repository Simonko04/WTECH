<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrácia - kvetinarstvo.sk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .logo-placeholder { font-size: 1.8rem; font-weight: 900; }
        .auth-card {
            max-width: 420px;
            margin: 0 auto;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .auth-body { padding: 2.5rem 2rem; }
        .btn-primary-custom {
            background-color: #e91e63;
            border: none;
            font-weight: 500;
            padding: 0.85rem;
            font-size: 1.1rem;
            border-radius: 8px;
            transition: background-color 0.2s;
        }
        .btn-primary-custom:hover { background-color: #c2185b; }
        .switch-link { color: #e91e63; font-weight: 500; text-decoration: none; }
        .switch-link:hover { text-decoration: underline; }
    </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">

<header class="border-bottom bg-white shadow-sm">
    <div class="container py-3">
        <div class="d-flex align-items-center">
            <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none me-auto">
                <span class="logo-placeholder text-danger">LOGO</span>
                <span class="ms-3 fw-bold fs-4 text-dark d-none d-sm-flex">kvetinarstvo.sk</span>
            </a>
            <div class="d-flex gap-4">
                <a href="{{ url('/wishlist') }}" class="text-dark"><i class="bi bi-heart fs-3"></i></a>
                <a href="{{ url('/cart') }}" class="text-dark"><i class="bi bi-cart fs-3"></i></a>
            </div>
        </div>
    </div>
</header>

<main class="flex-grow-1 d-flex align-items-center py-5">
    <div class="container">
        <div class="auth-card">
            <div class="auth-body">
                <h4 class="text-center mb-4 fw-bold">Zaregistrovať sa</h4>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control form-control-lg"
                               placeholder="Meno" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="surname" class="form-control form-control-lg"
                            placeholder="Priezvisko" value="{{ old('surname') }}" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control form-control-lg"
                               placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control form-control-lg"
                               placeholder="Heslo" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password_confirmation" class="form-control form-control-lg"
                               placeholder="Zopakuj Heslo" required>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger py-2 mb-3">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary-custom text-white w-100">
                        Vytvoriť účet
                    </button>

                    <div class="text-center mt-4 pt-3 border-top">
                        Máš už účet?
                        <a href="{{ route('login') }}" class="switch-link">Prihlásiť sa</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<footer class="bg-light py-5 border-top">
    <div class="container">
        <div class="row text-start">
            <div class="col-md-4 mb-4 mb-md-0">
                <h6 class="fw-bold">Kvetinárstvo.sk</h6>
                <p class="text-muted small mb-2">Prinášame čerstvé kvety pre každú príležitosť.</p>
                <p class="text-muted small mb-0">© 2026 Kvetinarstvo.sk</p>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <h6 class="fw-bold">Kontakt</h6>
                <ul class="list-unstyled small text-muted">
                    <li>Hlavná 123, 811 01 Bratislava</li>
                    <li>Tel: +421 900 123 456</li>
                    <li>Email: info@kvetinarstvo.sk</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="fw-bold">Informácie</h6>
                <ul class="list-unstyled small text-muted">
                    <li>Otváracie hodiny: Po–Pi 8:00–18:00</li>
                    <li>So 9:00–14:00</li>
                </ul>
            </div>
        </div>
        <hr class="my-4">
        <div class="text-center small text-muted">Navrhnuté pre demo účely</div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
