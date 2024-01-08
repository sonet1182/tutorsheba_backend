<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdsImg;
use Illuminate\Http\Request;

class AdsImagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $ads_images = AdsImg::all();
        return view('admin.layout.adminUser.ads_images.index',compact('ads_images'));
    }

    public function create(){
        return view('admin.layout.adminUser.ads_images.create');
    }

    public function store(Request $request){
        if ($request->file('img')){
            $image = $request->file('img');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $path = 'storage/ads/';
            $image->move($path,$imageName);
            $imageUrl = $path . $imageName;
            AdsImg::create([
                'img' => $imageUrl,
                'activity' => empty($request->activity)? '0': '1',
                'position' => $request->position,
                'link' => $request->link,
            ]);
        }
        return redirect('admin/ads-images')->with('message','successfully submit');
    }

    public function show(){

    }

    public function edit($id){
        $ads_images = AdsImg::find($id);
        return view('admin.layout.adminUser.ads_images.edit',compact('ads_images'));
    }

    public function update($id, Request $request){
        $ads_images = AdsImg::find($id);
        if ($request->file('img')){
            $image_path = $ads_images->img;
            unlink($image_path);

            $image = $request->file('img');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $path = 'storage/ads/';
            $image->move($path,$imageName);
            $imageUrl = $path . $imageName;
            $ads_images->update([
                'img' => $imageUrl,
            ]);
        }
        $ads_images->update([
                'activity' => empty($request->activity)? '0': '1',
                'position' => $request->position,
                'link' => $request->link,
        ]);

        return redirect('admin/ads-images')->with('message','Update successfully');
    }

    public function destroy($id){
        $ads_images = AdsImg::find($id);
        $image_path = $ads_images->img;
        if (file_exists($image_path)) {
            //File::delete($image_path);
            unlink($image_path);
        }
        $ads_images->delete();

        return redirect('admin/ads-images')->with('warning','Ads image successfully deleted!');
    }
}
