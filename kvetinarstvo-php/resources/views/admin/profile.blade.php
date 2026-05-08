<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KVETY - Profil</title>

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

        .profile-avatar-frame {
            width: 10rem;
            height: 10rem;
        }

        .action-button {
            transition: background-color 0.2s, color 0.2s;
            cursor: pointer;
        }
        .action-button:hover {
            background-color: var(--primary-accent) !important;
            color: #fff !important;
        }
		.admin-header {
            background-color: #1a1a1a;
            color: white;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-white">

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

<main class="container py-5 flex-grow-1">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}" class="text-decoration-none text-muted">Administrácia</a></li>
            <li class="breadcrumb-item active text-muted" aria-current="page">Profile</li>
        </ol>
    </nav>

    <section class="row g-4 align-items-stretch" aria-label="Profil používateľa">

        <!-- avatar, meno-->
        <div class="col-lg-5">
            <div class="bg-light p-5 rounded shadow-sm d-flex flex-column align-items-center text-center h-100">

                <!-- Avatar -->
                <figure class="mb-3">
                    <div class="profile-avatar-frame bg-white border border-secondary rounded-circle overflow-hidden d-flex align-items-center justify-content-center shadow-sm">
                        <img src="{{ asset('img/profile.png') }}"
                                                     alt="Profilová fotografia používateľa"
                                                     class="w-100 h-100 object-fit-cover">
                                            </div>
                </figure>

                <!-- Meno -->
                <h1 id="user-display-name" class="fw-normal fs-4 mb-3">{{ Auth::user()->name }} {{ Auth::user()->surname }}</h1>

                <!-- Status -->
                <p>
					<span id="user-status-label" class="bg-secondary ms-3 rounded-pill badge bg-danger fs-6 mall d-inline-block shadow-sm">
						ADMIN
					</span>
                </p>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="bg-light p-5 rounded shadow-sm h-100 d-flex flex-column">

                <h2 class="h5 mb-4 pb-2 border-bottom text-dark">Contact Information</h2>

                <table class="table table-borderless mb-5 bg-transparent" style="--bs-table-bg: transparent;">
                    <tbody>
                    <!-- E-mail -->
                    <tr>
                        <td class="text-muted w-25 align-middle">E-mail:</td>
                        <td class="fw-medium text-dark text-sm-end" id="user-email">
                            <a class="text-dark text-decoration-none">{{ Auth::user()->email }}</a>
                        </td>
                    </tr>

                    <!-- Telefón -->
                    <tr>
                        <td class="text-muted w-25 align-middle">Phone:</td>
                        <td class="fw-medium text-dark text-sm-end" id="user-phone">
                            +421 912 345 678
                        </td>
                    </tr>

                    <!-- Adresa -->
                    <tr>
                        <td class="text-muted w-25 align-middle">Address:</td>
                        <td class="fw-medium text-dark text-sm-end" id="user-address">
                            Ilkovičova 2<br>841 04 Bratislava
                        </td>
                    </tr>

                    <!-- Členom od -->
                    <tr>
                        <td class="text-muted w-25 align-middle">Member since:</td>
                        <td class="fw-medium text-dark text-sm-end" id="user-reg-date">
                            {{ Auth::user()->created_at->format('F Y') }}
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="mt-auto text-center">
                    <button id="edit_profile"
                            type="button"
                            class="action-button bg-secondary bg-opacity-25 border-0 px-5 py-2 rounded shadow-sm text-dark">
                        change info
                    </button>
                </div>

            </div>
        </div>

    </section>

</main>

	<!-- FOOTER -->
    <footer class="bg-white py-4 border-top mt-auto">
        <div class="container">
            <div class="text-center small text-muted">
                Kvetinárstvo.sk • Administrátorské rozhranie • Demo 2026
            </div>
        </div>
    </footer>

</body>
</html>
