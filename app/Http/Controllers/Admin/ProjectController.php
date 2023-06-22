<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Admin\Project;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Project::all();
       return view('Admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('Admin.posts.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        // $request->validate(
        //     [
        //        'title'=> ['required','max:30'] 
        //     ]
        // );
     
        //
   
        $form_data = $request->validated();
        //dd($form_data);
        $form_data = $request->all();
        //dd($form_data);

        //inserimento img
            if( $request ->hasFile('image')){
                //public folder esiste ,post_image,cartella che creo 
                $path = Storage::disk('public')->put('post_images', $request->image);
                $form_data['image'] = $path;
            };



        $new_post = new Project();
        $new_post -> fill($form_data);
         

        $new_post -> save();
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id )
    {
        //
        $post =  Project::findOrFail($id);
        return view('Admin.posts.show',compact('post'));
       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $mod_post =  Project::find($id);
        return view('Admin.posts.edit',compact('mod_post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, $id )
    {
        // $request->validate(
        //     [
        //        'title'=> ['required','max:30'] 
        //     ]
        // );
       // dd($form_data);
        $form_data = $request->validated();

         $form_data = $request->all();
         if( $request ->hasFile('image')){
            
            if( $request->image) {
                Storage::delete($request->image);
                 }
            //public folder esiste ,post_image,cartella che creo 
            $path = Storage::disk('public')->put('post_images', $request->image);
            $form_data['image'] = $path;
        };
         
        $mod_post = Project::find($id);
        $mod_post->update($form_data);
       
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        //
        $mod_post =  Project::find($id);
        if( $mod_post->image) {
            Storage::delete($mod_post->image);
             }

        $mod_post->delete();
        return redirect()->route('admin.posts.index');
    }
}