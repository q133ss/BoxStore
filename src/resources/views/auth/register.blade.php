<x-layouts.guest title="Регистрация">

    <h1 class="font-serif text-2xl font-semibold text-neutral-900 mb-6">Регистрация</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-xs font-medium uppercase tracking-widest text-neutral-400 mb-1.5">Имя</label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                autofocus
                autocomplete="name"
                class="w-full bg-cream border border-neutral-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-bark focus:ring-1 focus:ring-bark transition-colors @error('name') border-red-400 @enderror"
            >
            @error('name')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-xs font-medium uppercase tracking-widest text-neutral-400 mb-1.5">Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                autocomplete="email"
                class="w-full bg-cream border border-neutral-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-bark focus:ring-1 focus:ring-bark transition-colors @error('email') border-red-400 @enderror"
            >
            @error('email')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-xs font-medium uppercase tracking-widest text-neutral-400 mb-1.5">Пароль</label>
            <input
                type="password"
                name="password"
                autocomplete="new-password"
                class="w-full bg-cream border border-neutral-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-bark focus:ring-1 focus:ring-bark transition-colors @error('password') border-red-400 @enderror"
            >
            @error('password')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-xs font-medium uppercase tracking-widest text-neutral-400 mb-1.5">Повторите пароль</label>
            <input
                type="password"
                name="password_confirmation"
                autocomplete="new-password"
                class="w-full bg-cream border border-neutral-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-bark focus:ring-1 focus:ring-bark transition-colors"
            >
        </div>

        <button type="submit" class="w-full py-2.5 bg-neutral-900 text-white text-sm font-medium rounded-lg hover:bg-bark transition-colors duration-200">
            Создать аккаунт
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-neutral-400">
        Уже есть аккаунт?
        <a href="{{ route('login') }}" class="text-neutral-700 underline underline-offset-4 hover:text-bark transition-colors">Войти</a>
    </p>

</x-layouts.guest>
