<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkty - Administrácia - kvetinarstvo.sk</title>
 
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap ikony -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
 
    <style>
        /* TODO ak bude moc css, presunut do style.css */
        .logo-placeholder {
            font-size: 1.8rem;
            font-weight: 900;
        }
       
        .product-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: #f8f9fa;
        }
       
        .filter-sidebar {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 1.5rem;
        }
       
        .search-bar {
            background: #e9ecef;
            padding: 0.75rem;
        }
		
		.sort-container {
            position: relative;
        }

        .sort-options {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            z-index: 1000;
            min-width: 200px;
            padding: 0.5rem 0;
        }

        .sort-btn:checked ~ .sort-options {
            display: block;
        }

        .sort-option {
            padding: 0.5rem 1rem;
            cursor: pointer;
        }

        .sort-option:hover {
            background-color: #f8f9fa;
        }
		
		.admin-header {
            background-color: #1a1a1a;
            color: white;
        }
		
		.action-btn {
            font-size: 0.85rem;
            padding: 0.4rem 0.75rem;
        }
    </style>
</head>
<body class="bg-white d-flex flex-column min-vh-100">
     
	<!-- HEADER - ADMIN -->
    <header class="border-bottom admin-header shadow-sm">
        <div class="container py-3">
           
            <!-- Horný riadok headeru: logo + názov (vľavo) + vyhľadávanie (na desktop) + ikony (vpravo) -->
            <div class="d-flex align-items-center">
              
                <!-- Logo + Admin title -->
                <a href="{{ route('admin.products.index') }}" class="d-flex align-items-center text-decoration-none text-white me-auto">
                    <span class="logo-placeholder text-danger">LOGO</span>
                    <span class="ms-3 fw-bold fs-4">kvetinarstvo.sk</span>
                    <span class="ms-3 badge bg-danger fs-6">ADMIN</span>
                </a>
              
                <!-- menu ikony -->
                <div class="d-flex gap-3 align-items-center">
                    <a href="{{ route('admin.products.index') }}" class="text-white text-decoration-none fw-medium">Produkty</a>

                    <a href="{{ route('admin.profile') }}" class="text-white">
                        <i class="bi bi-person-circle fs-4"></i>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link text-white d-flex align-items-center gap-2 text-decoration-none p-0">
                            <i class="bi bi-box-arrow-right fs-5"></i>
                            <span class="d-none d-md-inline">Odhlásiť sa</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT – Search result -->
    <main class="flex-grow-1 py-4">
        <!-- Sekundárny search bar -->
        <div class="search-bar">
            <div class="container">
                <form method="GET" action="{{ route('admin.products.index') }}">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-0">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control border-0 shadow-none" name="q" placeholder="Hľadať produkty..." aria-label="Search" value="{{ request('q') }}">
                        <button class="btn btn-outline-secondary" type="submit">Hľadať</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="container py-5">
			<!-- New Product Button -->
			<div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0 fw-bold">Správa produktov</h4>
                <a href="{{ route('admin.products.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-2"></i>
                    Nový produkt
                </a>
            </div>
			
            <div class="row g-5">
                <!-- LEFT – Filtrovanie -->
                <div class="col-lg-3">
                    <form method="GET" action="{{ route('admin.products.index') }}" id="filter-form">
                        <input type="hidden" name="q" value="{{ request('q') }}">
                        <input type="hidden" name="sort" id="sort-input" value="{{ request('sort') }}">
                    <div class="filter-sidebar sticky-top" style="top: 20px;">
                        <h5 class="mb-4 fw-bold">Filtrovanie</h5>

						 <!-- Kategorie kvetov -->
                        <div class="mb-5">
                            <h6 class="mb-3 text-muted fw-medium">Kategorie</h6>
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

                        @php
                            $fromValue = request()->filled('price_from') ? max((float)request('price_from'), (float)$priceMin) : $priceMin;
                            $toValue = request()->filled('price_to') ? min((float)request('price_to'), (float)$priceMax) : $priceMax;
                        @endphp

                        <!-- Cenové rozpätie -->
                        <div class="mb-5">
                            <h6 class="mb-3 text-muted fw-medium">Cenové rozpätie</h6>
                            <div class="row g-2">
                                <div class="col-6">
                                    <label class="form-label small text-muted">Od</label>
                                    <input type="number" class="form-control" name="price_from" value="{{ $fromValue }}" min="0" step="0.01">
                                </div>
                                <div class="col-6">
                                    <label class="form-label small text-muted">Do</label>
                                    <input type="number" class="form-control" name="price_to" value="{{ $toValue }}" min="0" step="0.01">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-secondary btn-sm mt-3 w-100">Použiť cenu</button>
                        </div>

                        <!-- Ostatné -->
                        <div>
                            <h6 class="mb-3 text-muted fw-medium">Ostatné</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="sklad"
                                    name="in_stock" value="1"
                                    {{ request('in_stock') ? 'checked' : '' }}
                                    onchange="this.form.submit()">
                                <label class="form-check-label" for="sklad">Na sklade</label>
                            </div>
                        </div>

                        @if(request()->hasAny(['category', 'color', 'price_from', 'price_to', 'sort', 'in_stock']))
                            <hr>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm w-100">Zrušiť filtre</a>
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
                        </div>
                    </div>
					
                    <div class="row g-4">
                        @foreach($products as $product)
                        <div class="col-6 col-md-4 col-lg-4">
                            <div class="card h-100 border-0 shadow">
                                <img src="{{ asset($product->images->first()?->path ?? 'img/placeholder.svg') }}" alt="{{ $product->name }}" class="product-img">
                                <div class="card-body p-3">
                                    <p class="mb-1 fw-medium">{{ $product->name }}</p>
                                    <p class="text-muted mb-2">{{ number_format($product->price, 2) }}€</p>
									<div class="d-flex gap-2">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary action-btn flex-fill">
                                            <i class="bi bi-pencil"></i> Upraviť
                                        </a>
                                        <button class="btn btn-outline-danger action-btn flex-fill">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-5">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>


	<!-- FOOTER -->
    <footer class="bg-white py-4 border-top mt-auto">
        <div class="container">
            <div class="text-center small text-muted">
                Kvetinárstvo.sk • Administrátorské rozhranie • Demo 2026
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>