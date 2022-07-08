<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    const VALIDATION_RULES = [
        'title' => 'bail|required|string|max:255',
        'description' => 'required|string|max:255',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withCount('projects')
            ->whereUserId(Auth::id())
            ->latest('updated_at')
            ->paginate();

        return view('category.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Auth::user()
            ->categories()
            ->create($request->validate(self::VALIDATION_RULES));

        return redirect()->route('categories.show', $category->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->validate(self::VALIDATION_RULES));

        return redirect()->route('categories.show', $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->noContent();
    }
}
