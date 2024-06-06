<?php

namespace App\Http\Controllers\admin;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('type')->paginate(10);
        return view("admin.projects.index", compact("projects"));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view("admin.projects.create", compact("types"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();
        $form_data["slug"] =  Project::generateSlug($form_data["title"]);
        if ($request->hasFile('image_url')) {
            $img_path = Storage::put('my_images', $request->image_url);
            $form_data['image_url'] = $img_path;
        }
        $new_project = new Project();
        $new_project->fill($form_data);
        $new_project->save();
        return redirect()->route("admin.projects.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all(); 
        return view("admin.projects.edit", compact("project", "types"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        $project_modified =  Project::findOrFail($id);
        $form_data = $request->validated();
        if ($request->hasFile('image_url')) {
            if ($project_modified->image_url) {
                Storage::delete($project_modified->image_url);
            }
            $img_path = Storage::put('my_images', $request->image_url);
            $form_data['image_url'] = $img_path;
        }
        if ($project_modified->title != $form_data["title"]) {
            $form_data["slug"] =  Project::generateSlug($form_data["title"]);
        }
        $project_modified->fill($form_data);
        $project_modified->update();
        return redirect()->route("admin.projects.index")->with('message', "Project (id:{$project_modified->id}): {$project_modified->title} modified successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Project $project)
    // {
    //     $project->delete();
    //     return redirect()->route('admin.projects.index')->with('message', $project->title . ' has been successfully deleted');
    // }
}
