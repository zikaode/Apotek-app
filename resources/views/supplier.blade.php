@extends('layouts.main')
@section('Content')
    <div class="container">
        <!-- DIISI DISINI -->
        @if (session()->has('status'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('status') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                Ada Kesalahan Saat Menyimpan Obat..!! - (lihat Note Dibawah)
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
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Data Supplier</h5>
            </div>

            <div class="card-body">
                <div class="mb-3"><a class="btn btn-primary btn-sm" role="button" href="#" data-toggle="modal"
                        data-target="#modalAddObat">
                        Tambah Supplier
                    </a></div>
                <!-- tables -->
                <div class="table-responsive">
                    <table class="table table-sm" id="dataTable" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No Telephone</th>
                                <th scope="col">Terhutang</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($supplier as $item)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->no_telp }}</td>
                                    <td>Rp. {{ $item->hutang }}</td>
                                    <td style="vertical-align: middle">
                                        <div style="display: flex; gap:0.5rem; justify-content: start;">
                                            {{-- <span class="badge text-bg-primary p-2"><a
                                                    style="text-decoration: none; color:white" role="button" href="#"
                                                    data-toggle="modal" data-target="#modalEditUser{{ $item->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg> Edit
                                                </a></span> --}}<a style="text-decoration: none; color:white"
                                                role="button" {{-- href="{{ route('supplier.delete', [$item->id]) }}" --}} {{-- onclick="return confirm('Apakah Anda Mau Hapus Data Ini?')" --}}
                                                data-id="{{ $item->id }}"><span class="badge text-bg-danger p-2"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                        <path
                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                    </svg>
                                                    Hapus</a></span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($errors->any())
                        <div>Note: Error Saat Ingin Menambahkan/Mengedit Obat..<ol>
                                @foreach ($errors->all() as $error)
                                    <li class="text-danger">{{ $error }}</li>
                                @endforeach
                            </ol>
                        </div>
                    @endif
                    {{ $supplier->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('Modal')
    {{-- <div class="modal fade" id="modalAddObat" tabindex="-1" aria-labelledby="ModalTambahUser" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Obat</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('obat.add') }}" method="POST">
                    @csrf
                    <div class="modal-body container">

                        <div class="row mb-2">
                            <div class="mb-3 col-3">
                                <label class="form-label">Kode</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">#</span>
                                    <input type="text" class="form-control form-control-sm" name="kode" required>
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label">Nama</label>
                                <input type="Username" class="form-control form-control-sm" name="nama" required>
                            </div>
                        </div>
                        <div class="row
                                    mb-2">
                            <div class="mb-3 col-3">
                                <label class="form-label">Stok Awal</label>
                                <input type="number" class="form-control form-control-sm" name="stokAwal" value="0"
                                    required>
                            </div>
                            <div class="mb-3 col-3">
                                <label class="form-label">Minimal Stok</label>
                                <input type="number" class="form-control form-control-sm" name="stokMin" value="0"
                                    required>
                            </div>
                            <div class="mb-3 col-3">
                                <label class="form-label">Maximal Stok</label>
                                <input type="number" class="form-control form-control-sm" name="stokMax" value="0"
                                    required>
                            </div>
                            <div class="mb-3 col-3">
                                <label class="form-label">Satuan</label>
                                <input type="text" class="form-control form-control-sm" name="satuan" required>
                            </div>
                        </div>
                        <div class="row mb-2" x-data="tambahObat" x-init="$watch(['hargaJual', 'hargaJualFix'], () => hargaJualFix = (Math.ceil((hargaJual / 1000) * 2) / 2) * 1000)"
                            x-effect="hargaJualFix = (Math.ceil((hargaJual / 1000) * 2) / 2) * 1000">
                            <div class="mb-3 col-2">
                                <label class="form-label">PPN</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control form-control-sm" x-model.number="ppn"
                                        name="ppn" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <div class="mb-3 col-2">
                                <label class="form-label">Margin</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control form-control-sm" x-model.number="margin"
                                        name="margin" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <div class="mb-3 col-4">
                                <label class="form-label">Harga Beli</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">Rp. </span>
                                    <input type="number" class="form-control form-control-sm" x-model.number="hargaBeli"
                                        name="hargaBeli" required>
                                </div>
                            </div>
                            <div class="mb-3 col-4">
                                <label class="form-label">Harga Jual</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">Rp. </span>
                                    <input type="number" class="form-control form-control-sm" :value="hargaJualFix"
                                        readonly required name="hargaJual" x-ref="hargaJualRef">
                                </div>
                            </div>
                            <div>Note: <ol>
                                    <li>Harga jual adalah nilai bulat dari : <span x-text="hargaJual">
                                            -.</span></li>
                                    <li> PPN Diterapkan <span x-text="ppn">
                                            -.</span>% Senilai : <span x-text="nilaiPPN">
                                            -.</span></li>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Tambah Obat</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
@push('style')
    <style></style>
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
    <script></script>
@endpush
