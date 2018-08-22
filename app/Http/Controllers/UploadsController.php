<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Upload;

class UploadsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $uploads = Upload::all();
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
            'description' => 'required'
        ]);
        $upload = new Upload;
        $upload->title = $request->input('title');
        $upload->description = $request->input('description');
        // if user is logged in, all fields are stored and accessible like this
        $upload->id_user = auth()->user()->id;
        $upload->public = ($request->input('public')) ? true : false;

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
            'description' => 'required'
        ]);
        $upload = Upload::find($id);
        $upload->title = $request->input('title');
        $upload->description = $request->input('description');
        $upload->public = ($request->input('public')) ? true : false;

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
        $upload->delete();
        return redirect('/uploads')->with('success', 'Image deleted!');
    }
}
