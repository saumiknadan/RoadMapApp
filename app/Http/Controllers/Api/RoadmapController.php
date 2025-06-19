<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Roadmap;
use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    public function index()
    {
        // Load roadmap with upvotes count and comments with replies
        $roadmaps = Roadmap::withCount('upvotes')
                    ->with(['comments' => function($query) {
                        $query->whereNull('parent_id')->with('replies');
                    }])
                    ->get();

        return response()->json($roadmaps);
    }

    public function show($id)
    {
        $roadmap = Roadmap::with(['comments.replies', 'upvotes'])->findOrFail($id);
        return response()->json($roadmap);
    }
}
