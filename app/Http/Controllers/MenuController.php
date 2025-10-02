<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $menus = Menu::with('page')->paginate(5);
            $pages = Page::all();
            return view('menus.index', compact('menus', 'pages'));
        } catch (\Exception $e) {
            Log::error('Menu index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load menus');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $pages = Page::all();
            return view('menus.create', compact('pages'));
        } catch (\Exception $e) {
            Log::error('Menu create error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load create form');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ FIXED: Matching the form field names
        $validated = $request->validate([
            'page_id'    => 'nullable|exists:pages,id',
            'menu_title' => 'required|string|max:255',
            'menu_en'    => 'required|string',
            'menu_fr'    => 'required|string',
            'menu_ar'    => 'required|string',
        ]);

        try {
            // ✅ Save using same names
            Menu::create([
                'page_id'    => $request->page_id,
                'menu_title' => $request->menu_title,
                'menu_en'    => $request->menu_en,
                'menu_fr'    => $request->menu_fr,
                'menu_ar'    => $request->menu_ar,
            ]);

            return redirect()->route('menus.index')->with('success', 'Menu created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Menu creation failed: ' . $e->getMessage(), [
                'request_data' => $request->all(),
            ]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create menu. Please try again.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $pages = Page::all();
            $menu = Menu::find($id);
            return view('menus.edit', compact('menu', 'pages'));
        } catch (\Exception $e) {
            Log::error('Menu edit error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load edit form');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'page_id' => 'nullable|exists:pages,id',
            'menu_title' => 'required|string|max:255',
            'menu_en' => 'required|string|max:255',
            'menu_fr' => 'required|string|max:255',
            'menu_ar' => 'required|string|max:255',
        ]);

        try {

            $menu = Menu::findorFail($id);

            $menu->page_id    = $request->page_id;   // update the page id
            $menu->menu_title = $request->menu_title;
            $menu->menu_en = $request->menu_en;
            $menu->menu_fr = $request->menu_fr;
            $menu->menu_ar = $request->menu_ar;
            $menu->save();


            return redirect()->route('menus.index')->with('success', 'Menu updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Menu update failed: ' . $e->getMessage(), [
                'menu_id' => $menu->id,
                'request_data' => $request->all(),
                'validation_errors' => $request->validator->errors() ?? 'No validation errors'
            ]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update menu. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Menu::destroy($id);
        return redirect()->route('menus.index')->with('delete_success', 'Menu deleted successfully.');
    }
}
