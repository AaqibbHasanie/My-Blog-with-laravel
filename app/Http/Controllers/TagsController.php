<?php

namespace App\Http\Controllers;

use App\Models\tags;
use Illuminate\Http\Request; 
use Illuminate\Validation\Rule;
use App\Http\Requests\StoretagsRequest;
use App\Http\Requests\UpdatetagsRequest;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
               $tags = tags::all();
        return view('viewtags', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
              $incomingFields = $request->validate([
            'name' => ['required', Rule::unique('tags', 'name')]
        ]);
        $incomingFields['name'] = strip_tags($incomingFields['name']);
        tags::create($incomingFields);
        return redirect('viewtag');     // redirect function takes a route
     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretagsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tags $tags)
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

    $category = tags::findOrFail($id);
    $category->name = $request->name;
    $category->save();

    return redirect('/viewtag');
}


    /**
     * Remove the specified resource from storage.
     */
  public function destroy($id)
{
    try {
        $tag = Tags::find($id);

        // Check if the tag is associated with any posts
        if ($tag->posts()->count() > 0) {
            // Display a message and redirect back with a status
            return redirect('/viewtag')->with('error', 'Tag cannot be deleted because it is associated with posts.');
        }

        $tag->delete();
        return redirect('/viewtag')->with('success', 'Tag deleted successfully.');
    } catch (\Exception $e) {
        // Handle other unexpected exceptions if any
        return redirect('/viewtag')->with('error', 'An error occurred while deleting the tag.');
    }
}

}
