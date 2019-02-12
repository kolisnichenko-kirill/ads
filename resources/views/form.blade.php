@csrf

<div class="form-group row">
    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

    <div class="col-md-6">
        <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ isset($ad->title) ? $ad->title : '' }}" required autofocus>

        @if ($errors->has('title'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

    <div class="col-md-6">

        <textarea name="description" id="description" cols="30" rows="10" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" required>{{ isset($ad->description) ? $ad->description : '' }}</textarea>
        
        @if ($errors->has('description'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>
