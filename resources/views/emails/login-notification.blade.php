<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Notification</title>
</head>

<body>
    <header>
        <h2>Login Notification</h2>
    </header>

    <div class="content">
        <p>Hello {{ $user->name }}</p>

        <div class="info">
            <p>Login Details</p><br>
            Email: {{ $user->email }}
            Time: {{ $loginTime }}
            Role: {{ $user->role ?? 'user' }}
        </div>

        <p>From, <br>
            {{ config('app.name') }} App</p>
    </div>
</body>

</html>
