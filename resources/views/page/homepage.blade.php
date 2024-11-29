@extends('layouts.app')

@section('content')
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus surat ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            @include('layouts.sidebar')

            <!-- Main Content -->
            <div class="col-md-9">
                <h4>Arsip Surat</h4>
                <p>Berikut ini adalah surat-surat yang telah terbit dan diarsipkan. Klik "Lihat" pada kolom aksi untuk
                    menampilkan surat.</p>

                <!-- Search Form -->
                <form action="{{ route('letter.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari arsip..."
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>

                <!-- Table -->
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Nomor Surat</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Waktu Pengarsipan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($letters as $letter)
                            <tr>
                                <td>{{ $letter->letter_number }}</td>
                                <td>{{ $letter->category->name }}</td>
                                <td>{{ $letter->name }}</td>
                                <td>{{ $letter->created_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="confirmDelete('{{ route('letter.destroy', $letter->id) }}')">Hapus</button>
                                    <a href="{{ asset('storage/' . $letter->file) }}" class="btn btn-warning btn-sm"
                                        download="{{ $letter->file }}">Unduh</a>

                                    <a href="{{ route('letter.show', $letter->id) }}" class="btn btn-primary btn-sm">Lihat
                                        >></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Arsipkan Button -->
                <a href="{{ route('letter.create') }}"><button class="btn btn-success">Arsipkan Surat</button></a>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(actionUrl) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = actionUrl;

            const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            deleteModal.show();
        }
    </script>
@endsection
