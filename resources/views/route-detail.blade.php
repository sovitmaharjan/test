<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" href="{{ asset('bootstrap.css') }}">
    </head>
    <body>
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <h3>{{ $route_detail->fromLocation->city }} to {{ $route_detail->toLocation->city }}</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Sub Location</th>
                        <th>status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @dd($route_detail->subLocation) --}}
                    @foreach ($route_detail->subLocation as $key => $value)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $value->city }}</td>
                            <td>{{ $value->pivot->status }}</td>
                            <td>
                                <a href="{{ route('route-detail-edit',[$route_detail->id, $value->id]) }}" class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>
