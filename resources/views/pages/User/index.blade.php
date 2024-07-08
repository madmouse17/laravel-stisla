@extends('layouts.templates.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Admin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data User</a></div>
                <div class="breadcrumb-item">Admin</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ Session::has('edit-admin') ? 'Ubah' : 'Buat' }} Data</h4>
                    </div>
                    <div class="card-body">
                        @if (Session::has('edit-admin'))
                            <form action="{{ route('admin.update', $edit->id) }}" method="POST" class="needs-validation"
                                novalidate="" enctype="multipart/form-data">
                                @method('PUT')
                            @else
                                <form action="{{ route('admin.store') }}" method="POST" class="needs-validation"
                                    novalidate="" enctype="multipart/form-data">
                        @endif
                        @csrf

                        <div class="form-group">
                            <label>Nama</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <input type="text" name="name" class="form-control"
                                    value="{{ Session::has('edit-admin') ? $edit->name : '', old('name') }}" autofocus
                                    autocomplete="off" tabindex="1" required>
                            </div>
                            <div class="invalid-feedback">
                                Nama tidak boleh kosong
                            </div>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-key"></i>
                                    </div>
                                </div>
                                <input type="email" name="email" class="form-control"
                                    value="{{ Session::has('edit-admin') ? $edit->email : '', old('email') }}" id="email"
                                    autofocus autocomplete="off" tabindex="2" required>
                            </div>
                            <div class="invalid-feedback">
                                Email tidak boleh kosong
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        @if (Session::has('edit-admin'))
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    </div>
                                    <input type="password" class="form-control pwstrength" name="password"
                                        data-indicator="pwindicator">
                                </div>
                                <div id="pwindicator" class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
                                <div class="invalid-feedback">
                                    Password tidak boleh kosong
                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        @else
                            <blockquote>Password default : password123</blockquote>
                        @endif

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                {{ Session::has('edit-admin') ? 'Update' : 'Simpan' }}
                            </button>
                        </div>
                        </form>
                        @if (Session::has('edit-admin'))
                            <div>
                                <form action="{{ route('clear.session') }}" method="GET">

                                    <button class="btn btn-warning btn-lg btn-block" value="admin" name="page">
                                        Tambah Baru
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                <div class="card">


                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script>
            @if (Session::has('message'))
                iziToast.success({
                    title: 'Sukses',
                    message: "{{ session('message') }}",
                    position: 'topRight'
                });
            @endif



            $(document).on('click', '#hapus', function() {
                var globalId = $(this).data('id');
                var url = "{{ url('/admin/admin/') }}"+ "/" + globalId;
                hapus(url, 'admin');
            });

            $(document).on('click', '#restore', function() {
                var globalId = $(this).data('id');
                var url = "{{ url('/admin/admin/restore/') }}"+ "/" + globalId;
                restore(url, 'admin');
            });

            $(document).on('click', '#reset', function() {
                var globalId = $(this).data('id');
                var url = "{{ url('/admin/admin/reset/') }}" + "/" + globalId;
                resetpassword(url);
            });

        </script>
    @endpush
@endsection
