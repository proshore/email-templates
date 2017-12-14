@extends($current_layout)
@section('content')

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
                            <a class="btn btn-primary" href="{{ route('email-templates.edit', ['id' => $emailTemplate->id]) }}">Edit</a>
                            {{ Form::open(array('route' => array('email-templates.destroy', $emailTemplate->id), 'method' =>'DELETE', 'class' => 'pull-right', 'style' => 'display:inline;')) }}
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
                <a href="{{ route('email-templates.create') }}">
                    Create new template
                </a>
            </p>
        </div>
    @endif

@stop