<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Mail\SubmissionSubmitted;

use App\Models\Campaign;
use App\Models\Homepage;
use App\Models\Submission;

use App\Exports\SubmissionsExport;

use Carbon\Carbon;
use Excel;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::all();

        return view('campaign.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campaign.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Campaign::create([
            'name' => $request->name 
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($status = null)
    {
        // get the campaign based on the set environment variable
        $campaign = Campaign::find(env('CAMPAIGN_ID'));

        // find a random homepage that's a relation of this campaign
        $homepage = $campaign->homepages->random();

        // create an array to store the two different types of testimonial
        $testimonials = [
            'top' => $homepage->testimonials->where('position', 'top')->random(),
            'bottom' => $homepage->testimonials->where('position', 'bottom')->random()
        ];

        //another way of doing this ^
        //$top_testimonial = $homepage->testimonials->where('position', 'top')->random();
        //$bottom_testimonial = $homepage->testimonials->where('position', 'bottom')->random();

        //dd($testimonials['top']->name);

        // return the view
        return view('campaign.show', compact('campaign', 'homepage', 'testimonials'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        return view('campaign.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        $campaign->update([
            'name' => $request->name 
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        
        return redirect()->route('campaign.index');
    }

    /**
     * Post the submission form
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Homepage  $homepage
     * 
     * @return \Illuminate\Http\Response
     */
    public function postForm(Request $request, Homepage $homepage)
    {
        $recaptcha = new \ReCaptcha\ReCaptcha($secret);
        $response = $recaptcha->setExpectedHostname('recaptcha-demo.appspot.com')
                        ->verify($gRecaptchaResponse, $remoteIp);
        if ($response->isSuccess()) {
            Submission::create([
            'name' => $request->name,
            'company' => $request->company,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'homepage_number' => $homepage->id,
            ]);

            Mail::to(env('MAIL_RECIPIENT'))->send(new SubmissionSubmitted($request));

            return redirect()->route('campaign.show', 'thanks');
        } 
        else {
            $errors = $response->getErrorCodes();
        };

    }

    /**
     * Generate a spreadsheet of Submissions and return a download response
     * We're including the date so we know when it was generated
     * 
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        // set the date
        $date = Carbon::now()->format('Y-m-d H:i:s');
        
        // set a filename
        $filename = 'submissions ' . $date . '.xlsx';
        
        // return the download response
        return Excel::download(new SubmissionsExport, $filename);

        // or do it all in 1 line
        //return Excel::download(new SubmissionsExport, 'submissions ' . Carbon::now()->format('Y-m-d H:i') . '.xlsx');
    }
}
