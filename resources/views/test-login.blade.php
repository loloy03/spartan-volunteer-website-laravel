<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    {{ dd(auth('staff')->user()) }}

    <h1>
        HELLO! STAFF {{ Auth::guard('staff')->user()->first_name }}
                        {{auth('staff')->user()->first_name}}
    </h1>
    <h4>
        {{ Auth::guard('staff')->user()->email }}
    </h4>
    <h6>
        STAFF ID: {{ Auth::guard('staff')->user()->staff_id }}
    </h6>

</body>
</html>