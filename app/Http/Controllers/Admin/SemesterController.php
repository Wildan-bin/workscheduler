<?php

namespace App\Http\Controllers\Admin;

use App\Models\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SemesterController extends Controller
{
    public function create()
    {
        return view('admin.semester.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        Semester::create($validated);

        return redirect()->route('admin.semester.index')->with('success', 'Semester berhasil diatur.');
    }

    public function index()
    {
        $semesters = Semester::all();
        return view('admin.semester.index', compact('semesters'));
    }
}
