@extends('admin.layouts.app')
@section('title') @lang('transAdmin.magazines') @endsection
@section('content')
    <script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
    @if(app()->getLocale() == 'tm')
        <script type="text/javascript" src="{{ asset('js/moment/tk.js') }}"></script>
    @elseif(app()->getLocale() == 'ru')
        <script type="text/javascript" src="{{ asset('js/moment/ru.js') }}"></script>
    @endif
    <script type="text/javascript" src="{{ asset('js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tempusdominus-bootstrap-4.min.css') }}"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/summernote-bs4.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('js/summernote-bs4.min.js') }}"></script>

    <div class="d-flex align-items-center justify-content-between">
        <div class="h4 mb-0">
            <a href="{{ route('admin.magazines.index') }}">
                <i class="fas fa-caret-left"></i> @lang('transAdmin.magazines')
            </a>
            <span class="text-gray-500">/</span>
            @lang('transAdmin.create')
        </div>
    </div>

    <div class="my-4">
        <form action="{{ route('admin.magazines.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <label for="title_tm" class="col-lg-3 col-md-3 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/tkm.png') }}" alt="TKM" class="border">
                    @lang('transAdmin.title') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-7 col-md-9">
                    <input id="title_tm" type="text"
                           class="form-control{{ $errors->has('title_tm') ? ' is-invalid' : '' }}" name="title_tm"
                           value="{{ old('title_tm') }}" required autofocus>
                    @if($errors->has('title_tm'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title_tm') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="title_ru" class="col-lg-3 col-md-3 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/rus.png') }}" alt="RUS" class="border">
                    @lang('transAdmin.title')
                </label>
                <div class="col-lg-7 col-md-9">
                    <input id="title_ru" type="text"
                           class="form-control{{ $errors->has('title_ru') ? ' is-invalid' : '' }}" name="title_ru"
                           value="{{ old('title_ru') }}">
                    @if($errors->has('title_ru'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title_ru') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="title_en" class="col-lg-3 col-md-3 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/eng.png') }}" alt="ENG" class="border">
                    @lang('transAdmin.title')
                </label>
                <div class="col-lg-7 col-md-9">
                    <input id="title_en" type="text"
                           class="form-control{{ $errors->has('title_en') ? ' is-invalid' : '' }}" name="title_en"
                           value="{{ old('title_en') }}">
                    @if($errors->has('title_en'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title_en') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="body_tm" class="col-lg-3 col-md-3 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/tkm.png') }}" alt="TKM" class="border">
                    @lang('transAdmin.body') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-7 col-md-9">
                    <textarea id="body_tm"
                              class="form-control{{ $errors->has('body_tm') ? ' is-invalid' : '' }} summernote"
                              name="body_tm" rows="3" required>{!! old('body_tm') !!}</textarea>
                    @if($errors->has('body_tm'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('body_tm') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="body_ru" class="col-lg-3 col-md-3 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/rus.png') }}" alt="RUS" class="border">
                    @lang('transAdmin.body')
                </label>
                <div class="col-lg-7 col-md-9">
                    <textarea id="body_ru"
                              class="form-control{{ $errors->has('body_ru') ? ' is-invalid' : '' }} summernote"
                              name="body_ru" rows="3">{{ old('body_ru') }}</textarea>
                    @if($errors->has('body_ru'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('body_ru') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="body_en" class="col-lg-3 col-md-3 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/eng.png') }}" alt="ENG" class="border">
                    @lang('transAdmin.body')
                </label>
                <div class="col-lg-7 col-md-9">
                    <textarea id="body_en"
                              class="form-control{{ $errors->has('body_en') ? ' is-invalid' : '' }} summernote"
                              name="body_en" rows="3">{{ old('body_en') }}</textarea>
                    @if($errors->has('body_en'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('body_en') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="published_at" class="col-lg-3 col-md-3 col-form-label text-md-right">
                    @lang('transAdmin.published-at') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-7 col-md-9">
                    <div class="input-group date" id="published_at" data-target-input="nearest">
                        <input type="text"
                               class="form-control{{ $errors->has('published_at') ? ' is-invalid' : '' }} datetimepicker-input"
                               data-target="#published_at" name="published_at"
                               value="{{ date('d.m.Y H:i') }}" required>
                        <div class="input-group-append" data-target="#published_at" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            $('#published_at').datetimepicker({
                                format: 'DD.MM.YYYY HH:mm',
                                icons: {time: "fas fa-clock",}
                            });
                        });
                    </script>
                    @if($errors->has('published_at'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('published_at') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="image" class="col-lg-3 col-md-3 col-form-label text-md-right">
                    @lang('transAdmin.image') <span class="text-secondary">(450x600)</span>
                </label>
                <div class="col-lg-7 col-md-9">
                    <div class="mb-3">
                        <img src="{{ asset('img/temp/magazine.png') }}" alt="@lang('transAdmin.not-found')"
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
                <label for="file" class="col-lg-3 col-md-3 col-form-label text-md-right">
                    @lang('transAdmin.file') <span class="text-secondary">(pdf)</span>
                </label>
                <div class="col-lg-7 col-md-9">
                    <div class="custom-file">
                        <input id="file" type="file"
                               class="custom-file-input {{ $errors->has('file') ? ' is-invalid' : '' }}"
                               name="file" onChange="fileUpload(this);">
                        <label class="custom-file-label" for="file">. . .</label>
                    </div>
                    @if($errors->has('file'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('file') }}</strong>
                            </span>
                    @endif
                    <script>
                        function fileUpload(input) {
                            if (input.files && input.files[0]) {
                                var label = input.files[0].name;
                                $('#file').next('label').text(label);
                            } else {
                                $('#file').next('label').text(". . .");
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

    <script>
        $('.summernote').summernote({
            tabsize: 2,
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview']],
            ]
        });
    </script>
    <style>
        .note-group-select-from-files {
            display: none;
        }
    </style>
@endsection