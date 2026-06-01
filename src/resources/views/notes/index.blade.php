<x-layouts.app title="Заметки">

    {{-- Header --}}
    <div class="flex items-end justify-between mb-8">
        <div>
            <h1 class="font-serif text-3xl font-semibold text-neutral-900">Заметки</h1>
            <p class="text-sm text-neutral-400 mt-1">{{ $notes->total() }} {{ trans_choice('заметка|заметки|заметок', $notes->total()) }}</p>
        </div>
        <a href="{{ route('notes.create') }}" class="px-5 py-2.5 bg-neutral-900 text-white text-sm font-medium rounded-lg hover:bg-bark transition-colors duration-200">
            + Новая заметка
        </a>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('notes.index') }}" class="mb-8">
        <div class="relative max-w-sm">
            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                placeholder="Поиск по заголовку..."
                class="w-full bg-white border border-neutral-200 rounded-lg pl-4 pr-10 py-2.5 text-sm text-neutral-900 placeholder-neutral-300 focus:outline-none focus:border-bark focus:ring-1 focus:ring-bark transition-colors"
            >
            @if(request('q'))
                <a href="{{ route('notes.index') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-neutral-300 hover:text-neutral-500 text-lg leading-none">×</a>
            @else
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-neutral-300 hover:text-neutral-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
            @endif
        </div>
    </form>

    {{-- Grid --}}
    @if($notes->isEmpty())
        <div class="py-20 text-center">
            <p class="font-serif text-2xl text-neutral-300 mb-2">Заметок пока нет</p>
            <p class="text-sm text-neutral-300">
                <a href="{{ route('notes.create') }}" class="underline underline-offset-4 hover:text-bark transition-colors">Создать первую →</a>
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-10">
            @foreach($notes as $note)
                <div
                    x-data="{ pinned: {{ $note->is_pinned ? 'true' : 'false' }}, loading: false }"
                    class="group bg-white rounded-2xl border border-neutral-200 overflow-hidden flex flex-col hover:shadow-md hover:-translate-y-0.5 transition-all duration-200"
                >
                    {{-- Color strip --}}
                    <div class="h-1 w-full" style="background-color: {{ e($note->color) }}"></div>

                    <div class="p-5 flex flex-col flex-1">
                        {{-- Title row --}}
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <h2 class="font-serif font-semibold text-neutral-900 text-base leading-snug">{{ e($note->title) }}</h2>

                            {{-- Pin button --}}
                            <button
                                type="button"
                                :disabled="loading"
                                @click="
                                    loading = true;
                                    fetch('{{ route('notes.togglePin', $note) }}', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                            'Accept': 'application/json',
                                        }
                                    })
                                    .then(r => r.json())
                                    .then(data => { pinned = data.is_pinned; loading = false; })
                                    .catch(() => { loading = false; })
                                "
                                :title="pinned ? 'Открепить' : 'Закрепить'"
                                class="shrink-0 mt-0.5 transition-all duration-200 disabled:opacity-40"
                                :class="pinned ? 'text-bark' : 'text-neutral-200 hover:text-neutral-400'"
                            >
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M16 4a1 1 0 0 1 .993.883L17 5v1h1a3 3 0 0 1 2.995 2.824L21 9v1a1 1 0 0 1-1.993.117L19 10V9a1 1 0 0 0-.883-.993L18 8h-1v8.586l1.707 1.707a1 1 0 0 1-1.32 1.497l-.094-.083L15 16.414V19a1 1 0 0 1-1.993.117L13 19v-2.586l-2.293 2.293a1 1 0 0 1-1.497-1.32l.083-.094L11 15.586V8h-1a1 1 0 0 0-.993.883L9 9v1a1 1 0 0 1-1.993.117L7 10V9a3 3 0 0 1 2.824-2.995L10 6h1V5a1 1 0 0 1 1.993-.117L13 5v1h2V5a1 1 0 0 1 1-1z"/>
                                </svg>
                            </button>
                        </div>

                        {{-- Content preview --}}
                        @if($note->content)
                            <p class="text-neutral-400 text-sm leading-relaxed line-clamp-3 flex-1">{{ e($note->content) }}</p>
                        @else
                            <div class="flex-1"></div>
                        @endif

                        {{-- Footer --}}
                        <div class="flex items-center justify-between mt-5 pt-4 border-t border-neutral-100">
                            <span class="text-xs text-neutral-300">{{ $note->created_at->format('d.m.Y') }}</span>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('notes.edit', $note) }}" class="text-xs text-neutral-400 hover:text-neutral-700 transition-colors leading-none">Изменить</a>
                                <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Удалить заметку?')" style="display:contents">
                                    @csrf
                                    <button type="submit" class="text-xs text-neutral-400 hover:text-red-400 transition-colors leading-none">Удалить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $notes->links() }}
    @endif

</x-layouts.app>
