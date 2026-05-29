<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EditorialTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EditorialTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = EditorialTeam::orderBy('order_column')->get();
        return view('admin.editorial-teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.editorial-teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string',
            'description' => 'nullable|string|max:255',
            'order_column' => 'required|integer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('editorial_photos', 'public');
        }

        EditorialTeam::create($data);

        return redirect()->route('admin.editorial-teams.index')->with('success', 'Anggota redaksi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EditorialTeam $editorialTeam)
    {
        return view('admin.editorial-teams.edit', compact('editorialTeam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EditorialTeam $editorialTeam)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string',
            'description' => 'nullable|string|max:255',
            'order_column' => 'required|integer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($editorialTeam->photo && Storage::disk('public')->exists($editorialTeam->photo)) {
                Storage::disk('public')->delete($editorialTeam->photo);
            }
            $data['photo'] = $request->file('photo')->store('editorial_photos', 'public');
        }

        $editorialTeam->update($data);

        return redirect()->route('admin.editorial-teams.index')->with('success', 'Anggota redaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EditorialTeam $editorialTeam)
    {
        if ($editorialTeam->photo && Storage::disk('public')->exists($editorialTeam->photo)) {
            Storage::disk('public')->delete($editorialTeam->photo);
        }

        $editorialTeam->delete();

        return redirect()->route('admin.editorial-teams.index')->with('success', 'Anggota redaksi berhasil dihapus.');
    }
}
