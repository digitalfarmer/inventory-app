@extends('adminlte::page')

@section('title', 'Profil Saya')

@section('content_header')
    <h1>Pengaturan Profil</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
                         alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                <p class="text-muted text-center">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ganti Password</h3>
            </div>
            <form action="{{ route('profile.password') }}" method="POST" id="form-password">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Password Lama</label>
                        <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" required>
                        @error('old_password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-key"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(function() {
        // Alert jika sukses
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Mantap!',
                text: "{{ session('success') }}",
                timer: 2500,
                showConfirmButton: false
            });
        @endif

        // Alert jika ada error dari logic Controller (seperti password lama salah)
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Waduh...',
                text: "{{ session('error') }}",
            });
        @endif

        // Alert jika ada error validasi (seperti password kurang dari 8 karakter)
        @if($errors->any())
            Swal.fire({
                icon: 'warning',
                title: 'Periksa Kembali',
                text: "Pastikan semua inputan sudah sesuai aturan.",
            });
        @endif
    });
</script>
@stop