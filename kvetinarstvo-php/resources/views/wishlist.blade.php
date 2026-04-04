<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KVETY - Wishlist</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <style>
    :root {
      --primary-accent: #d63384;
    }

    .logo-placeholder {
      font-size: 1.8rem;
      font-weight: 900;
    }

    /* Skrytie natívnych šípok number inputu */
    .quantity-display::-webkit-outer-spin-button,
    .quantity-display::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    .quantity-display {
      -moz-appearance: textfield;
      width: 2.5rem;
      height: 2.5rem;
    }

    .cursor-pointer { cursor: pointer; }

    /* Wishlist riadok - hover efekt */
    .wishlist-item {
      transition: background-color 0.2s;
    }
    .wishlist-item:hover {
      background-color: #f8f9fa;
    }

    /* Odkaz na produkt v zozname */
    .product-link { transition: color 0.2s; }
    .product-link:hover { color: var(--primary-accent) !important; }

    /* Checkbox styling */
    .form-check-input:checked {
      background-color: var(--primary-accent);
      border-color: var(--primary-accent);
    }
    .form-check-input:focus {
      box-shadow: 0 0 0 0.2rem rgba(214, 51, 132, 0.25);
    }

    /* Tlačidlo pridať do košíka a odstrániť - hover */
    .btn-add-to-cart { transition: background-color 0.2s, color 0.2s; }
    .btn-add-to-cart:hover {
      background-color: var(--primary-accent) !important;
      color: #fff !important;
    }

    .remove-btn { transition: color 0.2s; cursor: pointer; }
    .remove-btn:hover { color: #dc3545 !important; }
  </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-white">

<!-- HEADER -->
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

  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="Home_page.html" class="text-decoration-none text-muted">Home</a></li>
      <li class="breadcrumb-item active text-muted" aria-current="page">Wishlist</li>
    </ol>
  </nav>

  <h1 class="h3 mb-4">Váš zoznam želaní</h1>

  <!-- Wishlist zoznam -->
  <section aria-label="Zoznam želaní">
    <ul class="list-unstyled d-flex flex-column gap-3 mb-4">

      <!-- Produkt 1 -->
      <li class="wishlist-item bg-light rounded shadow-sm px-3 py-3 border">
        <div class="d-flex flex-wrap align-items-center gap-3">

          <div class="d-flex align-items-center gap-3 flex-grow-1" style="min-width: 250px;">
            <!-- Checkbox -->
            <div class="form-check m-0">
              <input class="form-check-input" type="checkbox" id="item-1" aria-label="Vybrať produkt 1">
            </div>
            <!-- Obrázok -->
            <label for="item-1" class="bg-white border rounded cursor-pointer m-0" style="width: 60px; height: 60px; overflow: hidden;">
              <img src="img/kvet.jpg" alt="Ruža červená" class="w-100 h-100 object-fit-cover">
            </label>
            <!-- Názov ako odkaz -->
            <a href="single-product.html" class="product-link text-dark text-decoration-none fw-medium text-truncate">
              Ruža červená
            </a>
          </div>

          <div class="d-flex align-items-center gap-3 ms-auto">
            <!-- Výber množstva -->
            <div class="d-flex align-items-center gap-2">
              <span class="fs-5 fw-bold text-dark user-select-none cursor-pointer" aria-label="Znížiť množstvo">—</span>
              <input type="number" class="quantity-display bg-white border rounded text-center fw-bold shadow-sm" value="1" min="1" aria-label="Množstvo">
              <span class="fs-5 fw-bold text-dark user-select-none cursor-pointer" aria-label="Zvýšiť množstvo">+</span>
            </div>

            <!-- Cena -->
            <span class="fw-bold text-dark text-end" style="min-width: 5rem;">14.52€</span>

            <!-- Tlačidlo zmazať z wishlistu -->
            <span class="remove-btn text-muted fs-5 ms-2" title="Odstrániť z wishlistu" aria-label="Odstrániť produkt">
                <i class="bi bi-x-circle"></i>
            </span>
          </div>

        </div>
      </li>

      <!-- Produkt 2 -->
      <li class="wishlist-item bg-light rounded shadow-sm px-3 py-3 border">
        <div class="d-flex flex-wrap align-items-center gap-3">

          <div class="d-flex align-items-center gap-3 flex-grow-1" style="min-width: 250px;">
            <div class="form-check m-0">
              <input class="form-check-input" type="checkbox" id="item-2" aria-label="Vybrať produkt 2">
            </div>
            <label for="item-2" class="bg-white border rounded cursor-pointer m-0" style="width: 60px; height: 60px; overflow: hidden;">
              <img src="img/kvet.jpg" alt="Karafiát biely" class="w-100 h-100 object-fit-cover">
            </label>
            <a href="single-product.html" class="product-link text-dark text-decoration-none fw-medium text-truncate">
              Karafiát biely
            </a>
          </div>

          <div class="d-flex align-items-center gap-3 ms-auto">
            <div class="d-flex align-items-center gap-2">
              <span class="fs-5 fw-bold text-dark user-select-none cursor-pointer" aria-label="Znížiť množstvo">—</span>
              <input type="number" class="quantity-display bg-white border rounded text-center fw-bold shadow-sm" value="1" min="1" aria-label="Množstvo">
              <span class="fs-5 fw-bold text-dark user-select-none cursor-pointer" aria-label="Zvýšiť množstvo">+</span>
            </div>
            <span class="fw-bold text-dark text-end" style="min-width: 5rem;">19.45€</span>
            <span class="remove-btn text-muted fs-5 ms-2" title="Odstrániť z wishlistu" aria-label="Odstrániť produkt">
                <i class="bi bi-x-circle"></i>
            </span>
          </div>

        </div>
      </li>

      <!-- Produkt 3 -->
      <li class="wishlist-item bg-light rounded shadow-sm px-3 py-3 border">
        <div class="d-flex flex-wrap align-items-center gap-3">

          <div class="d-flex align-items-center gap-3 flex-grow-1" style="min-width: 250px;">
            <div class="form-check m-0">
              <input class="form-check-input" type="checkbox" id="item-3" aria-label="Vybrať produkt 3">
            </div>
            <label for="item-3" class="bg-white border rounded cursor-pointer m-0" style="width: 60px; height: 60px; overflow: hidden;">
              <img src="img/kvet.jpg" alt="Orgován jarný" class="w-100 h-100 object-fit-cover">
            </label>
            <a href="single-product.html" class="product-link text-dark text-decoration-none fw-medium text-truncate">
              Orgován jarný
            </a>
          </div>

          <div class="d-flex align-items-center gap-3 ms-auto">
            <div class="d-flex align-items-center gap-2">
              <span class="fs-5 fw-bold text-dark user-select-none cursor-pointer" aria-label="Znížiť množstvo">—</span>
              <input type="number" class="quantity-display bg-white border rounded text-center fw-bold shadow-sm" value="1" min="1" aria-label="Množstvo">
              <span class="fs-5 fw-bold text-dark user-select-none cursor-pointer" aria-label="Zvýšiť množstvo">+</span>
            </div>
            <span class="fw-bold text-dark text-end" style="min-width: 5rem;">25.47€</span>
            <span class="remove-btn text-muted fs-5 ms-2" title="Odstrániť z wishlistu" aria-label="Odstrániť produkt">
                <i class="bi bi-x-circle"></i>
            </span>
          </div>

        </div>
      </li>

      <!-- Produkt 4 -->
      <li class="wishlist-item bg-light rounded shadow-sm px-3 py-3 border">
        <div class="d-flex flex-wrap align-items-center gap-3">

          <div class="d-flex align-items-center gap-3 flex-grow-1" style="min-width: 250px;">
            <div class="form-check m-0">
              <input class="form-check-input" type="checkbox" id="item-4" aria-label="Vybrať produkt 4">
            </div>
            <label for="item-4" class="bg-white border rounded cursor-pointer m-0" style="width: 60px; height: 60px; overflow: hidden;">
              <img src="img/kvet.jpg" alt="Osika opadavá" class="w-100 h-100 object-fit-cover">
            </label>
            <a href="single-product.html" class="product-link text-dark text-decoration-none fw-medium text-truncate">
              Osika opadavá
            </a>
          </div>

          <div class="d-flex align-items-center gap-3 ms-auto">
            <div class="d-flex align-items-center gap-2">
              <span class="fs-5 fw-bold text-dark user-select-none cursor-pointer" aria-label="Znížiť množstvo">—</span>
              <input type="number" class="quantity-display bg-white border rounded text-center fw-bold shadow-sm" value="1" min="1" aria-label="Množstvo">
              <span class="fs-5 fw-bold text-dark user-select-none cursor-pointer" aria-label="Zvýšiť množstvo">+</span>
            </div>
            <span class="fw-bold text-dark text-end" style="min-width: 5rem;">19.58€</span>
            <span class="remove-btn text-muted fs-5 ms-2" title="Odstrániť z wishlistu" aria-label="Odstrániť produkt">
                <i class="bi bi-x-circle"></i>
            </span>
          </div>

        </div>
      </li>

    </ul>

    <!-- Spodná lišta: stránkovanie + tlačidlo -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mt-4">

      <!-- Stránkovanie (Ponechané pôvodné presne podľa vášho zadania) -->
      <nav aria-label="Stránkovanie wishlistu">
        <ul class="pagination pagination-sm mb-0">
          <li class="page-item disabled">
            <span class="page-link bg-secondary bg-opacity-25 border-0 text-dark">‹</span>
          </li>
          <li class="page-item active">
            <span class="page-link bg-secondary bg-opacity-50 border-0 text-dark">1</span>
          </li>
          <li class="page-item">
            <a class="page-link bg-secondary bg-opacity-25 border-0 text-dark" href="#">2</a>
          </li>
          <li class="page-item">
            <a class="page-link bg-secondary bg-opacity-25 border-0 text-dark" href="#">3</a>
          </li>
          <li class="page-item">
            <a class="page-link bg-secondary bg-opacity-25 border-0 text-dark" href="#">›</a>
          </li>
        </ul>
      </nav>

      <!-- Pridať vybrané do košíka -->
      <button type="button"
              class="btn-add-to-cart bg-secondary bg-opacity-25 border-0 px-4 py-2 rounded shadow-sm text-dark fw-bold text-uppercase">
        Pridať vybrané do košíka
      </button>

    </div>
  </section>

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

</body>
</html>
