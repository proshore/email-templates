<?php

namespace Proshore\EmailTemplates\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Proshore\EmailTemplates\Http\Requests\EmailTemplateRequest;
use Proshore\EmailTemplates\Models\EmailTemplate;

/**
 * Class EmailTemplatesController.
 */
class EmailTemplatesController extends BaseController
{
    public function index()
    {
        $emailTemplates = EmailTemplate::all();

        $displayAdd = $this->canAddTemplates();

        return view('proshore-email-templates::index', compact('emailTemplates', 'displayAdd'));
    }

    private function canAddTemplates()
    {
        $remainingCount = 0;
        $templateSlugs = config('proshore.email-templates.template_slugs');
        $slugsCount = count($templateSlugs);
        $displayAdd = true;

        $emailTemplates = EmailTemplate::all();
        foreach ($emailTemplates as $emailTemplate) {
            if (in_array($emailTemplate->slug, $templateSlugs, false)) {
                $remainingCount++;
            }
        }

        if ($remainingCount >= $slugsCount) {
            $displayAdd = false;
        }

        return $displayAdd;
    }

    public function create()
    {
        if (! $this->canAddTemplates()) {
            return redirect()->route('email-templates.index')->with('error', __('No more templates can be created.'));
        }

        $templateSlugs = config('proshore.email-templates.template_slugs');
        $templateSlugs = array_combine($templateSlugs, $templateSlugs);

        $emailTemplates = EmailTemplate::all();

        foreach ($emailTemplates as $emailTemplate) {
            if (in_array($emailTemplate->slug, $templateSlugs, false)) {
                unset($templateSlugs[$emailTemplate->slug]);
            }
        }

        return view('proshore-email-templates::create', compact('templateSlugs'));
    }

    public function store(EmailTemplateRequest $request)
    {
        EmailTemplate::create([
            'slug'    => $request->get('slug'),
            'title'   => $request->get('title'),
            'subject' => $request->get('subject'),
            'content' => $request->get('content'),
        ]);

        return redirect()->route('email-templates.index')->with('success', __('Email Template created successfully'));
    }

    public function edit($id)
    {
        $templateSlugs = config('proshore.email-templates.template_slugs');
        $templateSlugs = array_combine($templateSlugs, $templateSlugs);

        $emailTemplate = EmailTemplate::find($id);

        if ($emailTemplate == null) {
            return redirect()
                ->route('email-templates.index');
        } else {
            return view('proshore-email-templates::edit', compact('emailTemplate', 'templateSlugs'));
        }
    }

    public function update(EmailTemplateRequest $request, $id)
    {
        $emailTemplate = EmailTemplate::findOrFail($id);

        $emailTemplate->title = Input::get('title');
        $emailTemplate->subject = Input::get('subject');
        $emailTemplate->content = Input::get('content');

        $emailTemplate->save();

        return redirect()->route('email-templates.index')->with('success', __('Email Template updated successfully'));
    }

    public function destroy($id)
    {
        $emailTemplate = EmailTemplate::findOrFail($id);
        $emailTemplate->delete();

        return redirect()->route('email-templates.index')->with('success', __('Email Template deleted successfully'));
    }

    public function uploadImage()
    {
        if (Request::hasFile('file')) {
            $response = \EmailTemplates::upload(Request::file('file'));
            if ($response['status']) {
                echo json_encode([
                    'location'  => $response['message'],
                ]);
            }

            return;
        }
    }

    public function templates($slug)
    {
        $templateName = 'template_'.$slug;
        return view('proshore-email-templates::templates.'.$templateName, compact('emailTemplates', 'displayAdd'));
    }
}
