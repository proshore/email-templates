@extends($current_layout)
@section('content')
    <h1>
        Edit Template:: {{ $emailTemplate->title }}
    </h1>
    @include('partials.flash_notification')
    {{ Form::open(array('route' => array('emailtemplates.update', $emailTemplate->id))) }}
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">

    <div class="form-group">
        <label for="identifier">Identifier: </label>
        <span><strong>{{ $emailTemplate->slug }}</strong></span>
    </div>
    <div class="form-group">
        <label for="title">Title *</label>
        <input type="text" class="form-control" name="title" id="title" value="{{ $emailTemplate->title }}" aria-describedby="titleHelp" placeholder="Template Title">
    </div>
    <div class="form-group">
        <label for="subject">Subject *</label>
        <input type="text" class="form-control" name="subject" id="subject" value="{{ $emailTemplate->subject }}" placeholder="Template Subject">
    </div>
    <div class="form-group">
        <label for="content">Content *</label>
        <textarea class="form-control" name="content" id="content" rows="10">{{ $emailTemplate->content }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    {{ Form::close() }}
@stop
@section('scripts')
    <script src="{{ asset('vendor/email-templates/js') }}/email-templates.js"></script>
@stop