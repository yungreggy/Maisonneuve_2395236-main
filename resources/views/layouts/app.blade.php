<!DOCTYPE html>
<html lang="fr" style="height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maisonneuve_2395236</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            padding-top: 50px;
        }

        .content {
            text-align: center;
        }
    </style>
</head>

<body style="min-height: 100%; position: relative; padding-bottom: 60px;">
<header class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="/"><img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-thumbnail" width="30" height="30"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            
            @auth
            @if(Auth::user()->is_admin)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-tachometer-alt"></i> {{ __('all.dashboard') }}
                </a>
                <div class="dropdown-menu" aria-labelledby="adminDropdown">
                    <a class="dropdown-item" href="{{ route('user.index') }}"></i> {{ __('all.list_of_admins') }}</a>
                    <a class="dropdown-item" href="{{ route('users.create') }}"><i class="fas fa-user-plus"></i> {{ __('all.add_admin') }}</a>
                </div>
            </li>
            @else
            <li class="nav-item">
            <a class="nav-link" href="{{ route('etudiants.show', auth()->user()->etudiant->id) }}">
            <i class="fas fa-user-circle"></i> {{ __('all.profile') }}
</a>

            </li>
           
            @endif
            @endauth
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-globe"></i> 
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownLang">
                    <a class="dropdown-item" href="{{ route('lang', 'en') }}">English</a>
                    <a class="dropdown-item" href="{{ route('lang', 'fr') }}">Français</a>
                </div>
            </li>
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> {{ __('all.login') }}</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">
                <i class="fas fa-sign-out-alt"></i> {{ __('all.logout') }}
            </li>
            @endguest
        </ul>
    </div>
</header>

    <br><br>

    <main class="container-fluid">
        <div class="row">
            
        @auth
<aside class="col-md-2 ml-3 bg-light p-3 rounded shadow">
    <div class="sidebar">
        <div class="list-group">
            <a href="{{ route('articles.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="fas fa-comments mr-3"></i> {{ __('all.forum') }}
            </a>
            <a href="{{ route('etudiants.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="fas fa-users mr-3"></i> {{ __('all.student_list') }}
            </a>
            
            <a href="{{ route('documents.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="fas fa-file-alt mr-3"></i> {{ __('all.documents_repository') }}</a>

            <div class="list-group-item list-group-item-action d-flex align-items-center dropdown">
                <i class="fas fa-file-alt mr-3" id="documentsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                <a href="#" class="text-decoration-none dropdown-toggle" id="documentsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ __('all.your_documents') }}</a>
                <div class="dropdown-menu" aria-labelledby="documentsDropdown">
                    

                    <a class="dropdown-item" href="{{ route('documents.index') }}">
                        <i class="fas fa-plus-circle mr-2"></i> {{ __('all.add_document') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</aside>
@endauth



            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </main>

 <footer class="footer" style="position: absolute; bottom: 0; width: 100%; height: 60px; background-color: #343a40; color: #ffffff; padding: 20px 0;">
        <div class="container text-center small">
            <span>&copy; 2024 Maisonneuve_2395236. {{ __('all.all_rights_reserved') }}.</span>
        </div>
    </footer>
    <script>
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>

</body>
</html>