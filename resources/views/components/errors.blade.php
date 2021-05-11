@if ($errors && count($errors) > 0)
    <div class="card card-danger">
        <div class="card-body">
            <div class="card-title text-danger mb-3">
                <b>Errors</b>
            </div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif