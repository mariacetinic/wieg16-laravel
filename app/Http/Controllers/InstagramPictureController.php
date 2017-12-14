<?php

namespace App\Http\Controllers;

use App\InstagramPicture;
use Illuminate\Http\Request;

class InstagramPictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('instagram/show', ['url' => InstagramPicture::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InstagramPicture  $instagramPicture
     * @return \Illuminate\Http\Response
     */
    public function show(InstagramPicture $instagramPicture)
    {
        $images = InstagramPicture::all();
        return view('instagram.show', ['images' => $images]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InstagramPicture  $instagramPicture
     * @return \Illuminate\Http\Response
     */
    public function edit(InstagramPicture $instagramPicture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InstagramPicture  $instagramPicture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InstagramPicture $instagramPicture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InstagramPicture  $instagramPicture
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstagramPicture $instagramPicture)
    {
        //
    }
}
