@extends('layouts.main')
@section('Content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div class="container">
            <!-- DIISI DISINI -->
            @if (session()->has('status'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('status') }}
                </div>
            @endif
            @if (session()->has('failed'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('failed') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    Ada Kesalahan Saat Menyimpan Data Pengaturan
                </div>
            @endif
            <div class="card shadow mb-3">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Pengaturan Apotek</h5>
                </div> <br>
                <!-- form pengaturan -->
                <div class="container" style="padding: 0 20px;">
                    <form action="{{ route('pengaturan.edit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputnama_apotek" class="form-label">Nama apotek</label>
                            <input type="Username" class="form-control form-control-sm" id="exampleInputnama_apotek"
                                aria-describedby="nama_apotek" value="{{ $apotek->nama }}" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputno.telp" class="form-label">No. Telp</label>
                            <input type="nama" class="form-control form-control-sm" id="exampleInputno.telp"
                                aria-describedby="no.telp" value="{{ $apotek->no_telp }}" name="no_telp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputalamat" class="form-label">Alamat Apotek</label>
                            <textarea class="form-control form-control-sm" id="floatingTextarea" rows="1" name="alamat">{{ $apotek->alamat }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputinformasi" class="form-label">Informasi</label>
                            <textarea class="form-control form-control-sm" id="floatingTextarea" rows="1" name="info">{{ $apotek->info }}</textarea>
                        </div>
                        <div class="optional">
                            <div>
                                <label for="exampleInputLevel" class="form-label">Stok Opname</label><br>
                                <div class="btn-group">
                                    <a href="{{ route('pengaturan.opname') }}"
                                        class="btn btn-primary btn-sm {{ $pengaturan[0] === 'opname:true' ? 'disabled' : '' }}"
                                        aria-current="page">Buka</a>
                                    <a href="{{ route('pengaturan.opname') }}"
                                        class="btn btn-primary btn-sm {{ $pengaturan[0] !== 'opname:true' ? 'disabled' : '' }}">Tutup</a>
                                </div>
                            </div>
                            <div>
                                <label for="exampleInputLevel" class="form-label">Edit Data Obat</label><br>
                                <div class="btn-group">
                                    <a href="{{ route('pengaturan.obat') }}"
                                        class="btn btn-primary btn-sm {{ $pengaturan[1] === 'obat:true' ? 'disabled' : '' }}"
                                        aria-current="page">Buka</a>
                                    <a href="{{ route('pengaturan.obat') }}"
                                        class="btn btn-primary btn-sm {{ $pengaturan[1] !== 'obat:true' ? 'disabled' : '' }}">Tutup</a>
                                </div>
                            </div>
                        </div>
                        <div class="border-top-0 my-4 text-center">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('Model')
@endsection
@push('style')
    <style>
        .optional {
            display: flex;
            gap: 1rem;
        }

        .optional>div {
            flex-basis: 50%;

        }

        .optional>div * {
            width: 100%;
            gap: 0.25rem;
            text-align: center
        }
    </style>
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
