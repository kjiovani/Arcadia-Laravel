<?php

namespace App\Http\Controllers;

use App\Models\Walkthrough;
use Illuminate\Http\Request;

class WalkthroughController extends Controller
{
    public function show($id)
    {
        $walkthrough = Walkthrough::with(['game', 'chapters', 'tags'])->findOrFail($id);

        return view('public.walkthroughs.show', compact('walkthrough'));
    }
}
