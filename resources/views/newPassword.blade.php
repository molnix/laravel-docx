<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Password</title>
</head>
<body>
    <form method="post">
        @csrf
        <input type="text" name="password" type="password">
        <input type="submit">
    </form>
    @if(session('password'))
        <p>{{session('password')}}</p>
    @endif
</body>
</html>