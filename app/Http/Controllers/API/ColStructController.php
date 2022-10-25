<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StructColRequest;
use App\Http\Requests\UpdateStructureRequest;
use App\Models\ColStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColStructController extends Controller
{
    public function createCol(StructColRequest $request){
        ColStructure::create([
            'field'=>$request->column,
            'status'=>1
        ]);
        DB::select("ALTER TABLE fashion_companies ADD $request->column varchar(255)");
        return jsonFormat(200, [], 'created successfully');
    }
    public function index(){
        $col= ColStructure::get();
        return jsonFormat(200, $col, 'Column Status');
    }
    public function updateToggle(UpdateStructureRequest $request){
        $col = ColStructure::find($request->id);
        $col->update([
            'hidden'=>($col->hidden===1)?0:1
        ]);
        return jsonFormat(200, [], 'Column updated successfully');
    }
}
