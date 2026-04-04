<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KVETY - Detail produktu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-accent: #d63384;
        }

        .quantity-display::-webkit-outer-spin-button,
        .quantity-display::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .quantity-display {
            -moz-appearance: textfield;
            width: 3rem;
            height: 3rem;
        }

        .cursor-pointer { cursor: pointer; }

        .interaction-icon { transition: transform 0.2s; }
        .interaction-icon:hover {
            transform: scale(1.1);
            color: var(--primary-accent) !important;
        }

        /* Responzívna veľkosť ikon - zhodná s headerom */
        .interaction-icon .bi {
            font-size: 1.25rem;
        }
        @media (min-width: 576px) {
            .interaction-icon .bi {
                font-size: 1.5rem;
            }
        }

        .recommendation-card { transition: opacity 0.2s; }
        .recommendation-card:hover { opacity: 0.8; }

        .logo-placeholder {
            font-size: 1.8rem;
            font-weight: 900;
        }

        .thumbnail-wrapper {
            width: 5rem;
            height: 5rem;
            overflow: hidden;
            border: 2px solid #dee2e6;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .thumbnail-wrapper:hover {
            border-color: var(--primary-accent);
        }
        .thumbnail-wrapper.active {
            border-color: var(--primary-accent);
        }

        /* Akčné tlačidlá (množstvo) */
        .btn-action {
            background: none;
            border: none;
            padding: 0;
            transition: color 0.2s;
        }
        .btn-action:hover { color: var(--primary-accent) !important; }


        .product-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: #f8f9fa;
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
                            <span class="ms-3 fw-bold fs-4 text-dark">kvetinarstvo.sk</span>
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

    <!-- Horná sekcia: galéria + akcie -->
    <section class="row g-4 align-items-stretch" aria-label="Detail produktu">

        <!-- Galéria produktu -->
        <div class="col-lg-5">
            <div class="bg-light p-4 rounded h-100 d-flex flex-column align-items-center justify-content-center shadow-sm">

                <!-- Hlavný obrázok -->
                <figure class="w-100 mb-3 text-center">
                    <div class="bg-white border border-secondary overflow-hidden d-flex align-items-center justify-content-center shadow-sm mx-auto"
                         style="max-width: 25rem; aspect-ratio: 1/1;">
                        <img id="main-image"
                             src="img/kvet.jpg"
                             alt="Fotografia produktu - Karafiát biely"
                             class="w-100 h-100 object-fit-cover">
                    </div>
                    <figcaption id="main-flower-name" class="bg-secondary bg-opacity-25 px-4 py-2 fs-5 fw-medium d-inline-block mt-3 rounded">
                        Karafiát biely – kytica
                    </figcaption>
                </figure>

                <!-- Thumbnaily - ďalšie fotografie produktu -->
                <div class="d-flex gap-2 justify-content-center flex-wrap" aria-label="Ďalšie fotografie produktu">
                    <button type="button" class="thumbnail-wrapper active p-0" aria-label="Náhľad 1">
                        <img src="img/kvet.jpg" alt="Fotografia produktu 1" class="w-100 h-100 object-fit-cover">
                    </button>
                    <button type="button" class="thumbnail-wrapper p-0" aria-label="Náhľad 2">
                        <img src="img/cactus_2.jpg" alt="Fotografia produktu 2" class="w-100 h-100 object-fit-cover">
                    </button>
                    <button type="button" class="thumbnail-wrapper p-0" aria-label="Náhľad 3">
                        <img src="img/cactus_2.jpg" alt="Fotografia produktu 3" class="w-100 h-100 object-fit-cover">
                    </button>
                    <button type="button" class="thumbnail-wrapper p-0" aria-label="Náhľad 4">
                        <img src="img/cactus_2.jpg" alt="Fotografia produktu 4" class="w-100 h-100 object-fit-cover">
                    </button>
                </div>

            </div>
        </div>

        <!-- Cena, množstvo, krátky popis -->
        <div class="col-lg-7 d-flex flex-column">

            <!-- Cena + ovládacie prvky -->
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                <p id="main-price" class="bg-secondary bg-opacity-25 px-4 py-2 fs-5 fw-bold d-inline-block shadow-sm m-0 rounded">
                    14.52€
                </p>

                <div class="d-flex align-items-center gap-3 gap-md-4">
                    <!-- Výber množstva -->
                    <div class="d-flex align-items-center gap-2">
                        <label for="main-quantity" class="visually-hidden">Množstvo</label>
                        <button type="button" class="btn-action fs-4 fw-bold text-dark" aria-label="Znížiť množstvo">—</button>
                        <input type="number" id="main-quantity" class="quantity-display bg-secondary bg-opacity-25 border-0 rounded-circle text-center fw-bold shadow-sm" value="1" min="1">
                        <button type="button" class="btn-action fs-4 fw-bold text-dark" aria-label="Zvýšiť množstvo">+</button>
                    </div>

                    <!-- Pridať do košíka -->
                    <a href="#" class="text-dark interaction-icon" aria-label="Pridať do košíka" role="button">
                        <i class="bi bi-cart-plus fs-3"></i>
                    </a>

                    <!-- Pridať do wishlistu -->
                    <a href="#" class="text-dark interaction-icon" aria-label="Pridať do obľúbených" role="button">
                        <i class="bi bi-heart fs-3"></i>
                    </a>
                </div>
            </div>

            <!-- Krátky popis -->
            <div class="bg-light p-4 rounded flex-grow-1 d-flex align-items-center justify-content-center text-center shadow-sm">
                <p id="short-description" class="fs-5 fw-light m-0">
                    Nádherná kytica bielych karafiátov, ktorá zaručene poteší vašich blízkych.
                    Kvety sú vždy čerstvé, starostlivo aranžované našimi floristami a doručované
                    s maximálnou opatrnosťou pre zachovanie ich krásy.
                </p>
            </div>

        </div>
    </section>

    <!-- Detailný popis -->
    <section class="row mt-4" aria-label="Detailný popis produktu">
        <div class="col-12">
            <div class="bg-light p-5 rounded shadow-sm">
                <h2 class="h5 fw-semibold mb-3">Detailný popis</h2>
                <p id="full-description" class="fs-5 fw-light m-0">
                    Biele karafiáty symbolizujú čistotu, šťastie a úprimnú lásku. Táto exkluzívna
                    kytica sa skladá z prémiových kvetov dovezených priamo od lokálnych pestovateľov.
                    Vďaka ich vysokej trvácnosti vám pri správnej starostlivosti (pravidelná výmena vody
                    a zastrihávanie stoniek) vydržia vo váze svieže až dva týždne. Kytica je dodávaná
                    v elegantnom balení s možnosťou pridať osobné venovanie.
                </p>
            </div>
        </div>
    </section>

    <!-- Súvisiace produkty -->
    <section class="mt-5" aria-label="Súvisiace produkty">
        <h2 class="h5 fw-semibold mb-4">Mohlo by vás zaujímať</h2>

        <div class="row g-4 justify-content-center" id="related-row">

            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow">
                    <img src="./img/rose.jpg" alt="Rose Elegance" class="product-img">
                    <div class="card-body text-center p-3">
                        <p class="mb-1 fw-medium">Rose Elegance</p>
                        <p class="text-muted mb-0">12.99€</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow">
                    <img src="./img/orchid.jpg" alt="Orchid Grace" class="product-img">
                    <div class="card-body text-center p-3">
                        <p class="mb-1 fw-medium">Orchid Grace</p>
                        <p class="text-muted mb-0">18.75€</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow">
                    <img src="./img/lily.jpg" alt="Lily Serenity" class="product-img">
                    <div class="card-body text-center p-3">
                        <p class="mb-1 fw-medium">Lily Serenity</p>
                        <p class="text-muted mb-0">13.80€</p>
                    </div>
                </div>
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
