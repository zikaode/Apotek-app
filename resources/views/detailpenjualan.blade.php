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
                <h5 class="m-0 font-weight-bold text-primary">Data Penjualan - {{ $penjualan->id }}</h5>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <h5 style="text-align: right">Tanggal : {{ $penjualan->created_at }}</h5>
                    <h5 style="text-align: right; font-weight: bold; text-decoration: underline">
                        {{ $penjualan->user->name }}</h5>
                    <hr>
                    <h5>Costumer : {{ $penjualan->costumer }}</h5>
                </div>
                <!-- tables -->
                <div class="table-responsive">
                    <table class="table table-sm" id="dataTable" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Obat</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">SubTotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjualan->detail_penjualan as $item)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $item->obat->nama }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>Rp. {{ number_format($item->sub_total, 0, ',', '.') }}</td>
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
            <div class="card-footer">
                <div class="mb-3 float-right">
                    <table style="font-size: 1.15rem; text-align: right">
                        <tr>
                            <td>Total Harga</td>
                            <td> : </td>
                            <td>
                                <h6 style="visibility: hidden">0</h6>
                            </td>
                            <td><strong>Rp. {{ number_format($penjualan->total_harga, 0, ',', '.') }}</strong> </td>
                        </tr>
                        <tr>
                            <td>Total Bayar</td>
                            <td> : </td>
                            <td>
                                <h6 style="visibility: hidden">0</h6>
                            </td>
                            <td><strong>Rp. {{ number_format($penjualan->total_bayar, 0, ',', '.') }}</strong>
                        </tr>
                        <tr>
                            <td>kembalian</td>
                            <td> : </td>
                            <td>
                                <h6 style="visibility: hidden">0</h6>
                            </td>
                            <td><strong>Rp. {{ number_format($penjualan->kembalian, 0, ',', '.') }}</strong>
                        </tr>
                    </table>
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
