<?php

namespace App\Http\Controllers;

use App\Models\Salesperson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Homepage;

class SalespersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salespeople = Salesperson::all();

        return view('salesperson.index', compact('salespeople'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        {
            return view('salesperson.create');
        }
    
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
            'name' => 'required',
            'title' => 'required',
            'picture' => 'required',
            'linkedin' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        if($request->hasFile('picture')){
            $newFilename = Str::slug($request->name) . '.' . $request->picture->extension();
            $request->file('picture')->storeAs(
                'salesperson', $newFilename, 'public'
            );

            Salesperson::create([
                'name' => $request->name,
                'title' => $request->title,
                'picture' => $newFilename,
                'linkedin' => $request->linkedin,
            ]);
    
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salesperson  $salesperson
     * @return \Illuminate\Http\Response
     */
    public function show(Salesperson $salesperson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salesperson  $salesperson
     * @return \Illuminate\Http\Response
     */
    public function edit(Salesperson $salesperson)
    {
        return view('salesperson.edit', compact('salesperson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salesperson  $salesperson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salesperson $salesperson)
    {
        if($request->hasFile('picture')){
            $newFilename = Str::slug($request->name) . '.' . $request->picture->extension();
            $request->file('picture')->storeAs(
                'salesperson', $newFilename, 'public'
            );
        }

        $salesperson->update([
            'name' => $request->name,
            'title' => $request->title,
            'picture' => isset($newFilename) ? $newFilename : $salesperson->picture,
            'linkedin' => $request->linkedin,
        ]);

        /* another way... 
        $salesperson->name = $request->name;
        $salesperson->title = $request->title;
        if($request->hasFile('picture')){
            $newFilename = Str::slug($request->name) . '.' . $request->picture->extension();
            $request->file('picture')->storeAs(
                'salesperson', $newFilename, 'public'
            );
            $salesperson->picture = $request->picture;
        }
        $salesperson->linkedin = $request->linkedin;
        $salesperson->save(); */
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salesperson  $salesperson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salesperson $salesperson)
    {
        $salesperson->delete();

        return redirect()->route('salesperson.index');
    }
}
