<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>

    @guest
        <p>hello guest</p>    
    @endguest

    <p>successful login!</p>
    {{-- <p>hello {{ dd(auth()->user()) }}</p> --}}
    <p>hello {{ Auth::user()->first_name }}</p>
    <p>hello {{ auth()->user()->staff_id}}</p>

    @auth
        <p>hello admin</p>
    @endauth 


</body>
</html>