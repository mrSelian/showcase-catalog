@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="container">
        <div class="alert alert-danger">
            <strong>Ошибка!</strong>
            <br>
            <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
            </ul>
        </div>
    </div>
@endif

@if( Session::has( 'success' ))
    <!-- Form Error List -->
    <div class="container">
        <div class="alert alert-success">
            <br>
            <ul>
                    {{ Session::get( 'success' ) }}
            </ul>
        </div>
    </div>
@endif
