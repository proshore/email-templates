<?php
namespace Proshore\EmailTemplates\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Proshore\EmailTemplates\Models\EmailTemplate;
use Config;
/**
 * Class EmailTemplatesController
 * @package App\Http\Controllers
 */
class EmailTemplatesController extends BaseController
{
    public function index()
    {
        $remainingCount = 0;
        $templateSlugs = Config::get('proshore-email-templates.template_slugs');
        $slugsCount = count($templateSlugs);
        $displayAdd = true;

        $emailTemplates = EmailTemplate::all();
        foreach($emailTemplates as $emailTemplate) {
            if (in_array($emailTemplate->slug, $templateSlugs)) {
                $remainingCount++;
            }
        }

        if ($remainingCount >= $slugsCount) {
            $displayAdd = false;
        }


        return view('proshore-email-templates::index', compact('emailTemplates', 'displayAdd'));
    }

    public function create()
    {
        $templateSlugs = Config::get('proshore-email-templates.template_slugs');
        $templateSlugs = array_combine($templateSlugs, $templateSlugs);

        $emailTemplates = EmailTemplate::all();

        foreach($emailTemplates as $emailTemplate) {
            if ( in_array($emailTemplate->slug, $templateSlugs) ) {
                unset($templateSlugs[$emailTemplate->slug]);
            }
        }

        return view('proshore-email-templates::create', compact('templateSlugs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required',
            'title' =>  'required',
            'subject' => 'required',
            'content' => 'required'
        ]);

        EmailTemplate::create([
            'slug' => $request->get('slug'),
            'title' => $request->get('title'),
            'subject' => $request->get('subject'),
            'content' => $request->get('content')
        ]);

        return redirect()
            ->route('emailtemplates.index')
            ->with('flash_notification.message', 'Template created successfully')
            ->with('flash_notification.level', 'success');
    }

    public function edit($id)
    {
        $templateSlugs = Config::get('proshore-email-templates.template_slugs');
        $templateSlugs = array_combine($templateSlugs, $templateSlugs);

        $emailTemplate = EmailTemplate::find($id);

        if ($emailTemplate == null) {
            return redirect()
                ->route('emailtemplates.index');
        }
        else {
            return view('proshore-email-templates::edit', compact('emailTemplate', 'templateSlugs'));
        }
    }

    public function update($id)
    {
        $rules = [
            'title' =>  'required',
            'subject' => 'required',
            'content' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect('emailtemplates/edit/' . $id)
                ->withErrors($validator)
                ->withInput(Input::all());
        }
        else {
            $emailTemplate = EmailTemplate::find($id);
            $emailTemplate->title = Input::get('title');
            $emailTemplate->subject = Input::get('subject');
            $emailTemplate->content = Input::get('content');

            $emailTemplate->save();
            return redirect()
                ->route('emailtemplates.index')
                ->with('flash_notification.message', 'Template updated successfully')
                ->with('flash_notification.level', 'success');
        }

    }

    public function destroy($id)
    {
        $emailTemplate = EmailTemplate::find($id);
        if ($emailTemplate == null) {
            return redirect()
                ->route('emailtemplates.index');
        }
        else {
            $emailTemplate->delete();
            return redirect()
                ->route('emailtemplates.index')
                ->with('flash_notification.message', 'Template deleted successfully')
                ->with('flash_notification.level', 'success');
        }
    }

    public function uploadImage()
    {
        if (Request::hasFile('file')) {
            $response = \EmailTemplates::upload(Request::file('file'));
            if ($response['status']) {
                echo json_encode([
                    'location'  =>  $response['message']
                ]);
            }
            return;
        }
    }
}
