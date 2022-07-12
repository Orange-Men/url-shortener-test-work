<!DOCTYPE html>
<html>
<head>
    <title>Test work url-shortener </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <form method="POST" action="{{ route('shortener.store') }}">
                @csrf
                <div class="row g-3 align-items-center mb-2">
                    <div class="col-auto">
                        <label for="link" class="col-form-label">Link</label>
                    </div>
                    <div class="col-auto w-50">
                        <input type="text" id="link" class="form-control" name="link">
                    </div>
                    <div class="col-auto">
                        <span class="form-text">
                            Link that will be shortened
                        </span>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="redirection_limit" class="col-form-label">Redirection limit</label>
                    </div>
                    <div class="col-auto w-25">
                        <input type="number" id="redirection_limit" class="form-control" name="redirection_limit">
                    </div>
                    <div class="col-auto">
                        <label for="lifetime_limit" class="col-form-label">Lifetime limit</label>
                    </div>
                    <div class="col-auto w-25">
                        <input type="number" id="lifetime_limit" class="form-control" name="lifetime_limit" max="24">
                    </div>
                    <div class="col-auto">
                        <span class="form-text">
                            In hours
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Generate Link</button>
            </form>
        </div>
        <div class="card-body">

            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <p class="m-0">{{ Session::get('success') }}</p>
                </div>
            @endif

            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger" role="alert"><p class="m-0">:message</p></div>')) !!}
            @endif

            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Short Link</th>
                    <th>Link</th>
                    <th>Redirection limit</th>
                    <th>Lifetime limit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($shortLinks as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td><a href="{{ route('shortener.link', $row->code) }}" target="_blank">{{ route('shortener.link', $row->code) }}</a></td>
                        <td>{{ $row->link }}</td>
                        <td>{{ is_null($row->redirection_limit) ? '∞' : $row->redirection_limit }}</td>
                        <td>{{ $row->lifetime_limit }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
