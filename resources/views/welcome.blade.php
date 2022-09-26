<!DOCTYPE html>

<head>
    <title>Pusher Test</title>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    @if (true)
        <script>
            // Enable pusher logging - don't include this in production
            // Pusher.logToConsole = true;

            var pusher = new Pusher('1e6672fa5d101a2a910c', {
                cluster: 'ap2'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                // alert(JSON.stringify(data));
                $.ajax({
                    url: '/nots',
                    type: 'GET',
                    headers: {
                        'X-CSRF-Token': $('meta[name=_token]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        let html = '<ul>';
                        data.forEach(element => {
                            html += '<li>' + element.created_at + '</li>';
                        });
                        html += '</ul>';
                        console.log(html);
                        $('#notifications').html(html);
                    },
                    error: function(xhr, b, c) {
                        console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                    }
                });
            });
        </script>
    @endif
</head>

<body>
    <h1>Pusher Test</h1>
    <p>
        Try publishing an event to channel <code>my-channel</code>
        with event name <code>my-event</code>.
    </p>
    <div id="notifications"></div>
</body>
