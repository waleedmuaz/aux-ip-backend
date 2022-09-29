<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetContextRequest;
use App\Http\Requests\UpdateContextRequest;
use App\Imports\FashionCompanyImport;
use App\Models\Content;
use App\Models\Context;
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
        $data=[];
        if(isset($content->context)  && count($content->context)>0){
            foreach ($content->context as $key=>$context){
                $data[$context->name][$context->type][$context->key][]=$context;
            }
        }

        return jsonFormat(200,$data,'Content');
    }
    public function updateContext(UpdateContextRequest $request){
        Context::where('id',$request->id)->update([
            'content_detail'=>$request->content_detail
        ]);
        return jsonFormat(200,[],'Content updated');

    }
    public function getContextById(GetContextRequest $request){
        $context = Context::find($request->id);
        return jsonFormat(200,$context,'Context');
    }

}
