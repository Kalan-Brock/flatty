<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>flatty. Examples</title>
</head>
<body>

    <script src="/flatty/js/flatty.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var db = new flatty();

            db.get("people", "1").then(function(response) {
                console.log(JSON.parse(response));
            }, function(error) {
                console.log(error);
            });

        });
    </script>
</body>
</html>