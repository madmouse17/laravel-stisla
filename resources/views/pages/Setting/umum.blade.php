<div class=" tab-pane fade show active" id="content-umum" role="tabpanel" aria-labelledby="tab-umum">
    <form id="setting-form" action="{{ route('sitesetting.update', $data->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card" id="settings-card">
            <div class="card-header">
                <h4>Umum</h4>
            </div>
            <div class="card-body">
                <p class="text-muted">Pengaturan.</p>
                <div class="form-group row align-items-center">
                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Nama</label>
                    <div class="col-sm-6 col-md-9">
                        <input type="text" name="title" value="{{ $data->title }}" class="form-control"
                            id="site-title">
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label for="site-description" class="form-control-label col-sm-3 text-md-right">Alamat</label>
                    <div class="col-sm-6 col-md-9">
                        <textarea class="form-control" name="description" id="site-description">{{ $data->description }}</textarea>
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label class="form-control-label col-sm-3 text-md-right">Logo</label>
                    <div class="col-sm-6 col-md-9">

                        <input type="file" name="logo" class="dropify"
                            data-default-file="{{ asset('images/logo/' . $data->logo) }}" id="site-logo"
                            data-max-file-size="2M" data-show-loader="true" data-allowed-file-extensions="png"
                            data-show-errors="true">


                        <div class="form-text text-muted">Logo maksimal memiliki ukuran 2MB</div>
                    </div>
                </div>
                {{-- <div class="form-group row align-items-center">
                    <label class="form-control-label col-sm-3 text-md-right">Favicon</label>
                    <div class="col-sm-6 col-md-9">
                        <div class="custom-file">
                            <input type="file" name="favicon" class="custom-file-input"
                                id="site-favicon" value="{{ $data->favicon }}">
                            <label class="custom-file-label">Pilih File</label>
                        </div>
                        <div class="form-text text-muted">favicon maksimal memiliki ukuran 2MB</div>
                    </div>
                </div> --}}

            </div>
            <div class="card-footer bg-whitesmoke text-md-right">
                <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Seret dan lepas file di sini atau klik',
                'replace': 'Seret dan lepas atau klik untuk mengganti',
                'remove': 'Hapus',
                'error': 'Ooops, Terjadi Kesalahan'
            }
        });
    </script>
@endpush
