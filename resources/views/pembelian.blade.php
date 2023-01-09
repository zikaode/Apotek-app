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
                <h5 class="m-0 font-weight-bold text-primary">Data Pembelian</h5>
            </div>

            <div class="card-body">
                <div class="mb-3"><a class="btn btn-primary btn-sm" role="button" href="#" data-toggle="modal"
                        data-target="#modalAddObat">
                        Tambah Pembelian - Kasir
                    </a></div>
                <!-- tables -->
                <div class="table-responsive">
                    <table class="table table-sm" id="dataTable" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Costumer</th>
                                <th scope="col">Seller</th>
                                <th scope="col">Total Bayar</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Kembalian</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pembelian as $item)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $item->costumer }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                                    <td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    <td>{{ number_format($item->kembalian, 0, ',', '.') }}</td>
                                    <td style="vertical-align: middle">
                                        {{-- <div style="display: flex; gap:0.5rem; justify-content: start;">
                                            <span class="badge text-bg-primary p-2"><a
                                                    style="text-decoration: none; color:white" role="button" href="#"
                                                    data-toggle="modal" data-target="#modalEditUser{{ $item->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg> Edit
                                                </a></span><a style="text-decoration: none; color:white" role="button"
                                                href="{{ route('obat.delete', [$item->id]) }}"
                                                onclick="return confirm('Apakah Anda Mau Hapus Data Ini?')"
                                                data-id="{{ $item->id }}"><span class="badge text-bg-danger p-2"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                        <path
                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                    </svg>
                                                    Hapus</a></span>
                                        </div> --}}
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
                    {{-- {{ $obat->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('Model')
@endsection
@push('style')
    <style></style>
@endpush
@push('script')
    <script></script>
    <!-- Bootstrap core JavaScript-->
    <script src={{ URL::asset('template/vendor/jquery/jquery.min.js') }}></script>
    <script src={{ URL::asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>

    <!-- Core plugin JavaScript-->
    <script src={{ URL::asset('template/vendor/jquery-easing/jquery.easing.min.js') }}></script>

    <!-- Custom scripts for all pages-->
    <script src={{ URL::asset('template/js/sb-admin-2.min.js') }}></script>

    <!-- Page level plugins -->
    <script src={{ URL::asset('template/vendor/chart.js/Chart.min.js') }}></script>

    <!-- Page level custom scripts -->
    <script src={{ URL::asset('template/js/demo/chart-area-demo.js') }}></script>
    <script src={{ URL::asset('template/js/demo/chart-pie-demo.js') }}></script>
@endpush
