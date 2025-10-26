<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
<div class="container mt-5">
    <img src="{{ asset('img/Meat.png') }}" alt="Meat Logo" width="150">
    <h2>Welcome, {{ Auth::user()->username }}</h2>
    <p>You are logged in as {{ Auth::user()->email }}</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger mt-3">Logout</button>
    </form>
</div>
</body>
</html>
