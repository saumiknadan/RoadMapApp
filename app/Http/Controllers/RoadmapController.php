<?php

namespace App\Http\Controllers;

use App\Models\Roadmap;
use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    public function index()
    {
        $roadmaps = Roadmap::withCount('upvotes')
            ->with(['comments' => function ($query) {
                $query->whereNull('parent_id')->with('replies');
            }])
            ->orderByDesc('upvotes_count')
            ->get();
    
        return view('admin.roadmaps.index', compact('roadmaps'));
    }
}
