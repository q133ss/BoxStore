<x-layouts.app title="Редактировать заметку">

    <div class="max-w-xl">
        <h1 class="font-serif text-3xl font-semibold text-neutral-900 mb-8">Редактировать заметку</h1>

        <form action="{{ route('notes.update', $note) }}" method="POST" class="bg-white rounded-2xl border border-neutral-200 p-8">
            @csrf
            @method('PUT')
            @include('notes._form')
        </form>
    </div>

</x-layouts.app>
