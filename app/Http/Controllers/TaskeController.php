<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $taskes = $user->taskes;

        return view('taskes.index', compact('taskes'));
    }
}
