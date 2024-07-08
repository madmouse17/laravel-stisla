@extends('layouts.templates.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hai, {{ Auth::user()->name }}</h2>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form action="{{ route('change.password', auth()->user()->id) }}" method="POST"
                            class="needs-validation" novalidate="">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>Ubah Password</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group col-md-8 col-12">
                                    <label>Password Lama</label>
                                    <input type="password" class="form-control" name="passwordlama" required="">
                                    @if ($errors->has('passwordlama'))
                                        <span class="text-danger">{{ $errors->first('passwordlama') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-8 col-12">
                                    <label>Password Baru</label>
                                    <input type="password" class="form-control" name="passwordbaru" required="">
                                    @if ($errors->has('passwordbaru'))
                                        <span class="text-danger">{{ $errors->first('passwordbaru') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-8 col-12">
                                    <label>Password Konfirmasi</label>
                                    <input type="password" class="form-control" name="passwordbaru_confirmation"
                                        required="">
                                    @if ($errors->has('passwordbaru_confirmation'))
                                        <span class="text-danger">{{ $errors->first('passwordbaru_confirmation') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card">
                        <form action="{{ route('change.email', auth()->user()->id) }}" method="post" class="needs-validation" novalidate="">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>Ubah Email</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-5">
                                        <label>Email</label>
                                        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                                            autocomplete="off" class="form-control" required>
                                            @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                        </form>
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
            var authId = @json(auth()->user()->id);

            function isEmail(email) {
                var EmailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return EmailRegex.test(email);
            }


        </script>
    @endpush
@endsection
