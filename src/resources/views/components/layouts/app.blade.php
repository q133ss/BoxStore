<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'BoxStore' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serif: ['Playfair Display', 'Georgia', 'serif'],
                        sans:  ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        cream: '#F7F4F0',
                        bark:  '#7C6E5A',
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-cream font-sans text-neutral-900 min-h-screen">

<header class="bg-white border-b border-neutral-200">
    <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
        <a href="{{ route('notes.index') }}" class="font-serif text-2xl font-semibold tracking-tight">
            Box<span class="text-bark">Store</span>
        </a>
        <div class="flex items-center gap-5">
            <span class="text-sm text-neutral-400">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-neutral-400 hover:text-bark transition-colors">Выйти</button>
            </form>
        </div>
    </div>
</header>

<main class="max-w-6xl mx-auto px-6 py-10">
    @if(session('success'))
        <div class="mb-8 px-5 py-3 bg-white border border-neutral-200 text-neutral-600 rounded-lg text-sm flex items-center gap-2">
            <span class="w-1.5 h-1.5 rounded-full bg-green-400 shrink-0"></span>
            {{ session('success') }}
        </div>
    @endif

    {{ $slot }}
</main>

</body>
</html>
