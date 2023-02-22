@extends('admin.layouts.app')
@section('title') @lang('transAdmin.categories') @endsection
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="h4 mb-0">
            <a href="{{ route('admin.categories.index') }}">
                <i class="fas fa-caret-left"></i> @lang('transAdmin.categories')
            </a>
            <span class="text-gray-500">/</span>
            @lang('transAdmin.edit')
        </div>
    </div>

    <div class="my-4">
        <form action="{{ route('admin.categories.update', $obj->id) }}" method="post" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            @csrf

            <div class="form-group row">
                <label for="name_tm" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/tkm.png') }}" alt="TKM" class="border">
                    @lang('transAdmin.name') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-4 col-md-8">
                    <input id="name_tm" type="text"
                           class="form-control{{ $errors->has('name_tm') ? ' is-invalid' : '' }}" name="name_tm"
                           value="{{ $obj->name_tm }}" required autofocus>
                    @if($errors->has('name_tm'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name_tm') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="name_ru" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/rus.png') }}" alt="RUS" class="border">
                    @lang('transAdmin.name')
                </label>
                <div class="col-lg-4 col-md-8">
                    <input id="name_ru" type="text"
                           class="form-control{{ $errors->has('name_ru') ? ' is-invalid' : '' }}" name="name_ru"
                           value="{{ $obj->name_ru }}">
                    @if($errors->has('name_ru'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name_ru') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="name_en" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    <img src="{{ asset('img/flag/eng.png') }}" alt="ENG" class="border">
                    @lang('transAdmin.name')
                </label>
                <div class="col-lg-4 col-md-8">
                    <input id="name_en" type="text"
                           class="form-control{{ $errors->has('name_en') ? ' is-invalid' : '' }}" name="name_en"
                           value="{{ $obj->name_en }}">
                    @if($errors->has('name_en'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name_en') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="image" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    @lang('transAdmin.image') <span class="text-secondary">(300x300)</span>
                </label>
                <div class="col-lg-4 col-md-8">
                    <div class="mb-3">
                        @if($obj->image)
                            <img src="{{ Storage::disk('local')->url($obj->image) }}"
                                 alt="{{ $obj->image }}"
                                 class="img-fluid image_upload img-max border">
                        @else
                            <img src="{{ asset('img/temp/category.png') }}" alt="@lang('transAdmin.not-found')"
                                 class="img-fluid image_upload img-max border">
                        @endif
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
                <label for="icon" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    @lang('transAdmin.icon') <span class="text-secondary">(200x200)</span>
                </label>
                <div class="col-lg-4 col-md-8">
                    <div class="custom-file">
                        <input id="icon" type="file"
                               class="custom-file-input {{ $errors->has('icon') ? ' is-invalid' : '' }}"
                               name="icon" onChange="iconUpload(this);">
                        <label class="custom-file-label" for="icon">. . .</label>
                    </div>
                    @if($errors->has('icon'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('icon') }}</strong>
                            </span>
                    @endif
                    <script>
                        function iconUpload(input) {
                            if (input.files && input.files[0]) {
                                var label = input.files[0].name;
                                $('#icon').next('label').text(label);
                            } else {
                                $('#icon').next('label').text(". . .");
                            }
                        }
                    </script>
                </div>
            </div>

            <div class="form-group row">
                <label for="sort_order" class="col-lg-4 col-md-4 col-form-label text-md-right">
                    @lang('transAdmin.sort-order') <span class="text-danger">*</span>
                </label>
                <div class="col-lg-4 col-md-8">
                    <input id="sort_order" type="number" min="1"
                           class="form-control{{ $errors->has('sort_order') ? ' is-invalid' : '' }}" name="sort_order"
                           value="{{ $obj->sort_order }}" required>
                    @if($errors->has('sort_order'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('sort_order') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4 offset-lg-4 col-md-8 offset-md-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="menu" name="menu"
                               value="1" {{ $obj->menu == 1 ? 'checked' : '' }}>
                        <label class="custom-control-label" for="menu">
                            @lang('transAdmin.menu')
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4 offset-lg-4 col-md-8 offset-md-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="main" name="main"
                               value="1" {{ $obj->main == 1 ? 'checked' : '' }}>
                        <label class="custom-control-label" for="main">
                            @lang('transAdmin.main')
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4 offset-lg-4 col-md-8 offset-md-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="advice" name="advice"
                               value="1" {{ $obj->advice == 1 ? 'checked' : '' }}>
                        <label class="custom-control-label" for="advice">
                            @lang('transAdmin.advice')
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4 offset-lg-4 col-md-8 offset-md-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="active" name="active"
                               value="1" {{ $obj->active == 1 ? 'checked' : '' }}>
                        <label class="custom-control-label" for="active">
                            @lang('transAdmin.enable')
                        </label>
                    </div>
                </div>
            </div>

            {{--submit button--}}
            <div class="form-group row mb-0">
                <div class="col-lg-4 offset-lg-4 col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-save"></i> @lang('transAdmin.save')
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection