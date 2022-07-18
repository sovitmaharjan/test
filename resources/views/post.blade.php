x<html>

<head>
    <title>Post</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container">
        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="my-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="" required>
            </div>
            <div class="my-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" value="" required>
            </div>
            <div class="my-3">
                <label for="description" class="form-label">First name</label>
                <textarea class="form-control" rows="7" id="description" name="description" required></textarea>
            </div>
            <div class="my-3">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
        <table>
            <tbody>
                @foreach ($post as $value)
                    <tr>
                        <td>
                            <?php 
                                print_r(json_decode($value->description))
                            ?>
                            {{-- pic: 
                            <a href="{{ $value->getFirstMediaUrl('media') }}">
                                {{ $value->getFirstMediaUrl('media') }}
                            </a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
