@extends($current_layout)

@section('content')
    @include('admin.partials.page-header', ['pageTitle' => __('Email Templates')])
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h3 class="h4">{{ __('Create Template') }}</h3>
                        </div>
                        <div class="card-body">
                            {{ Form::open(array('route' => 'email-templates.store', 'method' => 'post')) }}
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
                                <input type="text" class="form-control" name="title" id="title"
                                       aria-describedby="titleHelp" placeholder="Template Title">
                                <small id="titleHelp" class="form-text text-muted">
                                    Template title is only for informational purpose.
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject *</label>
                                <input type="text" class="form-control" name="subject" id="subject"
                                       placeholder="Template Subject">
                            </div>
                            <div>
                                <a data-toggle="modal" data-target="#tokensModal" class="btn btn-sm btn-primary mb-3" style="color: white; cursor: pointer;">
                                    See Available Tokens <i class="fa fa-info-circle"></i>
                                </a>
                                <?php
                                $templateTokens = config('proshore.email-templates.template_tokens.ACTIVATION_EMAIL');
                                ?>
                                <div id="tokensModal" tabindex="-1" role="dialog" aria-labelledby="tokensModalLabel" class="modal fade text-left" style="display: none;" aria-hidden="true">
                                    <div role="document" class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 id="exampleModalLabel" class="modal-title">
                                                    {{ __('Available Tokens') }}
                                                </h4>
                                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>For</th>
                                                        <th>Use</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($templateTokens as $templateToken)
                                                        <tr>
                                                            <td>
                                                                {{
                                                                    ucwords(str_replace('_', ' ', $templateToken))
                                                                }}
                                                            </td>
                                                            <td>
                                                                {{ '[[' . $templateToken . ']]' }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content">Content *</label>
                                <textarea class="form-control" name="content" id="content" rows="10"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push(config('proshore.email-templates.script-stack'))
    <script src="{{ asset('vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/proshore-email-templates/js/email-templates.js') }}"></script>
@endpush