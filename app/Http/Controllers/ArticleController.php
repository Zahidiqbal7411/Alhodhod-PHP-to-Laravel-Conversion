<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

use App\Models\Article;
use App\Models\Menu;
use Illuminate\Http\Request;
use PhpParser\Node\Arg;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('menu')->paginate(5);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //uay optinal realtionship ki value ko dehkanay k leuy ahina 
        $menus = Menu::all();
        return view('articles.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        $request->validate([
            'language' => 'required|string|in:en,fr,ar',
            'article_title' => 'required|string|max:255',
            'metatag' => 'nullable|string|max:255',
            'article_slug' => 'nullable|string|max:255|unique:articles,article_slug',
            'article_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'content' => 'required|string',
            'menu_id' => 'required|nullable|exists:menus,id',
        ]);


        try {
            //article ka titile ko slug banyahian 
            $article_title = $request->article_title;
            $article_slug = Str::slug($article_title, "-");

            // ab main apni image ko upload karo ga
            $article_image = null;
            if ($request->hasFile('article_image')) {
                $article_image = $request->file('article_image');
                $article_image_OriginalName = time() . '_' . $article_image->getClientOriginalName();
                $article_image->move(public_path('uploadimage/article_image'), $article_image_OriginalName);

                $article_image_path = 'uploadimage/article_image/' .  $article_image_OriginalName;
            }


            // ab main store karo ga data ko database main 
            Article::create([
                'lang' => $request->language,
                'article_title' => $request->article_title,
                'metatag' => $request->metatag,
                'article_slug' =>  $article_slug,
                'article_image' => $article_image_path,
                'content' => $request->content,
                'show_on_home_page' => $request->has('show_on_home_page') ? 1 : 0,
                'menu_id' => $request->menu_id,
            ]);
            return redirect()->route('articles.index')->with('success', 'Article created successfully!');
        } catch (\Throwable $th) {
            // Redirect back with error message
            return back()->with('error', 'Something went wrong while creating the article.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $article = Article::with('menu')->findOrFail($id);
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $article = Article::findorFail($id);
        $menus = Menu::all();
        return view('articles.edit', compact('article', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'language' => 'required|string|in:en,fr,ar',
            'article_title' => 'required|string|max:255',
            'metatag' => 'nullable|string|max:255',
            'article_slug' => 'nullable|string|max:255|unique:articles,article_slug',
            'article_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'content' => 'required|string',
            'menu_id' => 'nullable|exists:menus,id',
        ]);

        try {
            $article = Article::findorFail($id);

            //update slug ko update karain guy

            $article_title = $request->article_title;
            $article_slug = Str::slug($article_title, "-");



            //update image 
            $article_image_path = $article->article_image;

            if ($request->hasFile('article_image')) {

                // agar db main pahly say image hian to wo delete hn jain gi

                if ($article->article_image && file_exists(public_path($article->article_image))) {
                    unlink(public_path($article->article_image));
                }
                
                $article_image = $request->file('article_image');
                $article_image_OriginalName = time() . '_' . $article_image->getClientOriginalName();
                $article_image->move(public_path('uploadimage/article_image'), $article_image_OriginalName);

                $article_image_path = 'uploadimage/article_image/' .  $article_image_OriginalName;
            }



            $article->lang = $request->language;
            $article->article_title = $request->article_title;
            $article->metatag = $request->metatag;
            $article->article_slug  = $article_slug;
            $article->article_image = $article_image_path;
            $article->content = $request->content;
            $article->show_on_home_page = $request->has('show_on_home_page') ? 1 : 0;
            $article->menu_id = $request->menu_id;
            $article->save();

            return redirect()->route('articles.index')->with('success', 'Article updated successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Something went wrong while updating the article.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    try {
        $article = Article::findOrFail($id);

        // Delete the image from public folder if exists
        if ($article->article_image && file_exists(public_path($article->article_image))) {
            unlink(public_path($article->article_image));
        }

        // Delete article from database
        $article->delete();

        return redirect()->route('articles.index')->with('delete_success', 'Article and its image deleted successfully.');
    } catch (\Throwable $th) {
        return redirect()->route('articles.index')->with('error', 'Failed to delete article.');
    }
}

}
