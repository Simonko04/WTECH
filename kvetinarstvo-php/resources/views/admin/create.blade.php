<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kvetinarstvo.sk</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap ikony -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        /* CSS z tvojej predlohy */
        .logo-placeholder { font-size: 1.8rem; font-weight: 900; }
        .product-img { aspect-ratio: 3/2; width: 100%; object-fit: cover; }
        .filter-sidebar { background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.375rem; padding: 1.5rem; }
        .search-bar { background: #e9ecef; padding: 0.75rem; }
        .sort-container { display: flex; flex-direction: column; position: relative; }
        @media (min-width: 576px){ .sort-container {  flex-direction: row; }}
        .sort-options { display: none; position: absolute; top: 100%; right: 0; background: white; border: 1px solid #dee2e6; border-radius: 0.375rem; box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 1000; min-width: 200px; padding: 0.5rem 0; }
        .sort-btn:checked ~ .sort-options { display: block; }
        .sort-option { padding: 0.5rem 1rem; cursor: pointer; }
        .sort-option:hover { background-color: #f8f9fa; }
    </style>
</head>
<body class="bg-white d-flex flex-column min-vh-100">

<!-- HEADER -->
    <header class="border-bottom bg-white shadow-sm">
                <div class="container py-3">
                    <div class="d-flex align-items-center">
                        <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none me-auto">
                            <span class="logo-placeholder text-danger">LOGO</span>
                            <span class="ms-3 fw-bold fs-4 text-dark d-none d-sm-flex">kvetinarstvo.sk</span>
                        </a>
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
                </div>
            </header>

    <main class="flex-grow-1 py-5 bg-light">
        <!-- Zabalené do menšieho, vycentrovaného kontajnera -->
        <div class="container" style="max-width: 900px;">

            <div class="bg-white p-4 p-md-5 rounded shadow-sm border">
                <h2 class="h4 mb-4 fw-bold text-dark">Pridať nový produkt</h2>

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="row g-4">
                    @csrf

                    <!-- NÁZOV -->
                    <div class="col-md-8">
                        <label for="product-name" class="form-label fw-medium text-dark">Názov produktu *</label>
                        <input type="text" id="product-name" name="name" class="form-control" placeholder="Napr. Kytica bielych karafiátov" required>
                    </div>

                    <!-- CENA -->
                    <div class="col-md-4">
                        <label for="product-price" class="form-label fw-medium text-dark">Cena (€) *</label>
                        <input type="number" id="product-price" name="price" class="form-control" step="0.01" min="0" placeholder="0.00" required>
                    </div>

                    <!-- Kategória (z databázy) -->
                    <div class="col-md-4">
                        <label for="product-category" class="form-label fw-medium text-dark">Kategória *</label>
                        <select id="product-category" name="category_id" class="form-select" required>
                            <option value="" selected disabled>Vyberte kategóriu...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Farba (z databázy) -->
                    <div class="col-md-4">
                        <label for="product-color" class="form-label fw-medium text-dark">Hlavná farba *</label>
                        <select id="product-color" name="color_id" class="form-select" required>
                            <option value="" selected disabled>Vyberte farbu...</option>
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Počet kusov na sklade -->
                    <div class="col-md-4">
                        <label for="product-quantity" class="form-label fw-medium text-dark">Kusov na sklade *</label>
                        <input type="number" id="product-quantity" name="quantity_available" class="form-control" min="0" placeholder="Napr. 10" required>
                    </div>

                    <!-- KRÁTKY POPIS -->
                    <div class="col-12">
                        <label for="product-short-desc" class="form-label fw-medium text-dark">Krátky popis *</label>
                        <textarea id="product-short-desc" name="short_description" class="form-control" rows="2" placeholder="Stručný pútavý text (zobrazí sa vedľa hlavnej fotografie)..." required></textarea>
                    </div>

                    <!-- DETAILNÝ OPIS -->
                    <div class="col-12">
                        <label for="product-full-desc" class="form-label fw-medium text-dark">Detailný opis produktu *</label>
                        <textarea id="product-full-desc" name="full_description" class="form-control" rows="6" placeholder="Kompletný popis vrátane pôvodu kvetov a spôsobu starostlivosti..." required></textarea>
                    </div>

                    <!-- FOTOGRAFIE -->
                    <div class="col-12 mt-4">
                        <label class="form-label fw-medium text-dark mb-3 border-bottom pb-2 w-100">Fotografie produktu *</label>
                        <div class="form-text mb-3 text-muted">Nahrajte presne 4 fotografie. Prvá nahratá fotografia bude použitá ako hlavná (titulná).</div>

                        <div class="row g-3">
                            <!-- Obrázok 1 (Hlavný) -->
                            <div class="col-md-6">
                                <label for="image-1" class="form-label small text-muted mb-1">Hlavná fotografia (Obrázok 1) *</label>
                                <input type="file" id="image-1" name="images[]" class="form-control" accept="image/*" required>
                            </div>

                            <!-- Obrázok 2 -->
                            <div class="col-md-6">
                                <label for="image-2" class="form-label small text-muted mb-1">Fotografia 2 *</label>
                                <input type="file" id="image-2" name="images[]" class="form-control" accept="image/*" required>
                            </div>

                            <!-- Obrázok 3 -->
                            <div class="col-md-6">
                                <label for="image-3" class="form-label small text-muted mb-1">Fotografia 3 *</label>
                                <input type="file" id="image-3" name="images[]" class="form-control" accept="image/*" required>
                            </div>

                            <!-- Obrázok 4 -->
                            <div class="col-md-6">
                                <label for="image-4" class="form-label small text-muted mb-1">Fotografia 4 *</label>
                                <input type="file" id="image-4" name="images[]" class="form-control" accept="image/*" required>
                            </div>
                        </div>
                    </div>

                    <!-- ODOŠLI -->
                    <div class="col-12 mt-4 pt-3 border-top">
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.products.index') ?? '#' }}" class="btn btn-light px-4 py-2 border shadow-sm text-dark fw-medium">
                                Zrušiť
                            </a>
                            <button type="submit" class="btn btn-danger px-5 py-2 shadow-sm fw-bold">
                                Vytvoriť produkt
                            </button>
                        </div>
                    </div>
                </form>
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

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
``` 🌸
