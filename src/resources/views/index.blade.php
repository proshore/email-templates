@extends($current_layout)

@section('content')

    @include('admin.partials.page-header', ['pageTitle' => __('Email Templates')])
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h3 class="h4">{{ __('List Email Templates') }}</h3>
                            @if($displayAdd)
                                <a class="btn btn-sm btn-primary" href="{{ route('email-templates.create') }}">
                                    Create new template
                                </a>
                            @endif
                        </div>
                        <div class="card-body">

                            <tr class="table-responsive">

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
                                    @if(count($emailTemplates))
                                        @foreach($emailTemplates as $emailTemplate)
                                            <tr>
                                                <td>{{ $emailTemplate->slug }}</td>
                                                <td>{{$emailTemplate->title}}</td>
                                                <td>{{$emailTemplate->subject}}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-info dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{ __('More Action') }}
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                            {!! link_to_route('email-templates.edit', 'Edit', $emailTemplate->id, ['class' => 'dropdown-item']); !!}
                                                            {{ Form::open(array('route' => array('email-templates.destroy', $emailTemplate->id), 'method' =>'DELETE')) }}
                                                            {{ Form::submit('Delete', array('class' => 'dropdown-item', 'onclick' => 'return confirm("'._("Are you sure you want to delete this?").'")')) }}
                                                            {{ Form::close() }}
                                                        </div>
                                                    </div>


                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                No templates available yet
                                            </td>

                                        </tr>
                                    @endif
                                    </tbody>
                                </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection