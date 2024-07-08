@extends('layouts.templates.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        {{-- <div class="row">
            @if (Auth::user()->roles[0]->name == 'superadmin')


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total User</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_superadmin }} <small class="text-muted text-sm" style="font-size: 10px">orang</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Petugas</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_petugas }} <small class="text-muted text-sm" style="font-size: 10px">orang</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-globe"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Kecamatan</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_kecamatan }} <small class="text-muted text-sm" style="font-size: 10px">kecamatan</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-hospital"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Puskesmas</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_puskesmas }} <small class="text-muted text-sm" style="font-size: 10px">puskesmas</small>
                        </div>
                    </div>
                </div>
            </div>

            @endif

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-globe"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Desa</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_desa }} <small class="text-muted text-sm" style="font-size: 10px">desa</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-medkit"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pneumonia</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_pnemonia }} <small class="text-muted text-sm" style="font-size: 10px">anak</small>
                        </div>
                    </div>
                </div>
            </div>


        </div> --}}

    </section>
@endsection
@push('scripts')
    <script>
    </script>
@endpush
