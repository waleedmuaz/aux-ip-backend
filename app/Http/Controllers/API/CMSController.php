<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMSImagesRquest;
use App\Models\CMS;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CMSController extends Controller
{


    /**
     * Show the profile for a given user.
     * @return JsonResponse
     */
    public function index()
    {
        $cms = CMS::get();
        return jsonFormat(200,$cms,'cms List');
    }
    public function store(CMSImagesRquest $request){
        if($request->has('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('CMS'), $imageName);
            CMS::create([
                'name'=>$request->name,
                'image'=>url('CMS/'.$imageName),
            ]);
            $cms = CMS::get();
            return jsonFormat(200,$cms,'uploaded successfully');
        }
        return jsonFormat(200,'','not found');
    }

}
