@extends($current_layout)
@section('content')
    <h1>
        Create Email Template
    </h1>
    @include('partials.flash_notification')
    {{ Form::open(array('route' => 'emailtemplates.store')) }}
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">

    <div class="form-group">
        <label for="identifier">Identifier *</label>
        <select class="form-control" id="slug" name="slug">
            @foreach($templateSlugs as $templateSlug)
                <option value="{{ $templateSlug }}">
                    {{ $templateSlug }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="title">Title *</label>
        <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelp" placeholder="Template Title">
        <small id="titleHelp" class="form-text text-muted">
            Template title is only for informational purpose.
        </small>
    </div>
    <div class="form-group">
        <label for="subject">Subject *</label>
        <input type="text" class="form-control" name="subject" id="subject" placeholder="Template Subject">
    </div>
    <div class="form-group">
        <label for="content">Content *</label>
        <textarea class="form-control" name="content" id="content" rows="10"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    {{ Form::close() }}
@stop
@section('scripts')
    <script src="{{ asset('vendor/email-templates/js') }}/email-templates.js"></script>
@stop