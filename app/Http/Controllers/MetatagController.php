<?php

namespace App\Http\Controllers;

use App\Models\Metatag;
use Illuminate\Http\Request;

class MetatagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metatags = Metatag::paginate(5);
        return view('metatag.index',compact('metatags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('metatag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'meta_url' => 'required|string|url|max:255|',
            'meta_code' => 'required|string|max:1000',
        ], [
            'meta_url.regex' => 'The url field must be a valid URL.',
        ]);

        try {

            Metatag::create([
                'url' => $request->meta_url,
                'metatag_code' => $request->meta_code,
            ]);

            return redirect()->route('metatag.index')->with('success', 'Metatag created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'something is rong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Metatag $metatag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $metatags = Metatag::findorFail($id);
        return view('metatag.edit',compact('metatags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
         $request->validate([
            'meta_url' => 'required|string|url|max:255|',
            'meta_code' => 'required|string|max:1000',
        ], [
            'meta_url.regex' => 'The url field must be a valid URL.',
        ]);

         try {
           
          $metatag = Metatag::findOrFail($id);

            $metatag->update([
                'url' => $request->meta_url,
                'metatag_code' => $request->meta_code,
            ]);

            return redirect()->route('metatag.index')->with('success', 'Metatag update successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'something is rong');
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         Metatag::destroy($id);
         return redirect()->route('metatag.index')->with('success','Metatag Delete successfully!');
    }
}
