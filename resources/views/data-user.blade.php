@extends('layouts.main')
@section('Content')
    <div class="container">
        <!-- DIISI DISINI -->
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                Ada Kesalahan Saat Menyimpan User..!! - (lihat Note Dibawah)
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        @if (session()->has('failed'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('failed') }}
            </div>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Data User</h5>
            </div>

            <div class="card-body">
                <div class="mb-3"><a class="btn btn-primary btn-sm" role="button" href="#" data-toggle="modal"
                        data-target="#modalAddUser">
                        Tambah User
                    </a></div>

                <!-- end Button tambah data -->
                <!-- tables -->
                <div class="table-responsive">
                    <table class="table table-sm" id="dataTable" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Kelamin</th>
                                <th scope="col">No. HP</th>
                                <th scope="col">Level</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($user as $item)
                                <tr x-data>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->user_profile->tanggal_lahir }}</td>
                                    <td>{{ $item->user_profile->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $item->user_profile->no_telp }}</td>
                                    <td>{{ $item->level }}</td>
                                    <td>{{ $item->user_profile->alamat }}</td>
                                    <td style="vertical-align: middle">
                                        <div style="display: flex; gap:0.5rem; justify-content: start;">
                                            <span class="badge text-bg-primary p-2"><a
                                                    style="text-decoration: none; color:white" role="button"
                                                    data-toggle="modal" data-target="#modalAddUser">
                                                    Ubah Data
                                                </a></span>
                                            @if ($item->email == Auth::user()->email)
                                                <span class="badge text-bg-secondary p-2">Used</span>
                                            @else
                                                <span class="badge text-bg-danger p-2"><a
                                                        style="text-decoration: none; color:white" role="button"
                                                        data-toggle="modal" data-target="#modalHapusUser"
                                                        data-id="{{ $item->id }}" data-email="{{ $item->email }}"
                                                        x-on:click="$store.hapusID.deleteFunc($event)">
                                                        Hapus
                                                    </a></span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($errors->any())
                    <div>Note: Error Saat Ingin Menambahkan/Mengedit User..<ol>
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ol>
                    </div>
                @endif
                {{ $user->links() }}
            </div>
        </div>
    </div>
@endsection
@section('Modal')
    <div class="modal fade" id="modalAddUser" tabindex="-1" aria-labelledby="ModalTambahUser" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="container" x-data="dataPassword">
                    <form action="{{ route('user.add') }}" method="POST">
                        @csrf
                        <div class="row my-3">
                            <div class="col-5">
                                <label class="form-label">Username - (Email)</label>
                                <input type="email" class="form-control form-control-sm" name="email" required>
                            </div>
                            <div class="col-7">
                                <label class="form-label">Nama</label>
                                <input type="nama" class="form-control form-control-sm" name="name" required>
                            </div>
                        </div>
                        <div class="row mb-3 pb-3 border-bottom">
                            <div class="col-7">
                                <label class="form-label">No. Telp</label>
                                <input type="text" class="form-control form-control-sm" name="no_telp"
                                    placeholder="08XX XX..." required>
                            </div>
                            <div class="col-5">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="text" class="form-control form-control-sm" name="tanggal_lahir"
                                    placeholder="--/--/----" onfocus="(this.type='date')" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label">Level: </label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="level" id="admin"
                                        value="admin" required>
                                    <label class="form-check-label" for="admin">Admin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="level" id="apoteker"
                                        value="apoteker" required>
                                    <label class="form-check-label" for="apoteker">Apoteker</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="exampleInputLevel" class="form-label">Jenis Kelamin: </label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki"
                                        value="L" required>
                                    <label class="form-check-label" for="laki-laki">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan"
                                        value="P" required>
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="exampleInputPassword" class="form-label">Password</label>
                                <input type="password" class="form-control form-control-sm" name="password" required
                                    x-model="password">
                            </div>
                            <div class="col-6">
                                <label for="exampleInputPassword" class="form-label">Ulang Password - <span
                                        :class="same ? 'text-success' : 'text-danger'"
                                        x-text="same ? 'Password Correct' : 'Password Wrong'"></span></label>
                                <input type="password" class="form-control form-control-sm" name="repeat" required
                                    x-model="repeat">
                            </div>
                            <span id="passwordHelpInline" class="form-text">
                                Must be 8 characters or long.
                            </span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control form-control-sm" id="alamat" rows="2" required name="alamat"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-primary" :class="same ? '' : 'disabled'">Tambah
                                User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalHapusUser" tabindex="-1" aria-labelledby="ModalTambahUser" aria-hidden="true"
        x-data="dataPassword">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ingin Hapus user <strong>"<span
                                x-text="$store.hapusID.email"></span>"</strong> ?</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="container">
                    <form action="{{ route('user.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" :value="$store.hapusID.id">
                        <input type="hidden" name="email" :value="$store.hapusID.email">
                        <div class="my-3 font-weight-bold">Harap Masukkan Password Akun Ini..</div>
                        <div class="mb-3">
                            <label for="exampleInputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-sm" name="password" required
                                x-model="password">
                            <span id="passwordHelpInline" class="form-text">
                                Must be 8 characters or long.
                            </span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-primary" :class="delete_pass ? '' : 'disabled'">Delete
                                User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
    </style>
@endpush
@push('script')
    @vite('resources/js/app.js')
    <!-- Bootstrap core JavaScript-->
    <script src={{ URL::asset('template/vendor/jquery/jquery.min.js') }}></script>
    <script src={{ URL::asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>

    <!-- Core plugin JavaScript-->
    <script src={{ URL::asset('template/vendor/jquery-easing/jquery.easing.min.js') }}></script>

    <!-- Custom scripts for all pages-->
    <script src={{ URL::asset('template/js/sb-admin-2.min.js') }}></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dataPassword', () => ({
                password: '',
                repeat: '',
                get same() {
                    return (this.password == this.repeat && this.password.length >= 8);
                },
                get delete_pass() {
                    return (this.password.length >= 8);
                }
            }));
            Alpine.store('hapusID', {
                id: '',
                email: '',
                deleteFunc(event) {
                    this.id = event.target.dataset.id;
                    this.email = event.target.dataset.email;
                }
            })
        });
    </script>
@endpush
