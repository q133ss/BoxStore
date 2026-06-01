<x-layouts.guest title="Войти">

    <h1 class="font-serif text-2xl font-semibold text-neutral-900 mb-6">Войти</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-xs font-medium uppercase tracking-widest text-neutral-400 mb-1.5">Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                autofocus
                autocomplete="email"
                class="w-full bg-cream border border-neutral-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-bark focus:ring-1 focus:ring-bark transition-colors @error('email') border-red-400 @enderror"
            >
            @error('email')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-xs font-medium uppercase tracking-widest text-neutral-400 mb-1.5">Пароль</label>
            <input
                type="password"
                name="password"
                autocomplete="current-password"
                class="w-full bg-cream border border-neutral-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-bark focus:ring-1 focus:ring-bark transition-colors @error('password') border-red-400 @enderror"
            >
            @error('password')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between mb-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember" class="rounded border-neutral-300 text-bark focus:ring-bark">
                <span class="text-sm text-neutral-500">Запомнить меня</span>
            </label>
        </div>

        <button type="submit" class="w-full py-2.5 bg-neutral-900 text-white text-sm font-medium rounded-lg hover:bg-bark transition-colors duration-200">
            Войти
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-neutral-400">
        Нет аккаунта?
        <a href="{{ route('register') }}" class="text-neutral-700 underline underline-offset-4 hover:text-bark transition-colors">Зарегистрироваться</a>
    </p>

</x-layouts.guest>
