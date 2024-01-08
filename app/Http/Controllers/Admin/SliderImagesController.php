<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdsImg;
use App\Models\SliderImg;
use Illuminate\Http\Request;

class SliderImagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $sliders = SliderImg::all();
        return view('admin.layout.adminUser.slider_images.index',compact('sliders'));
    }

    public function create(){
        return view('admin.layout.adminUser.slider_images.create');
    }

    public function store(Request $request){
        if ($request->file('img')){
            $image = $request->file('img');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $path = 'storage/slider/';
            $image->move($path,$imageName);
            $imageUrl = $path . $imageName;
            SliderImg::create([
                'img' => $imageUrl,
                'activity' => empty($request->activity)? '0': '1',
                'title' => $request->title,
            ]);
        }
        return redirect('admin/slider')->with('message','successfully submit');
    }

    public function show(){

    }

    public function edit($id){
        $sliders = SliderImg::find($id);
        return view('admin.layout.adminUser.slider_images.edit',compact('sliders'));
    }

    public function update($id, Request $request){
        $sliders = SliderImg::find($id);
        if ($request->file('img')){
            $image_path = $sliders->img;
            unlink($image_path);

            $image = $request->file('img');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $path = 'storage/slider/';
            $image->move($path,$imageName);
            $imageUrl = $path . $imageName;
            $sliders->update([
                'img' => $imageUrl,
            ]);
        }
        $sliders->update([
                'activity' => empty($request->activity)? '0': '1',
                'title' => $request->title,
        ]);

        return redirect('admin/slider')->with('message','Update successfully');
    }

    public function destroy($id){
        $sliders = SliderImg::find($id);
        $image_path = $sliders->img;
        if (file_exists($image_path)) {
            //File::delete($image_path);
            unlink($image_path);
        }
        $sliders->delete();

        return redirect('admin/slider')->with('warning','Slider image successfully deleted!');
    }



    public function adsImages(){
        $ads = AdsImg::all();
        return view('admin.layout.adminUser.ads_images',compact('ads'));
    }
    public function adsImagesStore(Request $request){
        if ($request->file('img')){
            $image = $request->file('img');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $path = 'storage/slider/';
            $image->move($path,$imageName);
            $imageUrl = $path . $imageName;
            AdsImg::create([
                'img' => $imageUrl,
                'position' => $request->position,
            ]);
        }
        return back()->with('message','successfully submit');
    }
}
