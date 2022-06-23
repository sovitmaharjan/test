<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" href="{{ asset('bootstrap.css') }}">
    </head>
    <body>
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>From</th>
                        <th>To</th>
                        <th>status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($route as $key => $value)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $value->fromLocation->city }}</td>
                            <td>{{ $value->toLocation->city }}</td>
                            <td>{{ $value->status }}</td>
                            <td>
                                <a href="{{ route('route-detail', $value->id) }}" class="btn btn-primary">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>
