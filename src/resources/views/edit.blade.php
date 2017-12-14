@extends($current_layout)
@section('content')

    {{ Form::open(array('route' => array('email-templates.update', $emailTemplate->id), 'method' => 'put')) }}
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
@push(config('proshore.email-templates.script-stack'))
    <script src="{{ asset('vendor/proshore-email-templates/js') }}/email-templates.js"></script>
@endpush