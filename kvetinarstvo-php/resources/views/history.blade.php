<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KVETY - História objednávok</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root { --primary-accent: #d63384; }
        .logo-placeholder { font-size: 1.8rem; font-weight: 900; }
        .filter-bar { background-color: #e9ecef; }
        .btn-detail { transition: background-color 0.2s, color 0.2s; }
        .btn-detail:hover { background-color: var(--primary-accent) !important; color: #fff !important; }
        .filter-select, .filter-input {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            color: #212529;
        }
        .filter-select:focus, .filter-input:focus {
            outline: none;
            border-color: var(--primary-accent);
            box-shadow: 0 0 0 0.2rem rgba(214, 51, 132, 0.15);
        }
        .table-hover tbody tr:hover { background-color: #f8f9fa; }
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
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Domov</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/profile') }}" class="text-decoration-none text-muted">Profil</a></li>
            <li class="breadcrumb-item active text-muted" aria-current="page">História objednávok</li>
        </ol>
    </nav>

    <h1 class="h3 mb-4">História objednávok</h1>

    <section aria-label="Zoznam objednávok s filtrom">

        <div class="filter-bar rounded shadow-sm px-4 py-3 mb-4">
            <form method="GET" action="{{ route('orders.index') }}" class="row g-3 align-items-end">

                <div class="col-6 col-sm-4 col-md-3">
                    <label for="date-from" class="form-label small text-muted mb-1">Dátum od</label>
                    <input type="date" id="date-from" name="date_from"
                           class="filter-input w-100"
                           value="{{ request('date_from') }}">
                </div>

                <div class="col-6 col-sm-4 col-md-3">
                    <label for="date-to" class="form-label small text-muted mb-1">Dátum do</label>
                    <input type="date" id="date-to" name="date_to"
                           class="filter-input w-100"
                           value="{{ request('date_to') }}">
                </div>

                <div class="col-6 col-sm-4 col-md-4">
                    <label for="filter-sort" class="form-label small text-muted mb-1">Zoradiť podľa</label>
                    <select id="filter-sort" name="sort" class="filter-select w-100">
                        <option value="date-desc" {{ request('sort', 'date-desc') === 'date-desc' ? 'selected' : '' }}>Dátum – najnovšie</option>
                        <option value="date-asc"  {{ request('sort') === 'date-asc'  ? 'selected' : '' }}>Dátum – najstaršie</option>
                        <option value="price-desc"{{ request('sort') === 'price-desc'? 'selected' : '' }}>Cena – najvyššia</option>
                        <option value="price-asc" {{ request('sort') === 'price-asc' ? 'selected' : '' }}>Cena – najnižšia</option>
                    </select>
                </div>

                <div class="col-6 col-sm-4 col-md-2">
                    <button type="submit" class="btn-detail bg-secondary bg-opacity-25 border-0 px-4 py-2 rounded shadow-sm text-dark small w-100">
                        Filtrovať
                    </button>
                </div>

            </form>
        </div>

        @if ($orders->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-bag-x fs-1 d-block mb-3"></i>
                Žiadne objednávky sa nenašli.
            </div>
        @else
        <div class="bg-light rounded shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="--bs-table-bg: transparent;">
                    <thead class="bg-secondary bg-opacity-25 text-muted small">
                    <tr>
                        <th scope="col" class="px-4 py-3 fw-medium border-0">Číslo obj.</th>
                        <th scope="col" class="py-3 fw-medium border-0">Dátum</th>
                        <th scope="col" class="py-3 fw-medium border-0" style="min-width: 250px;">Položky</th>
                        <th scope="col" class="py-3 fw-medium border-0">Počet ks</th>
                        <th scope="col" class="py-3 fw-medium border-0">Suma</th>
                    </tr>
                    </thead>
                    <tbody class="border-top-0">

                    @foreach ($orders as $order)
                        @php
                            $items = $order->orderContains
                                ->map(fn($i) => $i->product?->name ?? 'Produkt')
                                ->join(', ');
                            $totalQty = $order->orderContains->sum('quantity');
                        @endphp
                        <tr>
                            <td class="px-4 py-3">
                                <span class="small fw-medium text-dark">#{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="py-3">
                                <time datetime="{{ $order->created_at->format('Y-m-d') }}" class="small text-muted">
                                    {{ $order->created_at->format('d.m.Y') }}
                                </time>
                            </td>
                            <td class="py-3">
                                <span class="small text-dark">{{ $items }}</span>
                            </td>
                            <td class="py-3">
                                <span class="small fw-medium text-dark">{{ $totalQty }} ks</span>
                            </td>
                            <td class="py-3">
                                <span class="small fw-medium text-dark">{{ number_format($order->price_total, 2) }}€</span>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
        @endif

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
