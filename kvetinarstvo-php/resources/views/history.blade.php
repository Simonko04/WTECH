<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KVETY - História objednávok</title>

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

    /* Filter lišta */
    .filter-bar {
      background-color: #e9ecef;
    }

    /* Stav objednávky - farebné odznaky */
    .badge-delivered  { background-color: #d1e7dd; color: #0a3622; }
    .badge-pending    { background-color: #fff3cd; color: #664d03; }
    .badge-cancelled  { background-color: #f8d7da; color: #58151c; }
    .badge-processing { background-color: #cfe2ff; color: #084298; }

    .btn-detail {
      transition: background-color 0.2s, color 0.2s;
    }
    .btn-detail:hover {
      background-color: var(--primary-accent) !important;
      color: #fff !important;
    }

    /* Select a input - konzistentný štýl */
    .filter-select,
    .filter-input {
      background-color: #fff;
      border: 1px solid #dee2e6;
      border-radius: 0.375rem;
      padding: 0.375rem 0.75rem;
      font-size: 0.875rem;
      color: #212529;
    }
    .filter-select:focus,
    .filter-input:focus {
      outline: none;
      border-color: var(--primary-accent);
      box-shadow: 0 0 0 0.2rem rgba(214, 51, 132, 0.15);
    }

    /* Hover pre riadky tabuľky */
    .table-hover tbody tr:hover {
      background-color: #f8f9fa;
    }
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
      <li class="breadcrumb-item"><a href="Home_page.html" class="text-decoration-none text-muted">Domov</a></li>
      <li class="breadcrumb-item"><a href="profile_page.html" class="text-decoration-none text-muted">Profil</a></li>
      <li class="breadcrumb-item active text-muted" aria-current="page">História objednávok</li>
    </ol>
  </nav>

  <h1 class="h3 mb-4">História objednávok</h1>

  <section aria-label="Zoznam objednávok s filtrom">

    <!-- Filter lišta -->
    <div class="filter-bar rounded shadow-sm px-4 py-3 mb-4">
      <form class="row g-3 align-items-end" aria-label="Filtre objednávok">

        <!-- Dátum od -->
        <div class="col-6 col-sm-4 col-md-2">
          <label for="date-from" class="form-label small text-muted mb-1">Dátum od</label>
          <input type="date" id="date-from" class="filter-input w-100" value="2024-01-01">
        </div>

        <!-- Dátum do -->
        <div class="col-6 col-sm-4 col-md-2">
          <label for="date-to" class="form-label small text-muted mb-1">Dátum do</label>
          <input type="date" id="date-to" class="filter-input w-100" value="2026-03-27">
        </div>

        <!-- Stav objednávky -->
        <div class="col-6 col-sm-4 col-md-3">
          <label for="filter-status" class="form-label small text-muted mb-1">Stav</label>
          <select id="filter-status" class="filter-select w-100">
            <option value="">Všetky stavy</option>
            <option value="delivered">Doručená</option>
            <option value="processing">Spracováva sa</option>
            <option value="pending">Čaká na platbu</option>
            <option value="cancelled">Zrušená</option>
          </select>
        </div>

        <!-- Zoradiť podľa -->
        <div class="col-6 col-sm-4 col-md-3">
          <label for="filter-sort" class="form-label small text-muted mb-1">Zoradiť podľa</label>
          <select id="filter-sort" class="filter-select w-100">
            <option value="date-desc">Dátum – najnovšie</option>
            <option value="date-asc">Dátum – najstaršie</option>
            <option value="price-desc">Cena – najvyššia</option>
            <option value="price-asc">Cena – najnižšia</option>
          </select>
        </div>

        <!-- Tlačidlo filtrovať (Zmenené w-100 len pre mobily) -->
        <div class="col-12 col-md-2">
          <button type="submit" class="btn-detail bg-secondary bg-opacity-25 border-0 px-4 py-2 rounded shadow-sm text-dark small w-100">
            Filtrovať
          </button>
        </div>

      </form>
    </div>

    <!-- HTML Tabuľka objednávok -->
    <div class="bg-light rounded shadow-sm overflow-hidden">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="--bs-table-bg: transparent;">

          <thead class="bg-secondary bg-opacity-25 text-muted small">
          <tr>
            <th scope="col" class="px-4 py-3 fw-medium border-0">Číslo obj.</th>
            <th scope="col" class="py-3 fw-medium border-0">Dátum</th>
            <th scope="col" class="py-3 fw-medium border-0" style="min-width: 250px;">Položky</th>
            <th scope="col" class="py-3 fw-medium border-0">Suma</th>
            <th scope="col" class="py-3 fw-medium border-0">Stav</th>
            <th scope="col" class="px-4 py-3 fw-medium border-0 text-end">Akcia</th>
          </tr>
          </thead>

          <tbody class="border-top-0">

          <!-- Objednávka 1 -->
          <tr>
            <td class="px-4 py-3"><span class="small fw-medium text-dark">#20260312</span></td>
            <td class="py-3"><time datetime="2026-03-12" class="small text-muted">12.03.2026</time></td>
            <td class="py-3"><span class="small text-dark">Ruža červená, Orchidea fialová</span></td>
            <td class="py-3"><span class="small fw-medium text-dark">19.99€</span></td>
            <td class="py-3"><span class="badge-delivered px-2 py-1 rounded small">Doručená</span></td>
            <td class="px-4 py-3 text-end">
              <a href="#" class="btn-detail bg-secondary bg-opacity-25 border-0 px-3 py-1 rounded shadow-sm text-dark small text-decoration-none">
                Detail
              </a>
            </td>
          </tr>

          <!-- Objednávka 2 -->
          <tr>
            <td class="px-4 py-3"><span class="small fw-medium text-dark">#20260205</span></td>
            <td class="py-3"><time datetime="2026-02-05" class="small text-muted">05.02.2026</time></td>
            <td class="py-3"><span class="small text-dark">Karafiát biely – kytica</span></td>
            <td class="py-3"><span class="small fw-medium text-dark">8.90€</span></td>
            <td class="py-3"><span class="badge-delivered px-2 py-1 rounded small">Doručená</span></td>
            <td class="px-4 py-3 text-end">
              <a href="#" class="btn-detail bg-secondary bg-opacity-25 border-0 px-3 py-1 rounded shadow-sm text-dark small text-decoration-none">
                Detail
              </a>
            </td>
          </tr>

          <!-- Objednávka 3 -->
          <tr>
            <td class="px-4 py-3"><span class="small fw-medium text-dark">#20260115</span></td>
            <td class="py-3"><time datetime="2026-01-15" class="small text-muted">15.01.2026</time></td>
            <td class="py-3"><span class="small text-dark">Slnečnica žltá, Tulipán ružový</span></td>
            <td class="py-3"><span class="small fw-medium text-dark">12.40€</span></td>
            <td class="py-3"><span class="badge-processing px-2 py-1 rounded small text-nowrap">Spracováva sa</span></td>
            <td class="px-4 py-3 text-end">
              <a href="#" class="btn-detail bg-secondary bg-opacity-25 border-0 px-3 py-1 rounded shadow-sm text-dark small text-decoration-none">
                Detail
              </a>
            </td>
          </tr>

          <!-- Objednávka 4 -->
          <tr>
            <td class="px-4 py-3"><span class="small fw-medium text-dark">#20251202</span></td>
            <td class="py-3"><time datetime="2025-12-02" class="small text-muted">02.12.2025</time></td>
            <td class="py-3"><span class="small text-dark">Chryzantéma biela – kvetináč</span></td>
            <td class="py-3"><span class="small fw-medium text-dark">22.50€</span></td>
            <td class="py-3"><span class="badge-pending px-2 py-1 rounded small text-nowrap">Čaká na platbu</span></td>
            <td class="px-4 py-3 text-end">
              <a href="#" class="btn-detail bg-secondary bg-opacity-25 border-0 px-3 py-1 rounded shadow-sm text-dark small text-decoration-none">
                Detail
              </a>
            </td>
          </tr>

          <!-- Objednávka 5 -->
          <tr>
            <td class="px-4 py-3"><span class="small fw-medium text-dark">#20241128</span></td>
            <td class="py-3"><time datetime="2024-11-28" class="small text-muted">28.11.2024</time></td>
            <td class="py-3"><span class="small text-dark">Levanduľa – zväzok, Fialka</span></td>
            <td class="py-3"><span class="small fw-medium text-dark">9.80€</span></td>
            <td class="py-3"><span class="badge-cancelled px-2 py-1 rounded small">Zrušená</span></td>
            <td class="px-4 py-3 text-end">
              <a href="#" class="btn-detail bg-secondary bg-opacity-25 border-0 px-3 py-1 rounded shadow-sm text-dark small text-decoration-none">
                Detail
              </a>
            </td>
          </tr>

          </tbody>
        </table>
      </div>
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
