<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Imports\FashionCompanyImport;
use App\Models\FashionCompany;
use Illuminate\Http\Response;
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
        Excel::import(new FashionCompanyImport(),request()->file('file'));
        return jsonFormat(200,[],'successfully uploaded');
    }


}
