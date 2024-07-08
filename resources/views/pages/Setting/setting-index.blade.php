@extends('layouts.templates.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('dashboard.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Pengaturan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Pengaturan</a></div>
            </div>
        </div>

        <div class="section-body">

            <div id="output-status"></div>
            <div class="row">
                @include('pages.Setting.halaman')
                <div class="col-md-8 tab-content" id="myPillContent">
                   @include('pages.Setting.umum')
                  {{-- @include('pages.Setting.maps') --}}

                  {{-- @include('pages.Setting.sistem-sekolah') --}}

                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            @if (Session::has('message'))
                iziToast.success({
                title: 'Sukses',
                message: "{{ session('message') }}",
                position: 'topRight'
                });
            @endif
        </script>
    @endpush
@endsection
