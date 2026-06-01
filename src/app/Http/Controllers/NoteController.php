<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NoteController extends Controller
{
    public function index(Request $request): View
    {
        $notes = Auth::user()->notes()
            ->search($request->q)
            ->ordered()
            ->paginate(20)
            ->withQueryString();

        return view('notes.index', compact('notes'));
    }

    public function create(): View
    {
        return view('notes.create');
    }

    public function store(StoreNoteRequest $request): RedirectResponse
    {
        Auth::user()->notes()->create($request->validated());

        return to_route('notes.index')->with('success', 'Заметка создана.');
    }

    public function edit(Note $note): View
    {
        return view('notes.edit', compact('note'));
    }

    public function update(UpdateNoteRequest $request, Note $note): RedirectResponse
    {
        $note->update($request->validated());

        return to_route('notes.index')->with('success', 'Заметка обновлена.');
    }

    public function destroy(Note $note): RedirectResponse
    {
        $note->delete();

        return to_route('notes.index')->with('success', 'Заметка удалена.');
    }

    public function togglePin(Note $note): JsonResponse
    {
        $note->update(['is_pinned' => !$note->is_pinned]);

        return response()->json(['is_pinned' => $note->is_pinned]);
    }
}
