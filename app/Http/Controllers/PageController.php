<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::paginate(5);
        return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
           return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'page_name'     => 'required|string|max:255',
            'page_link'     => 'required|string|max:255|unique:pages,page_link',
            'page_english'  => 'required|string',
            'page_french'   => 'required|string',
            'page_arabic'   => 'required|string',
        ]);
        
        Page::create([
            'page_name' => $request->page_name,
            'page_link' => $request->page_link,
            'page_en' => $request->page_english,
            'page_fr' => $request->page_french,
            'page_ar' => $request->page_arabic,
        ]);

        return redirect()->route('pages.index')->with('success', 'Page created successfully!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pages = Page::findOrFail($id);
        return view('pages.edit', compact('pages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pages = Page::findorFail($id);


        $pages->page_name = $request->page_name;
        $pages->page_link = $request->page_link;
        $pages->page_en = $request->page_english;
        $pages->page_fr = $request->page_french;
        $pages->page_ar = $request->page_arabic;
        $pages->save();


        return redirect()->route('pages.index')->with('success', 'Page updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Page::destroy($id);

        return redirect()->route('pages.index')->with('success', 'Pages deleted successfully.');
    }
}
