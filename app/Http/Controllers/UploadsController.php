<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Upload;
use Illuminate\Support\Facades\Storage;

class UploadsController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $uploads = Upload::where('public', true)->get();
        return view('uploads.index')->with('uploads', $uploads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('uploads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|max:1999|required'
        ]);
        
        // handling image upload
        $fileNameWithExtension = $request->file('image')->getClientOriginalName();
        // without extension
        $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
        // just extension
        $extension = $request->file('image')->getClientOriginalExtension();

        $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
        $path = $request->file('image')->storeAs('public/images', $fileNameToStore);


        $upload = new Upload;
        $upload->title = $request->input('title');
        $upload->description = $request->input('description');
        // if user is logged in, all fields are stored and accessible like this
        $upload->id_user = auth()->user()->id;
        $upload->public = ($request->input('public')) ? true : false;
        $upload->image = $fileNameToStore;

        $upload->save();

        return redirect('/uploads')->with('success', 'Image posted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $upload = Upload::find($id);
        return view('uploads.show')->with('upload', $upload);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $upload = Upload::find($id);

        // check for correct user
        if (auth()->user()->id !== $upload->id_user) {
            return redirect('/uploads')->with('error', 'Unauthorized Page');
        }
        return view('uploads.edit')->with('upload', $upload);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|max:1999'
        ]);
        $upload = Upload::find($id);
        $upload->title = $request->input('title');
        $upload->description = $request->input('description');
        $upload->public = ($request->input('public')) ? true : false;
        
        if ($request->hasFile('image')) {
            // handling image upload
            $fileNameWithExtension = $request->file('image')->getClientOriginalName();
            // without extension
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            // just extension
            $extension = $request->file('image')->getClientOriginalExtension();

            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);

            $upload->image = $fileNameToStore;
        }


        $upload->save();
        return redirect('/uploads')->with('success', 'Image info updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
        $upload = Upload::find($id);

        if (auth()->user()->id !== $upload->id_user) {
            return redirect('/uploads')->with('error', 'Unauthorized Page');
        }
        
        Storage::delete('public/images/' . $upload->image);
        $upload->delete();
        return redirect('/uploads')->with('success', 'Image deleted!');
    }
}
