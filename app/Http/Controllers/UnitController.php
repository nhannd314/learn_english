<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function show($id)
    {
        $unit = Unit::with('lessons')->findOrFail($id);
        return view('unit', compact('unit'));
    }
}
