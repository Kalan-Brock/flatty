<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>flatty. Examples</title>
</head>
<body>
    <p>Person: <span class="person"></span></p>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="/flatty/js/flatty.js"></script>
    <script>
        $(document).ready( function() {
            var db = new flatty();

            db.get("people", "1").then(function(response) {
                $("span.person").text(JSON.parse(response));
            }, function(error) {
                console.log(error);
            });
        });
    </script>
</body>
</html>