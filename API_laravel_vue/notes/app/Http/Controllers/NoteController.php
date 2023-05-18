<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|min:15|max:180'
        ]);

        $note = new Note();
        $note->content = $request->message;
        $note->user = auth()->id();
        $note->save();
        return [
            'message'=> 'Note enregistrée'
        ];
    }
    // Show
    public function show()
    {
        $user = auth()->user();
        $notes = Note::where('user', $user->id)->get();
        return response()->json([
            'notes' => $notes
        ]);
    }

    public function showOne(Request $request, $id)
    {
        $note = Note::where('id', $id)->where('user', $request->user()->id)->firstOrFail();
        return response()->json([
            'note' => $note
        ]);
    }

    public function delete($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
        return response()->json([
            'message' => 'Note supprimée'
        ]);
    }

    public function edit(Request $request, $id)
    {
        $note = Note::findOrFail($id);
        $note->content = $request->message;

        $note->save();
        return response()->json([
            'message' => 'Note modifiée'
        ]);
    }
}
