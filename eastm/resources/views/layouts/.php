
<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Steam Clone')</title>
<!-- Tailwind CDN (prototype) -->
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100">
<header class="bg-gray-800">
<div class="container mx-auto p-4 flex items-center justify-between">
<a href="{{ route('home') }}" class="text-2xl font-bold">GameStore</a>
<nav class="space-x-4">
<a href="#" class="text-sm">Store</a>
<a href="#" class="text-sm">Community</a>
<a href="#" class="text-sm">Library</a>
</nav>
</div>
</header>


<main class="container mx-auto p-4">
@yield('content')
    </main>


<footer class="text-center p-4 text-sm text-gray-400">
&copy; {{ date('Y') }} GameStore
</footer>
</body>
</html>
