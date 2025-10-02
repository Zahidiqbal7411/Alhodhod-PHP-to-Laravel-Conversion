<?php

namespace App\Http\Controllers;

use App\Models\BannerAdd;
use Illuminate\Http\Request;

class BannerAddController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adds = BannerAdd::paginate(4);
        return view('banner_add.index', compact('adds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ad_type'     => 'required|in:1,2,3',
            'ad_link'     => 'required|url',
            'ad_title'    => 'required|string|max:255',
            'ad_url'      => 'nullable|string|max:255',
            'ad_image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'languages'   => 'required|array|min:1',
            'languages.*' => 'in:1,2,3',
        ], [
            'ad_type.required'     => 'This field is required.',
            'ad_link.required'     => 'This field is required.',
            'ad_title.required'    => 'This field is required.',
            'ad_url.max'           => 'URL is too long.',
            'ad_image.image'       => 'Only image files are allowed.',
            'languages.required'   => 'Please select at least one language.',
        ]);

        // ❌ Do not allow both fields together
        if ($request->filled('ad_url') && $request->hasFile('ad_image')) {
            return back()->withErrors([
                'ad_url' => 'Please provide either Ad URL or Upload Image — not both.'
            ])->withInput();
        }

        // ✅ Determine what to store in `ad_url`
        $finalAdUrl = null;

        if ($request->hasFile('ad_image')) {
            $img = $request->file('ad_image');
            $fileName = time() . '_' . $img->getClientOriginalName();
            $path = 'uploadimage/bannerimage/';
            $img->move(public_path($path), $fileName);
            $finalAdUrl = $path . $fileName; // store image path in `ad_url`
        } elseif ($request->filled('ad_url')) {
            $finalAdUrl = $request->ad_url; // store URL directly
        }

        // ✅ Convert languages to individual 1/0 fields
        $langs = $request->languages;
        $en = in_array(1, $langs) ? 1 : 0;
        $fr = in_array(2, $langs) ? 1 : 0;
        $ar = in_array(3, $langs) ? 1 : 0;

        BannerAdd::create([
            'ad_type'    => $request->ad_type,
            'ad_link'    => $request->ad_link,
            'ad_text'    => $request->ad_title,
            'ad_url'     => $finalAdUrl, // final value: either image path or URL
            'en'         => $en,
            'fr'         => $fr,
            'ar'         => $ar,
            'ad_clicks'  => 0,
            'ad_status'  => 1,
        ]);

        return redirect()->route('ads.index')->with('success', 'Advertisement added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $ad = BannerAdd::findOrFail($id);

        $hasImage = $ad->ad_url && file_exists(public_path($ad->ad_url));

        return response()->json([
            'exists' => $hasImage,
            'image_url' => $hasImage ? asset($ad->ad_url) : null,
            'title' => $ad->ad_text,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BannerAdd $bannerAdd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BannerAdd $bannerAdd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $ad = BannerAdd::findOrFail($id);

    // Delete image file if it exists
    if ($ad->ad_url && file_exists(public_path($ad->ad_url))) {
        unlink(public_path($ad->ad_url));
    }

    // Delete the record
    $ad->delete();

    return redirect()->route('ads.index')->with('success', 'Advertisement deleted successfully.');
    }
}
