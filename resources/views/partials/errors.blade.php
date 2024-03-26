@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Attention !</strong> Il y a des problèmes avec votre saisie.
    
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
