<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $categories = CategoryModel::where('name', 'like', "%{$search}%")->get();
        } else {
            $categories = CategoryModel::all();
        }

        return view('page.kategori-surat', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastId = CategoryModel::max('id');
        $nextId = $lastId ? $lastId + 1 : 1; // Jika tidak ada data, mulai dari 1

        return view('page.create-kategori', compact('nextId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'judul' => 'required',
        ]);

        CategoryModel::create([
            'name' => $request->nama_kategori,
            'description' => $request->judul,
        ]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryModel $categoryModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryModel $category)
    {
        return view('page.edit-kategori', ['categoryModel' => $category]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryModel $category)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required',
            'judul' => 'required',
        ]);

        // Update data kategori
        $category->update([
            'name' => $request->nama_kategori,
            'description' => $request->judul,
        ]);

        // Redirect setelah berhasil memperbarui kategori
        return redirect()->route('category.index')->with('success', 'Kategori berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryModel $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus');
    }
}
