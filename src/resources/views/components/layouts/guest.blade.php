<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
</head>
<body class="bg-cream font-sans text-neutral-900 min-h-screen flex flex-col items-center justify-center px-4">

    <a href="/" class="font-serif text-3xl font-semibold tracking-tight mb-10">
        Box<span class="text-bark">Store</span>
    </a>

    <div class="w-full max-w-sm bg-white rounded-2xl border border-neutral-200 p-8">
        {{ $slot }}
    </div>

</body>
</html>
