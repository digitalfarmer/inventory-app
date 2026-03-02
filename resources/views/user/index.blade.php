@extends('adminlte::page')

@section('title', 'Manajemen User')

@section('content_header')
    <h1>Daftar Pengguna Sistem</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role Saat Ini</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->getRoleNames() as $role)
                            <span class="badge badge-success">{{ strtoupper($role) }}</span>
                        @endforeach
                    </td>
                    <td>
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalRole{{ $user->id }}">
                            <i class="fas fa-user-tag"></i> Ganti Role
                        </button>
                        
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm btn-delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                        <div class="modal fade" id="modalRole{{ $user->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Role: {{ $user->name }}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Pilih Role Baru</label>
                                                <select name="role" class="form-control">
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                            {{ strtoupper($role->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        let form = $(this).closest('form');
        Swal.fire({
            title: 'Hapus User?',
            text: "User ini tidak akan bisa login lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) form.submit();
        });
    });

    @if(session('success'))
        Swal.fire('Berhasil!', "{{ session('success') }}", 'success');
    @endif
    @if(session('error'))
        Swal.fire('Error!', "{{ session('error') }}", 'error');
    @endif
</script>
@stop