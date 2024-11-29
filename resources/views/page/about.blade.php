@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            @include('layouts.sidebar')
            <div class="col-md-9">
                <h2>About</h2>

                <div class="row mt-4">
                    <div class="col-md-auto ">
                        <img src="{{ asset('/storage/Braman T.jpg') }}" alt="braman"
                            style="width: 100%; height: auto; max-height: 350px; object-fit: cover;">
                    </div>

                    <div class="col-md-auto">
                        <p>Aplikasi ini dibuat oleh:</p>
                        <h3>Braman Tyamahendrawan</h3>
                        <p>
                            <strong>Prodi:</strong> D4 Teknik Informatika<br>
                            <strong>NIM:</strong> 2141720097 <br>
                            <strong>Tanggal Pembuatan:</strong> 29 November 2024
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
