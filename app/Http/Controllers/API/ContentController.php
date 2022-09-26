<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Imports\FashionCompanyImport;
use App\Models\Content;
use App\Models\FashionCompany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class ContentController extends Controller
{


    /**
     * Show the profile for a given user.
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $content = Content::with('context');
        if((isset($request->page) && $request->page)){
            $content->where('page',$request->page);
        }
        $content= $content->first();
        return jsonFormat(200,$content,'Content');
    }

}
