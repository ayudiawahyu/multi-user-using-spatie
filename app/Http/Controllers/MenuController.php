<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Menu::query();

        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $menus = $query->paginate(8);

        return view('admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $image = $request->file('image');
            $data['image'] = Str::random(18) . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put($data['image'], file_get_contents($image));
            Menu::create($data);
            DB::commit();

            return redirect()->back()->with('success', 'Menu baru berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Menu baru gagal ditambahkan ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $data['image'] = Str::random(18) . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->put($data['image'], file_get_contents($image));
                Storage::disk('public')->delete($menu->image);
            } else {
                $data['image'] = $menu->image;
            }
            $menu->update($data);
            DB::commit();

            return redirect()->back()->with('success', 'Berhasil memperbarui menu');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Menu gagal diperbarui ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        DB::beginTransaction();
        try {
            Storage::disk('public')->delete($menu->image);
            $menu->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil menghapus produk');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Menu gagal dihapus ' . $th->getMessage());
        }
    }

    public function available(Menu $menu)
    {
        DB::beginTransaction();
        try {
            $menu->update(['status' => 'tersedia']);
            DB::commit();
        return redirect()->back()->with('success', 'Berhasil mengubah status menu menjadi "tersedia"');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Menu gagal diubah status menjadi "tersedia" ' . $th->getMessage());
        }
    }

    public function unavailable(Menu $menu)
    {
        DB::beginTransaction();
        try {
            $menu->update(['status' => 'kosong']);
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil mengubah status menu menjadi "kosong"');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Menu gagal diubah status menjadi "kosong" ' . $th->getMessage());
        }
    }
}
