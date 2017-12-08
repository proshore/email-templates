@extends($current_layout)
@section('content')
    <h1>
        Email Templates
        @if($displayAdd)
            <a href="{{ route('emailtemplates.create') }}" class="btn btn-primary pull-right btn-sm">
                Add New Template
            </a>
        @endif
    </h1>

    @if(session()->has('flash_notification.message'))
        <div class="alert alert-{{ session('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

            {{ session('flash_notification.message') }}
        </div>
    @endif

    @if(count($emailTemplates))
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>Identifier</th>
                    <th>Title</th>
                    <th>Subject</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($emailTemplates as $emailTemplate)
                    <tr>
                        <td>{{ $emailTemplate->slug }}</td>
                        <td>{{$emailTemplate->title}}</td>
                        <td>{{$emailTemplate->subject}}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('emailtemplates.edit', ['id' => $emailTemplate->id]) }}">Edit</a> |
                            {{ Form::open(array('route' => array('emailtemplates.delete', $emailTemplate->id), 'class' => 'pull-right', 'style' => 'display:inline;')) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("'._("Are you sure you want to delete this?").'")')) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center">
            <h3>No templates available yet</h3>
            <p>
                <a href="{{ route('emailtemplates.create') }}">
                    Create new template
                </a>
            </p>
        </div>
    @endif

@stop