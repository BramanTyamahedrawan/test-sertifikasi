<?php

namespace App\Http\Controllers;

use App\Models\LetterModel;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $letters = LetterModel::where('name', 'like', "%{$search}%")->get();
        } else {
            $letters = LetterModel::all();
        }

        return view('page.homepage', compact('letters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryModel::all();

        return view('page.arsip-surat', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'kategori' => 'required|integer',
            'judul' => 'required|string|max:255',
            'file_surat' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('file_surat');

        $originalFileName = $file->getClientOriginalName();

        $uniqueFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs('surat', $uniqueFileName);


        LetterModel::create([
            'letter_number' => $request->nomor_surat,
            'category_id' => $request->kategori,
            'name' => $request->judul,
            'file' => $path,
        ]);

        return redirect()->route('letter.index')->with('success', 'Surat berhasil diunggah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LetterModel $letter)
    {
        $letter = LetterModel::findOrFail($letter->id);

        return view('page.lihat-surat', compact('letter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $letter = LetterModel::findOrFail($id); // Ambil data surat berdasarkan ID
        $categories = CategoryModel::all(); // Ambil semua kategori untuk dropdown
        return view('page.edit-surat', compact('letter', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'kategori' => 'required|exists:category,id', // Sesuai dengan tabel category
            'judul' => 'required|string|max:255',
            'file_surat' => 'nullable|file|mimes:pdf|max:2048', // Validasi file PDF
        ]);

        $letter = LetterModel::findOrFail($id);
        $letter->letter_number = $request->nomor_surat; // Perbaiki nama kolom
        $letter->category_id = $request->kategori; // Sesuaikan dengan foreign key
        $letter->name = $request->judul;

        // Handle file upload
        if ($request->hasFile('file_surat')) {
            if ($letter->file && file_exists(storage_path('app/' . $letter->file))) {
                unlink(storage_path('app/' . $letter->file)); // Hapus file lama
            }

            $path = $request->file('file_surat')->store('letters'); // Simpan file baru
            $letter->file = $path; // Simpan path ke database
        }

        $letter->save();

        return redirect()->route('letter.index')->with('success', 'Surat berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LetterModel $letter)
    {
        try {
            if ($letter->file && Storage::exists($letter->file)) {
                Storage::delete($letter->file);
            }
            $letter->delete();

            return redirect()->route('letter.index')->with('success', 'Surat berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('letter.index')->with('error', 'Terjadi kesalahan saat menghapus surat.');
        }
    }
}
