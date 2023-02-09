<?php

namespace App\Http\Controllers;

use App\Models\Homepage;
use App\Models\Testimonial;
use App\Models\Salesperson;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homepages = Homepage::all();

        return view('homepage.index', compact('homepages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campaigns = Campaign::all();
        $salespeople = Salesperson::all();
        $top_testimonials = Testimonial::where('position', 'top')->get();
        $bottom_testimonials = Testimonial::where('position', 'bottom')->get();

        return view('homepage.create', compact('campaigns','top_testimonials', 'bottom_testimonials', 'salespeople'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'campaign_id' => 'required',
            'header_text' => 'required',
            'header_image' => 'required',
            'button_text' => 'required',
            'main_content' => 'required',
            'salesperson_id' => 'required',
            'bottom_content' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        if($request->hasFile('header_image')){
            $newFilename = Str::slug($request->header_image) . '.' . $request->header_image->extension();
            $request->file('header_image')->storeAs(
                'headerimage', $newFilename, 'public'
            );
            
            $homepage = Homepage::create([
                'campaign_id' => $request->campaign_id,
                'use_white_logo' => $request->use_white_logo == 1 ? $request->use_white_logo : 0,
                'header_text' => $request->header_text,
                'header_image' => $request->header_image,
                'button_text' => $request->button_text,
                'main_content' => $request->main_content,
                'youtube_video_id' => $request->youtube_video_id,
                'salesperson_id' => $request->salesperson_id,
                'bottom_content' => $request->bottom_content,
            ]);
            
            $homepage->testimonials()->sync($request->testimonials);

            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Homepage  $homepage
     * @return \Illuminate\Http\Response
     */
    public function show(Homepage $homepage)
    {
        //$salespeople = Salesperson::all();

        //return view('homepage.edit', compact('homepage', 'top_testimonials', 'bottom_testimonials', 'salespeople'));
        return view('homepage.edit', compact('homepage', 'top_testimonials', 'bottom_testimonials'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Homepage  $homepage
     * @return \Illuminate\Http\Response
     */
    public function edit(Homepage $homepage)
    {
        $homepage->load('campaign');
        $salespeople = Salesperson::all();
        $top_testimonials = Testimonial::where('position', 'top')->get();
        $bottom_testimonials = Testimonial::where('position', 'bottom')->get();

        return view('homepage.edit', compact('homepage', 'top_testimonials', 'bottom_testimonials', 'salespeople'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Homepage  $homepage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Homepage $homepage)
    {

        if($request->hasFile('header_image')){
            $newFilename = Str::slug($request->header_image) . '.' . $request->header_image->extension();
            $request->file('header_image')->storeAs(
                'headerimage', $newFilename, 'public'
            );
        }

        $homepage->update([
            'use_white_logo' => $request->use_white_logo == 1 ? $request->use_white_logo : 0,
            'header_text' => $request->header_text,
            'header_image' => isset($newFilename) ? $newFilename : $homepage->header_image,
            'button_text' => $request->button_text,
            'main_content' => $request->main_content,
            'youtube_video_id' => $request->youtube_video_id,
            'salesperson_id' => $request->salesperson_id,
            'bottom_content' => $request->bottom_content,
        ]);
        
        $homepage->testimonials()->sync($request->testimonials);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Homepage  $homepage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Homepage $homepage)
    {
        $homepage->testimonials()->detach();
        $homepage->delete();

        return redirect()->route('homepage.index');
    }
}
