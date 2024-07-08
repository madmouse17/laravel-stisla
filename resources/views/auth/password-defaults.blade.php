@extends('layouts.guest-stisla')
@section('section')
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-6 col-xl-6 offset-xl-4">
                    <div class="card card-primary">
                        <form action="{{ route('password.default', auth()->user()->id) }}" method="POST"
                            class="needs-validation" novalidate="">
                            @csrf
                            @method("PUT")
                            <div class="card-header">
                                <h4>Ubah Password</h4>
                            </div>
                            <div class="card-body">
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
                                        <span
                                            class="text-danger">{{ $errors->first('passwordbaru_confirmation') }}</span>
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
        </div>
    </section>
@endsection
