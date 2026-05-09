<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upraviť produkt: {{ $product->name }}</title>

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

        .admin-header {
            background-color: #1a1a1a;
            color: white;
        }

        /* Štýly pre klikateľné obrázkové boxy (dropzone náhrada) */
        .image-upload-wrapper {
            width: 5.5rem;
            height: 5.5rem;
            position: relative;
            border: 2px dashed #adb5bd;
            border-radius: 0.375rem;
            overflow: hidden;
            cursor: pointer;
            background-color: #f8f9fa;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-upload-wrapper:hover {
            border-color: var(--primary-accent);
            background-color: #fff;
        }

        /* Samotný file input je natiahnutý na celú veľkosť wrapperu, ale je neviditeľný */
        .image-upload-wrapper input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 10;
        }

        .image-upload-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .upload-icon {
            color: #6c757d;
            z-index: 2;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            width: 3rem;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-upload-wrapper:hover .upload-icon {
            color: var(--primary-accent);
        }

        /* Úprava pre inputy, aby zapadli do dizajnu */
        .editable-input {
            background: rgba(255, 255, 255, 0.9);
            border: 1px dashed #ccc;
            transition: border-color 0.2s;
        }
        .editable-input:focus {
            border-color: var(--primary-accent);
            box-shadow: none;
            outline: none;
            background: #fff;
        }
        .editable-textarea {
            resize: vertical;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-white">

    <!-- HEADER - ADMIN -->
    <header class="border-bottom admin-header shadow-sm">
        <div class="container py-3">
            <div class="d-flex align-items-center">
                <a href="{{ route('admin.products.index') }}" class="d-flex align-items-center text-decoration-none text-white me-auto">
                    <span class="logo-placeholder text-danger">LOGO</span>
                    <span class="ms-3 fw-bold fs-4">kvetinarstvo.sk</span>
                    <span class="ms-3 badge bg-danger fs-6">ADMIN</span>
                </a>
                <div class="d-flex gap-3 align-items-center">
                    <a href="{{ route('admin.products.index') }}" class="text-white text-decoration-none fw-medium">Produkty</a>
                    <a href="{{ route('admin.profile') ?? '#' }}" class="text-white">
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

<main class="container py-5 flex-grow-1">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zavrieť"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}" class="text-decoration-none text-muted">Produkty</a></li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Úprava: {{ $product->name }}</li>
            </ol>
        </nav>
    </div>

    <!-- FORMULÁR NA ÚPRAVU PRODUKTU -->
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <section class="row g-4 align-items-stretch" aria-label="Detail produktu">

            <!-- Ľavý stĺpec: Obrázky -->
            <div class="col-lg-5">
                <div class="bg-light p-4 rounded h-100 d-flex flex-column align-items-center justify-content-center shadow-sm border">

                    <figure class="w-100 mb-4 text-center">
                        <div class="bg-white border border-secondary overflow-hidden d-flex align-items-center justify-content-center shadow-sm mx-auto mb-3"
                             style="max-width: 25rem; aspect-ratio: 1/1;">
                            <img src="{{ asset($product->images->first()?->path ?? 'img/placeholder.svg') }}"
                                 alt="Fotografia produktu - {{ $product->name }}"
                                 class="w-100 h-100 object-fit-cover">
                        </div>

                        <!-- Názov -->
                        <div class="w-100 px-3">
                            <label class="form-label small text-muted fw-bold">Názov produktu</label>
                            <input type="text" name="name" value="{{ $product->name }}" class="form-control editable-input text-center fs-5 fw-medium" required>
                        </div>
                    </figure>

                                        <div class="w-100 border-top pt-3 text-center">
                                            <label class="form-label small text-muted fw-bold mb-2">Nahradiť fotografie (Kliknite na políčka)</label>
                                            <div class="form-text small mb-3">Kliknite na obrázok, ktorý chcete nahradiť. Ostatné ostanú zachované.</div>

                                            <div class="d-flex gap-3 justify-content-center flex-wrap">

                                                @for($i = 0; $i < 4; $i++)
                                                    @php
                                                        $existingImage = $product->images->get($i);
                                                    @endphp

                                                    <div class="image-upload-wrapper" title="Kliknite pre nahratie obrázka {{ $i + 1 }}">
                                                        @if($existingImage)
                                                            <img src="{{ asset($existingImage->path) }}" alt="Náhľad">

                                                            <input type="hidden" name="existing_images[{{ $i }}]" value="{{ $existingImage->id }}">
                                                        @endif


                                                        <input type="file" name="image_{{ $i }}" accept="image/*">

                                                        <i class="bi bi-cloud-arrow-up fs-3 upload-icon"></i>
                                                    </div>
                                                @endfor

                                            </div>
                                        </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Pravý stĺpec: Editovateľné dáta -->
            <div class="col-lg-7 d-flex flex-column">

                <!-- Horná lišta: Cena a Množstvo -->
                <div class="d-flex align-items-end justify-content-between flex-wrap gap-3 mb-4 p-3 bg-light rounded shadow-sm border">
                    <div class="flex-grow-1" style="max-width: 150px;">
                        <label class="form-label small text-muted fw-bold mb-1">Cena (€)</label>
                        <div class="input-group">
                            <input type="number" name="price" value="{{ $product->price }}" step="0.01" min="0" class="form-control editable-input fs-5 fw-bold" required>
                            <span class="input-group-text bg-white border-dashed border-start-0">€</span>
                        </div>
                    </div>

                    <div class="flex-grow-1" style="max-width: 150px;">
                        <label class="form-label small text-muted fw-bold mb-1">Na sklade (ks)</label>
                        <input type="number" name="quantity_available" value="{{ $product->quantity_available }}" min="0" class="form-control editable-input fs-5" required>
                    </div>

                    <div class="flex-grow-1 d-flex gap-2">
                        <div class="w-50">
                            <label class="form-label small text-muted fw-bold mb-1">Kategória</label>
                            <select name="category_id" class="form-select editable-input" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-50">
                            <label class="form-label small text-muted fw-bold mb-1">Farba</label>
                            <select name="color_id" class="form-select editable-input" required>
                                @foreach($colors as $color)
                                    <option value="{{ $color->id }}" {{ $color->id == $product->color_id ? 'selected' : '' }}>
                                        {{ $color->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Krátky popis -->
                <div class="bg-light p-4 rounded flex-grow-1 d-flex flex-column shadow-sm border mb-4">
                    <label class="form-label small text-muted fw-bold">Krátky popis</label>
                    <textarea name="short_description" class="form-control editable-input editable-textarea flex-grow-1 fs-5 fw-light" rows="3" required>{{ $product->short_description }}</textarea>
                </div>

            </div>
        </section>

        <!-- Detailný popis -->
        <section class="row mt-4" aria-label="Detailný popis produktu">
            <div class="col-12">
                <div class="bg-light p-4 p-md-5 rounded shadow-sm border">
                    <label class="h5 fw-semibold mb-3 d-block text-dark">Detailný popis</label>
                    <textarea name="full_description" class="form-control editable-input editable-textarea fs-5 fw-light" rows="6" required>{{ $product->full_description }}</textarea>
                </div>
            </div>
        </section>

        <!-- Odosielacie tlačidlá -->
        <div class="d-flex justify-content-end gap-3 mt-5 pb-5">
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary px-4 py-2 shadow-sm">Zrušiť úpravy</a>
            <button type="submit" class="btn btn-success px-5 py-2 shadow-sm fw-bold">
                <i class="bi bi-save me-2"></i> Uložiť zmeny
            </button>
        </div>

    </form>
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
    <script>
    document.querySelectorAll('.image-upload-wrapper input[type="file"]').forEach(function(input) {
        input.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                var wrapper = this.closest('.image-upload-wrapper');
                var img = wrapper.querySelector('img');
                img.src = URL.createObjectURL(this.files[0]);
            }
        });
    });
    </script>
</body>
</html>
