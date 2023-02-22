@extends('admin.layouts.app')
@section('title') @lang('transAdmin.pages') @endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/summernote-bs4.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('js/summernote-bs4.min.js') }}"></script>
    
    <div class="d-flex align-items-center justify-content-between">
        <div class="h4 mb-0">
            <a href="{{ route('admin.pages.index') }}">
                <i class="fas fa-caret-left"></i> @lang('transAdmin.pages')
            </a>
            <span class="text-gray-500">/</span>
            @lang('transAdmin.edit')
        </div>
    </div>

    <div class="my-4">
        <form action="{{ route('admin.pages.update', $obj->id) }}" method="post">
            {{ method_field('PUT') }}
            @csrf

            <div class="form-group row">
                <label for="body_tm" class="col-lg-3 col-md-3 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/tkm.png') }}" alt="TKM" class="border">
                    @lang('transAdmin.body') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-7 col-md-9">
                    <textarea id="body_tm"
                              class="form-control{{ $errors->has('body_tm') ? ' is-invalid' : '' }} summernote"
                              name="body_tm" rows="3" required>{!! $obj->body_tm !!}</textarea>
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
                              name="body_ru" rows="3">{{ $obj->body_ru }}</textarea>
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
                              name="body_en" rows="3">{{ $obj->body_en }}</textarea>
                    @if($errors->has('body_en'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('body_en') }}</strong>
                            </span>
                    @endif
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