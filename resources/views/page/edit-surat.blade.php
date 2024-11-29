@extends('layouts.app') <!-- Sesuaikan dengan layout utama Anda -->

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar -->
            @include('layouts.sidebar')
            <div class="col-md-9">
                <h4>Arsip Surat >> Edit</h4>
                <p>Edit surat yang telah terbit pada form ini.</p>
                <p><strong>Catatan:</strong><br>- Gunakan file berformat PDF jika ingin mengunggah ulang file surat</p>

                <form action="{{ route('letter.update', $letter->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Menggunakan method PUT untuk update -->

                    <!-- Nomor Surat -->
                    <div class="mb-3">
                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat"
                            value="{{ $letter->letter_number }}" placeholder="Masukkan nomor surat" required>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Pilih Kategori</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="" disabled>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $letter->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Judul -->
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ $letter->name }}"
                            placeholder="Masukkan judul surat" required>
                    </div>

                    <!-- File Surat -->
                    <div class="mb-3">
                        <label for="file_surat" class="form-label">File Surat (PDF)</label>
                        <input type="file" class="form-control" id="file_surat" name="file_surat" accept=".pdf">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah file surat.</small>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('letter.index') }}" class="btn btn-secondary">
                            << Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
