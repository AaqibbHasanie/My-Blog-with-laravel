<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request; 
use Illuminate\Validation\Rule;
use App\Http\Requests\StorecategoriesRequest;
use App\Http\Requests\UpdatecategoriesRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     
    public function index()      // displays all posts
    {
          $categories = Category::all();
        return view('viewcategory', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', Rule::unique('categories', 'name')]
        ]);
        $incomingFields['name'] = strip_tags($incomingFields['name']);
        Category::create($incomingFields);
        return redirect('/viewcategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecategoriesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
public function show()
{
    $categories = Category::all();
    return view('home', compact('categories'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required'
    ]);

    $category = Category::findOrFail($id);
    $category->name = $request->name;
    $category->save();

    return redirect('/viewcategory');
}


    /**
     * Remove the specified resource from storage.
     */
  public function destroy($id)
{
    try {
        $category = Category::find($id);

        // Check if the category is associated with any posts
        if ($category->posts()->count() > 0) {
            // Display a message and redirect back with a status
            return redirect('/viewcategory')->with('error', 'Category cannot be deleted because it is associated with posts.');
        }

        $category->delete();
        return redirect('/viewcategory')->with('success', 'Category deleted successfully.');
    } catch (\Exception $e) {
        // Handle other unexpected exceptions if any
        return redirect('/viewcategory')->with('error', 'An error occurred while deleting the category.');
    }
}

   
}
