<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Roadmap $roadmap)
    {
        $request->validate([
            'comment' => 'required|string|max:300',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'roadmap_id' => $roadmap->id,
            'parent_id' => $request->parent_id,
            'comment' => $request->comment,
        ]);

        return response()->json($comment, 201);
    }

    public function update(Request $request, Comment $comment)
    {
        // Optional: Add policy check for ownership

        $request->validate([
            'comment' => 'required|string|max:300',
        ]);

        $comment->update([
            'comment' => $request->comment,
        ]);

        return response()->json($comment);
    }

    public function destroy(Comment $comment)
    {
        // Optional: Add policy check for ownership

        $comment->delete();

        return response()->json(['message' => 'Comment deleted']);
    }
}
