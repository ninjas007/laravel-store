<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = Category::paginate(10);

        return view('backend.contents.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.contents.categories.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20|unique:categories',
            'sort_list' => 'required|integer|max:8',
            'slug' => 'max:30'
        ]);

        $category = Category::create([
            'uuid' => (string) Str::uuid(),
            'name' => $request->name,
            'sort_list' => $request->sort_list,
            'slug' => ($request->slug == '') ? Str::slug($request->name, '-') : Str::slug($request->slug, '-'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $category->save();

        return redirect('admin/categories')->with('success', 'Berhasil menambah kategori');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['category'] = Category::where('uuid', $id)->first();

        return view('backend.contents.categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'sort_list' => 'required|integer|max:8',
            'slug' => 'max:30'
        ]);

        // check already category name other row
        if (Category::where('name', $request->name)->where('uuid', '!=', $id)->exists()) {
            return redirect('admin/categories')->with('error', 'Failed, Kategori name sudah ada');
        }

        $category = Category::where('uuid', $id)->first();
        $category = Category::findOrFail($category->id);

        $category->name = $request->name;
        $category->sort_list = $request->sort_list;
        $category->slug = ($request->slug == '') ? Str::slug($request->name, '-') : Str::slug($request->slug, '-');
        $category->updated_at = date('Y-m-d H:i:s');

        $category->save();

        return redirect('admin/categories')->with('success', 'Sukses menambah kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $categoryIdArray = $request->input('id');
        $category = Category::whereIn('id', $categoryIdArray);
        
        $category->delete();
        
        return response()->json('Success deleted category', 200);
    }
}
