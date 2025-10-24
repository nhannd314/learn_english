<?php

namespace App\Http\Controllers;

use App\Models\Unit;

class UnitController extends Controller
{
    public function show(Unit $unit)
    {
        $unit->load('lessons');
        return view('unit', compact('unit'));
    }
}
