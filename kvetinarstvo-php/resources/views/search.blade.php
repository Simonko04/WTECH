<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search result - kvetinarstvo.sk</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap ikony -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        /* TODO ak bude moc css, presunut do style.css */
        .logo-placeholder { font-size: 1.8rem; font-weight: 900; }
        .product-img { aspect-ratio: 3/2; width: 100%; object-fit: cover; }
        .filter-sidebar { background: #f8f9fa; border: 1px solid #dee2e6;
            border-radius: 0.375rem; padding: 1.5rem;
        }
        .search-bar { background: #e9ecef; padding: 0.75rem; }
		.sort-container { display: flex; flex-direction: column; position: relative; }
        @media (min-width: 576px){ .sort-container {  flex-direction: row; }}
        .sort-options { display: none;
            position: absolute;top: 100%; right: 0; background: white;
            border: 1px solid #dee2e6; border-radius: 0.375rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 1000;
            min-width: 200px; padding: 0.5rem 0;
        }
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

    <!-- MAIN CONTENT – Search result -->
    <main class="flex-grow-1 py-4">
        <!-- Sekundárny search bar -->
        <div class="search-bar">
            <div class="container">
                <form>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-0">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Search" aria-label="Search">
                    </div>
                </form>
            </div>
        </div>

        <div class="container py-5">
            <div class="row g-5">
                <!-- LEFT – Filtrovanie -->
                <div class="col-lg-3 collapse d-lg-block" id="filterCollapse">
                    <form method="GET" action="{{ url('/search') }}" id="filter-form">
                        <div class="filter-sidebar sticky-top" style="top: 20px;">
                            <h5 class="mb-4 fw-bold">Filtrovanie</h5>

                            <!-- Hidden sort input -->
                            <input type="hidden" name="sort" id="sort-input" value="{{ request('sort') }}">

                            <!-- Kategorie kvetov -->
                            <div class="mb-5">
                                <h6 class="mb-3 text-muted fw-medium">Kategórie</h6>
                                @foreach($categories as $category)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="cat-{{ $category->id }}"
                                            name="category[]" value="{{ $category->id }}"
                                            {{ in_array($category->id, request('category', [])) ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <label class="form-check-label" for="cat-{{ $category->id }}">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </div>


                            <!-- Typy kvetov -->
                            <div class="mb-5">
                                <h6 class="mb-3 text-muted fw-medium">Farba</h6>
                                @foreach($colors as $color)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="color-{{ $color->id }}"
                                            name="color[]" value="{{ $color->id }}"
                                            {{ in_array($color->id, (array) request('color', [])) ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <label class="form-check-label" for="color-{{ $color->id }}">{{ $color->name }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Cenové rozpätie -->
                            <div class="mb-5">
                                <h6 class="mb-3 text-muted fw-medium">Cenové rozpätie</h6>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="form-label small text-muted">Od</label>
                                        <input type="number" class="form-control" name="price_from" value="{{ request('price_from') }}" min="0" step="0.01">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label small text-muted">Do</label>
                                        <input type="number" class="form-control" name="price_to" value="{{ request('price_to') }}" min="0" step="0.01">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-secondary btn-sm mt-3 w-100">Použiť cenu</button>
                            </div>

                            <!-- Ostatné -->
                            <div>
                                <h6 class="mb-3 text-muted fw-medium">Ostatné</h6>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="sklad" checked>
                                    <label class="form-check-label" for="sklad">Na sklade</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="doprava">
                                    <label class="form-check-label" for="doprava">Doprava zadarmo</label>
                                </div>
                            </div>

                            <!-- Clear -->
                            @if(request()->hasAny(['category', 'color', 'price_from', 'price_to', 'sort']))
                                <a href="{{ url('/search') }}" class="btn btn-outline-secondary btn-sm mt-4 w-100">Zrušiť filtre</a>
                            @endif

                        </div>
                    </form>
                </div>

                <!-- RIGHT – Produkty -->
                <div class="col-lg-9">

					<div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0 fw-bold">Výsledky vyhľadávania</h5>

                        <div class="sort-container">
                            <label class="btn btn-outline-secondary dropdown-toggle sort-btn" for="sort-toggle">
                                <i class="bi bi-sort-down-alt me-2"></i>
                                Preusporiadať
                            </label>
                            <input type="checkbox" id="sort-toggle" class="sort-btn d-none">

                            <div class="sort-options">
                                <div class="sort-option" onclick="document.getElementById('sort-input').value='price_asc';  document.getElementById('filter-form').submit();">Od najlacnejšieho</div>
                                <div class="sort-option" onclick="document.getElementById('sort-input').value='price_desc'; document.getElementById('filter-form').submit();">Od najdrahšieho</div>
                                <div class="sort-option" onclick="document.getElementById('sort-input').value='name_asc';   document.getElementById('filter-form').submit();">Názov A – Z</div>
                                <div class="sort-option" onclick="document.getElementById('sort-input').value='name_desc';  document.getElementById('filter-form').submit();">Názov Z – A</div>
                            </div>
                            
                              <div class="d-lg-none ms-0 ms-sm-3 text-end w-100">
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                                    <i class="bi bi-funnel"></i> Filtre
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        @foreach($products as $product)
                            <div class="col-6 col-md-4 col-lg-4">
                                <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                                    <div class="card h-100 border-0 shadow">
                                        <img src="{{ asset($product->images->first()->path) }}" alt="{{ $product->name }}" class="product-img">
                                        <div class="card-body text-center p-3">
                                            <p class="mb-1 fw-medium">{{ $product->name }}</p>
                                            <p class="text-muted mb-0">{{ $product->price }}€</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-5">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">‹</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">›</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </main>


	<!-- FOOTER -->
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
