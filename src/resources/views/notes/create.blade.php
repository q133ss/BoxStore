<x-layouts.app title="Новая заметка">

    <div class="max-w-xl">
        <h1 class="font-serif text-3xl font-semibold text-neutral-900 mb-8">Новая заметка</h1>

        <form action="{{ route('notes.store') }}" method="POST" class="bg-white rounded-2xl border border-neutral-200 p-8">
            @csrf
            @include('notes._form')
        </form>
    </div>

</x-layouts.app>
