<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Imports\FashionCompanyImport;
use App\Models\FashionCompany;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FashionCompanyController extends Controller
{


    /**
     * Show the profile for a given user.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $fashion = FashionCompany::orderBy('id','desc')->paginate(15);
        return jsonFormat(200,$fashion,'List of Company');
    }
    /**
     * Show the profile for a given user.
     * @return \Illuminate\Http\JsonResponse
     */

    public function imported()
    {
        $path1 = request()->file('file')->store('temp');
        $path=storage_path('app').'/'.$path1;
        Excel::import(new FashionCompanyImport(),$path);
        return jsonFormat(200,[],'successfully uploaded');
    }


}
