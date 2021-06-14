<?php

namespace App\Http\Controllers;

use App\Jobs\ResizeImage;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('images.create');
    }

    public function store(Request $request)
    {
        $imageFile = $request->file('file');
        if ($imageFile && $imageFile->getSize()) {
            $newFile = $imageFile->move(public_path('uploads'), $imageFile->getClientOriginalName());
            $formats = [150, 500, 1000, 1200, 1400];
            $this->dispatch(new ResizeImage($newFile->getRealPath(), $formats));
        }

        return redirect('/');
    }

    public function show(Image $image)
    {
        //
    }

    public function edit(Image $image)
    {
        //
    }

    public function update(Request $request, Image $image)
    {
        //
    }

    public function destroy(Image $image)
    {
        //
    }
}
