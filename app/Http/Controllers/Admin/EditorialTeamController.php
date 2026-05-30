<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EditorialTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditorialTeamController extends Controller
{
    /**
     * Urutan jabatan tetap — digunakan untuk order_column & validasi single.
     */
    public static array $roleOrder = [
        1 => 'Pemimpin Redaksi',
        2 => 'Wakil Pemimpin Redaksi',
        3 => 'Redaktur Pelaksana',
        4 => 'Redaktur',
        5 => 'Jurnalis / Reporter',
        6 => 'Content Creator / Media Sosial',
        7 => 'Tim Produksi Audio Visual & Desain',
    ];

    /** Jabatan yang hanya boleh diisi 1 orang. */
    public static array $singleRoles = [
        'Pemimpin Redaksi',
        'Wakil Pemimpin Redaksi',
        'Redaktur Pelaksana',
    ];

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
        $roles = self::$roleOrder;
        $singleRoles = self::$singleRoles;

        // Jabatan single yang sudah terisi
        $takenSingleRoles = EditorialTeam::whereIn('role', self::$singleRoles)
            ->pluck('role')
            ->toArray();

        return view('admin.editorial-teams.create', compact('roles', 'singleRoles', 'takenSingleRoles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => ['required', 'string', 'in:' . implode(',', self::$roleOrder)],
            'description' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $role = $request->role;

        // Validasi single role
        if (in_array($role, self::$singleRoles)) {
            $exists = EditorialTeam::where('role', $role)->exists();
            if ($exists) {
                return back()
                    ->withInput()
                    ->withErrors(['role' => "Jabatan \"{$role}\" hanya boleh diisi 1 orang dan sudah terisi."]);
            }
        }

        $data = $request->only(['name', 'role', 'description']);

        // Auto-assign order_column berdasarkan posisi jabatan
        $data['order_column'] = array_search($role, self::$roleOrder);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('editorial_photos', 'public');
        }

        EditorialTeam::create($data);

        return redirect()->route('admin.editorial-teams.index')
            ->with('success', 'Anggota redaksi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EditorialTeam $editorialTeam)
    {
        $roles = self::$roleOrder;
        $singleRoles = self::$singleRoles;

        // Jabatan single yang sudah terisi SELAIN milik anggota ini sendiri
        $takenSingleRoles = EditorialTeam::whereIn('role', self::$singleRoles)
            ->where('id', '!=', $editorialTeam->id)
            ->pluck('role')
            ->toArray();

        return view('admin.editorial-teams.edit', compact('editorialTeam', 'roles', 'singleRoles', 'takenSingleRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EditorialTeam $editorialTeam)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => ['required', 'string', 'in:' . implode(',', self::$roleOrder)],
            'description' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $role = $request->role;

        // Validasi single role (kecuali jabatan miliknya sendiri)
        if (in_array($role, self::$singleRoles)) {
            $exists = EditorialTeam::where('role', $role)
                ->where('id', '!=', $editorialTeam->id)
                ->exists();
            if ($exists) {
                return back()
                    ->withInput()
                    ->withErrors(['role' => "Jabatan \"{$role}\" hanya boleh diisi 1 orang dan sudah terisi."]);
            }
        }

        $data = $request->only(['name', 'role', 'description']);

        // Auto-assign order_column berdasarkan posisi jabatan
        $data['order_column'] = array_search($role, self::$roleOrder);

        if ($request->hasFile('photo')) {
            if ($editorialTeam->photo && Storage::disk('public')->exists($editorialTeam->photo)) {
                Storage::disk('public')->delete($editorialTeam->photo);
            }
            $data['photo'] = $request->file('photo')->store('editorial_photos', 'public');
        }

        $editorialTeam->update($data);

        return redirect()->route('admin.editorial-teams.index')
            ->with('success', 'Anggota redaksi berhasil diperbarui.');
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

        return redirect()->route('admin.editorial-teams.index')
            ->with('success', 'Anggota redaksi berhasil dihapus.');
    }
}
