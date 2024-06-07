<?php

namespace App\Http\Controllers\admin;

use App\Models\Type;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTypeRequest;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $form_data = $request->validated();
        $form_data["slug"] =  Type::generateSlug($form_data["name"]);
        
        $new_type = new Type();
        $new_type->fill($form_data);
        $new_type->save();
        return redirect()->route("admin.types.index")->with('message', $new_type->name . ' has been successfully created');;
        // $new_type->slug
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        $categoryName = $type->name;
        return view('admin.types.show', compact('type', 'categoryName'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('message', $type->name . ' has been successfully deleted');
    }
    public function getCategoryName($type_id)
    {
        $category = Type::find($type_id);
        if ($category) {
            return response()->json(['name' => $category->name]);
        } else {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }
}
