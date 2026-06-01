@php
    $colors = ['#7C6E5A', '#A8C84A', '#5BB8D4', '#C4567A', '#F0A500', '#2D2D2D'];
    $currentColor = old('color', $note->color ?? '#7C6E5A');
@endphp

<div x-data="{ color: '{{ $currentColor }}' }">
    <input type="hidden" name="color" :value="color">

    {{-- Title --}}
    <div class="mb-5">
        <label class="block text-xs font-medium uppercase tracking-widest text-neutral-400 mb-1.5">Заголовок</label>
        <input
            type="text"
            name="title"
            value="{{ old('title', $note->title ?? '') }}"
            class="w-full bg-cream border border-neutral-200 rounded-lg px-4 py-2.5 text-sm text-neutral-900 placeholder-neutral-300 focus:outline-none focus:border-bark focus:ring-1 focus:ring-bark transition-colors @error('title') border-red-400 @enderror"
            placeholder="Введите заголовок"
        >
        @error('title')
            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Content --}}
    <div class="mb-5">
        <label class="block text-xs font-medium uppercase tracking-widest text-neutral-400 mb-1.5">Содержимое</label>
        <textarea
            name="content"
            rows="7"
            class="w-full bg-cream border border-neutral-200 rounded-lg px-4 py-2.5 text-sm text-neutral-900 placeholder-neutral-300 focus:outline-none focus:border-bark focus:ring-1 focus:ring-bark transition-colors resize-none @error('content') border-red-400 @enderror"
            placeholder="Текст заметки..."
        >{{ old('content', $note->content ?? '') }}</textarea>
        @error('content')
            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Color picker --}}
    <div class="mb-8">
        <label class="block text-xs font-medium uppercase tracking-widest text-neutral-400 mb-2">Цвет метки</label>
        <div class="flex gap-3 items-center">
            @foreach($colors as $c)
                <button
                    type="button"
                    @click="color = '{{ $c }}'"
                    class="w-6 h-6 rounded-full transition-all duration-150"
                    :class="color === '{{ $c }}' ? 'ring-2 ring-offset-2 ring-neutral-400 scale-125' : 'opacity-70 hover:opacity-100 hover:scale-110'"
                    style="background-color: {{ $c }}"
                ></button>
            @endforeach
        </div>
        @error('color')
            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Actions --}}
    <div class="flex gap-3">
        <button type="submit" class="px-6 py-2.5 bg-neutral-900 text-white text-sm font-medium rounded-lg hover:bg-bark transition-colors duration-200">
            Сохранить
        </button>
        <a href="{{ route('notes.index') }}" class="px-6 py-2.5 border border-neutral-200 text-neutral-500 text-sm font-medium rounded-lg hover:border-neutral-300 hover:text-neutral-700 transition-colors duration-200">
            Отмена
        </a>
    </div>
</div>
