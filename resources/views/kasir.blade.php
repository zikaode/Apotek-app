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
        <h3 class="text-center">KASIR - APOTEK</h3>
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Tambah Penjualan</h5>
            </div>
            <div class="card-body py-3">
                <form action="{{ route('kasir.add') }}" method="POST">
                    @csrf
                    <div class="row" style="align-content: center">
                        <div class="col-7 p-1">
                            <div><select class="form-select form-select-sm" id="obat" name="obat" required>
                                    <option disabled>Pilih Obat</option>
                                    @foreach ($obat as $i)
                                        <option value="{{ $i->kode }}">
                                            {{ $i->kode }} - {{ $i->nama }} I Stok:({{ $i->stok }})
                                        </option>
                                    @endforeach
                                </select></div>
                        </div>
                        <div class="col-2 p-1">
                            <div><input type="number" class="form-control form-control-sm" placeholder="Qty"
                                    name="jumlah"></div>
                        </div>
                        <div class="col-2 p-1">
                            <button style="width: 100%" type="submit" class="btn btn-success btn-sm">Tambah</button>
                        </div>
                        <div class="col-1 p-1">
                            <a style="width: 100%" href="{{ route('kasir.reset') }}"
                                onclick="return confirm('Yakin Ingin Mereset?')" class="btn btn-danger btn-sm">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Detail</h5>
            </div>
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table table-sm" id="dataTable" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Obat</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Sub Total</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (session()->get('kasir') != null)
                                @foreach (session()->get('kasir') as $item)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $item['obat'][0]->nama }}</td>
                                        <td>{{ 'Rp. ' . number_format($item['obat'][0]->harga_jual, 0, ',', '.') }}</td>
                                        <td>{{ number_format($item['jumlah'], 0, ',', '.') }}</td>
                                        <td>{{ 'Rp. ' . number_format($item['obat'][0]->harga_jual * $item['jumlah'], 0, ',', '.') }}
                                        </td>
                                        <td style="vertical-align: middle">
                                            <div style="display: flex; gap:0.5rem; justify-content: start; width: 40px;">
                                                <a href="{{ route('kasir.min', $item['id']) }}" class="link-dark"
                                                    style="color: white !important"><span
                                                        class="badge text-bg-primary p-2">-</span></a>
                                                <span class="badge text-bg-danger p-2"><a
                                                        href="{{ route('kasir.del', $item['id']) }}" class="link-dark"
                                                        style="color: white !important">Delete</a></span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
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
            <div class="card-footer py-3" x-data="transaksi">
                <form action="{{ route('kasir.transaksi') }}" method="POST">
                    @csrf
                    <h6 style="text-align: right" class="mx-4">GRANT TOTAL : <strong>Rp. <span x-text="grantTotal"></span>
                        </strong></h6>
                    <h6 style="text-align: right" class="mx-4">TOTAL KEMBALIAN : <strong>Rp. <span
                                x-text="(kembalian > 0) ? kembalian : 0"></span></strong></h6><br>
                    <div style="display: flex; gap:.65rem; justify-content: end;" class="mb-3">
                        <div style="flex-basis: 5%">
                            <button style="width: 100%" type="button" class="btn btn-primary btn-sm"
                                x-on:click="noCostumer ? (costumer = 'Unknown Constumer') : (costumer = '')">?</button>
                        </div>
                        <div style="flex-basis: 65%"><input class="form-control form-control-sm" type="text"
                                placeholder="Nama Costumer" x-model.text="costumer" name="costumer"></div>
                        <div style="flex-basis: 30%"><input class="form-control form-control-sm" type="text"
                                placeholder="Nominal Bayar" x-model.number="totalBayar" name="totalbayar"></div>
                    </div>
                    <div>
                        <button style="width: 100%" type="submit" class="btn btn-primary btn-sm"
                            :class="transaksi ? '' : 'disabled'">Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('Model')
@endsection
@push('style')
    <style>
        .select2-container .select2-selection--single {
            height: 31px !important;
            border-color: #d1d3e2 !important;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    {{-- 
    <!-- Page level plugins -->
    <script src={{ URL::asset('template/vendor/chart.js/Chart.min.js') }}></script>

    <!-- Page level custom scripts -->
    <script src={{ URL::asset('template/js/demo/chart-area-demo.js') }}></script>
    <script src={{ URL::asset('template/js/demo/chart-pie-demo.js') }}></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#obat').select2({
                height: '31px',
            });
        });
        document.addEventListener('alpine:init', () => {
            Alpine.data('transaksi', () => ({
                grantTotal: {{ session()->get('total', 0) }},
                totalBayar: 0,
                costumer: '',
                get kembalian() {
                    return (this.totalBayar - this.grantTotal);
                },
                get transaksi() {
                    return (this.totalBayar - this.grantTotal > 0 && (this.costumer !== '') && (this
                        .grantTotal > 0));
                },
                get noCostumer() {
                    return (this.costumer === '');
                }
            }));
        })
    </script>
@endpush
