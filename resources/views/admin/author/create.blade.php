@extends('admin.layouts.app')
@section('title') @lang('transAdmin.authors') @endsection
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="h4 mb-0">
            <a href="{{ route('admin.authors.index') }}">
                <i class="fas fa-caret-left"></i> @lang('transAdmin.authors')
            </a>
            <span class="text-gray-500">/</span>
            @lang('transAdmin.create')
        </div>
    </div>

    <div class="my-4">
        <form action="{{ route('admin.authors.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <label for="name_tm" class="col-lg-3 col-md-3 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/tkm.png') }}" alt="TKM" class="border">
                    @lang('transAdmin.name') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-7 col-md-9">
                    <input id="name_tm" type="text"
                           class="form-control{{ $errors->has('name_tm') ? ' is-invalid' : '' }}" name="name_tm"
                           value="{{ old('name_tm') }}" required autofocus>
                    @if($errors->has('name_tm'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name_tm') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="name_ru" class="col-lg-3 col-md-3 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/rus.png') }}" alt="RUS" class="border">
                    @lang('transAdmin.name')
                </label>
                <div class="col-lg-7 col-md-9">
                    <input id="name_ru" type="text"
                           class="form-control{{ $errors->has('name_ru') ? ' is-invalid' : '' }}" name="name_ru"
                           value="{{ old('name_ru') }}">
                    @if($errors->has('name_ru'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name_ru') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="name_en" class="col-lg-3 col-md-3 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/eng.png') }}" alt="ENG" class="border">
                    @lang('transAdmin.name')
                </label>
                <div class="col-lg-7 col-md-9">
                    <input id="name_en" type="text"
                           class="form-control{{ $errors->has('name_en') ? ' is-invalid' : '' }}" name="name_en"
                           value="{{ old('name_en') }}">
                    @if($errors->has('name_en'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name_en') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="job_tm" class="col-lg-3 col-md-3 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/tkm.png') }}" alt="TKM" class="border">
                    @lang('transAdmin.job') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-7 col-md-9">
                    <textarea id="job_tm"
                              class="form-control{{ $errors->has('job_tm') ? ' is-invalid' : '' }}"
                              name="job_tm" rows="2" required>{!! old('job_tm') !!}</textarea>
                    @if($errors->has('job_tm'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('job_tm') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="job_ru" class="col-lg-3 col-md-3 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/rus.png') }}" alt="RUS" class="border">
                    @lang('transAdmin.job')
                </label>
                <div class="col-lg-7 col-md-9">
                    <textarea id="job_ru"
                              class="form-control{{ $errors->has('job_ru') ? ' is-invalid' : '' }}"
                              name="job_ru" rows="2">{{ old('job_ru') }}</textarea>
                    @if($errors->has('job_ru'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('job_ru') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="job_en" class="col-lg-3 col-md-3 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/eng.png') }}" alt="ENG" class="border">
                    @lang('transAdmin.job')
                </label>
                <div class="col-lg-7 col-md-9">
                    <textarea id="job_en"
                              class="form-control{{ $errors->has('job_en') ? ' is-invalid' : '' }}"
                              name="job_en" rows="2">{{ old('job_en') }}</textarea>
                    @if($errors->has('job_en'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('job_en') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="image" class="col-lg-3 col-md-3 col-form-label text-md-right">
                    @lang('transAdmin.image') <span class="text-secondary">(300x300)</span>
                </label>
                <div class="col-lg-7 col-md-9">
                    <div class="mb-3">
                        <img src="{{ asset('img/temp/author.png') }}" alt="@lang('transAdmin.not-found')"
                             class="img-fluid image_upload img-max border">
                    </div>
                    <div class="custom-file">
                        <input id="image" type="file"
                               class="custom-file-input {{ $errors->has('image') ? ' is-invalid' : '' }}"
                               name="image" accept="image/*" onChange="imageUpload(this);">
                        <label class="custom-file-label" for="image">. . .</label>
                    </div>
                    @if($errors->has('image'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                    @endif
                    <script>
                        function imageUpload(input) {
                            if (input.files && input.files[0]) {
                                var label = input.files[0].name;
                                $('#image').next('label').text(label);
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    $('.image_upload').attr('src', e.target.result);
                                };
                                reader.readAsDataURL(input.files[0]);
                            } else {
                                $('#image').next('label').text(". . .");
                                $('.image_upload').attr('src', "{{ asset('img/temp/category.png') }}");
                            }
                        }
                    </script>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-7 offset-lg-3 col-md-9 offset-md-3">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="active" name="active"
                               value="1">
                        <label class="custom-control-label" for="active">
                            @lang('transAdmin.enable')
                        </label>
                    </div>
                </div>
            </div>

            {{--submit button--}}
            <div class="form-group row mb-0">
                <div class="col-lg-7 offset-lg-3 col-md-9 offset-md-3">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-save"></i> @lang('transAdmin.save')
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection