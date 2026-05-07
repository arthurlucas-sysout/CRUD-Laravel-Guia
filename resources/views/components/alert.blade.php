@php

    $success = session('success');

    $error = session('error');

    $errorsList = $errors->all();

@endphp

@if ($success)


    <div class="alert alert-success" role="alert">
        {{ $success }}
    </div>


@elseif ($error)

    <div class="alert alert-danger" role="alert">
        {{ $error }}
    </div>

@elseif (count($errorsList) > 0)

    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errorsList as $error)
            {{ $error }}
            @endforeach
        </ul>
    </div>

@endif
