<!DOCTYPE html>
<html>

<head>
    <title>Pusher Test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('1e6672fa5d101a2a910c', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('form-submitted', function(data) {
            alert(JSON.stringify(data));
        });
    </script>
</head>

<body>
    <h1>Pusher Test</h1>
    <p>
        Try publishing an event to channel <code>my-channel</code>
        with event name <code>my-event</code>.
    </p>
</body>

</html>
