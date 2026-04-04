<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KVETY - Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root { --primary-accent: #d63384; }
        .logo-placeholder { font-size: 1.8rem; font-weight: 900; }
        .profile-avatar-frame { width: 10rem; height: 10rem; }
        .action-button { transition: background-color 0.2s, color 0.2s; cursor: pointer; }
        .action-button:hover { background-color: var(--primary-accent) !important; color: #fff !important; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-white">

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
            <div class="d-flex gap-4">
                <a href="{{ url('/wishlist') }}" class="text-dark"><i class="bi bi-heart fs-3"></i></a>
                <a href="{{ url('/profile') }}" class="text-dark"><i class="bi bi-person-circle fs-3"></i></a>
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
            <li class="breadcrumb-item active text-muted" aria-current="page">Profile</li>
        </ol>
    </nav>

    <section class="row g-4 align-items-stretch" aria-label="Profil používateľa">

        <div class="col-lg-5">
            <div class="bg-light p-5 rounded shadow-sm d-flex flex-column align-items-center text-center h-100">
                <figure class="mb-3">
                    <div class="profile-avatar-frame bg-white border border-secondary rounded-circle overflow-hidden d-flex align-items-center justify-content-center shadow-sm">
                        <img src="{{ asset('img/profile.jpg') }}"
                             alt="Profilová fotografia používateľa"
                             class="w-100 h-100 object-fit-cover">
                    </div>
                </figure>

                <h1 class="fw-normal fs-4 mb-3">{{ Auth::user()->name }} {{ Auth::user()->surname }}</h1>

                <p>
                    <span class="bg-secondary bg-opacity-25 px-4 py-1 rounded-pill small d-inline-block shadow-sm">
                        {{ Auth::user()->role ?? 'standard' }}
                    </span>
                </p>

                <div class="d-flex justify-content-center gap-3 mt-auto pt-3">
                    <a href="{{ url('/history') }}" class="action-button bg-secondary bg-opacity-25 border-0 px-4 py-2 rounded shadow-sm text-dark text-decoration-none">
                        order history
                    </a>
                    <a href="{{ url('/wishlist') }}" class="action-button bg-secondary bg-opacity-25 border-0 px-4 py-2 rounded shadow-sm text-dark text-decoration-none">
                        wishlist
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="bg-light p-5 rounded shadow-sm h-100 d-flex flex-column">
                <h2 class="h5 mb-4 pb-2 border-bottom text-dark">Contact Information</h2>

                <table class="table table-borderless mb-5 bg-transparent" style="--bs-table-bg: transparent;">
                    <tbody>
                    <tr>
                        <td class="text-muted w-25 align-middle">E-mail:</td>
                        <td class="fw-medium text-dark">{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted w-25 align-middle">Member since:</td>
                        <td class="fw-medium text-dark">{{ Auth::user()->created_at->format('F Y') }}</td>
                    </tr>
                    </tbody>
                </table>

                <div class="mt-auto d-flex flex-column flex-sm-row justify-content-center gap-3">
                    <button type="button" class="action-button bg-secondary bg-opacity-25 border-0 px-5 py-2 rounded shadow-sm text-dark fw-medium">
                        change info
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger px-5 py-2 rounded shadow-sm fw-medium w-100">
                            log out
                        </button>
                    </form>
                </div>
            </div>
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
