<?php

namespace App\Http\Controllers;

use App\Models\ArticleImage;
use Illuminate\Http\Request;

class ArticleImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articleImages = ArticleImage::orderBy('created_at', 'desc')->paginate(5);
        return view('articles_Images.index', compact('articleImages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles_Images.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:6048',
        ]);
        try {
            if ($request->hasFile('image')) {
                $article_image = $request->file('image');
                $article_image_OriginalName = time() . '_' . $article_image->getClientOriginalName();
                $article_image->move(public_path('articlesimages/article_image'), $article_image_OriginalName);

                $article_image_path = 'articlesimages/article_image/' .  $article_image_OriginalName;
            }

            // ab main store karo ga data ko database main 

            ArticleImage::create([
                'Image_path' => $article_image_path,
            ]);
            return redirect()->route('articleimage.index')->with('success', 'Article Image created successfully!');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleImage $articleImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $article_image = ArticleImage::findorFail($id);

        return view('articles_Images.edit', compact('article_image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            // 1. First,
            $ArticleImage = ArticleImage::findorFail($id);

            //2  // Fallback to current image path

            $article_image_path =  $ArticleImage->Image_path;

            // 3. Handle new file upload   or If user uploads a new image

            if ($request->hasFile('image')) {

                if ($ArticleImage->image && file_exists(public_path($ArticleImage->image))) {
                    unlink(public_path($ArticleImage->image));
                }

                $article_image = $request->file('image');
                $article_image_OriginalName = time() . '_' . $article_image->getClientOriginalName();
                $article_image->move(public_path('articlesimages/article_image'), $article_image_OriginalName);
                $article_image_path = 'articlesimages/article_image/' .  $article_image_OriginalName;
            }

            // ab main update karo ga data ko database main 

            $ArticleImage->Image_path = $article_image_path;

            $ArticleImage->save();

            return redirect()->route('articleimage.index')->with('success', 'Article Image created successfully!');
        } catch (\Throwable $th) {

            return back()->with('error', 'Something went wrong while updating the article.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $articleImage = ArticleImage::find($id);

        //Delete the image file from disk if it exists
        if ($articleImage->Image_path && file_exists(public_path($articleImage->Image_path))) 
        {
            unlink(public_path($articleImage->Image_path));
        }

        // // Now delete the database record
        $articleImage->delete();
        return redirect()->route('articleimage.index')->with('success', 'Article Image deleted successfully!');
    }
}
