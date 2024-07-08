@extends('layouts.login-guest')
@section('section')
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="{{ asset('/images/logo/' . $site->logo) }}" alt="logo" width="100"
                            class="shadow-light rounded-circle">
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Masuk</h4>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div style="color: red">{{ $error }}</div>
                                @endforeach
                            @endif
                            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ old('email') }}" tabindex="1" required autofocus>
                                    <div class="invalid-feedback">
                                        Email tidak boleh kosong
                                    </div>
                                </div>

                                <div class="form-group">
                                    @if (Route::has('password.request'))
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <div class="float-right">
                                                <a href="{{ route('password.request') }}" class="text-small">
                                                    Lupa Password?
                                                </a>
                                            </div>
                                    @endif
                                </div>
                                <div class="input-group mb-2">

                                    <input id="password" type="password" class="form-control" name="password"
                                        tabindex="2" required>
                                    <div class="input-group-append" id="showpwd">
                                        <div class="input-group-text"><i class="far fa-eye-slash" id="eye"></i></div>
                                    </div>
                                    <div class="invalid-feedback">
                                        Password tidak boleh kosong
                                    </div>
                                </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Masuk
                            </button>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
            <footer class="simple-footer">
                Copyright &copy; {{ $site->title }} {{ date('Y') }}
            </footer>
        </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $('#showpwd').on('mousedown touchstart', function() {
            $('#eye').removeClass('far fa-eye-slash');
            $('#eye').addClass('far fa-eye');
            $("#password").prop('type', 'text');
        }).on('mouseup mouseleave touchend', function() {
            $('#eye').removeClass('far fa-eye');
            $('#eye').addClass('far fa-eye-slash');
            $("#password").prop('type', 'password');
        });
    </script>
@endpush
