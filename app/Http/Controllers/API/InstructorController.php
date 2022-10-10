<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportFileCSVRequest;
use App\Http\Requests\InstructionListByUserRequest;
use App\Http\Requests\UpdateCompanyDetailRequest;
use App\Imports\FashionCompanyImport;
use App\Models\Company;
use App\Models\FashionCompany;
use App\Models\InstructorLogs;
use App\Models\InstructorUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class InstructorController extends Controller
{
    public function store(Request $request){
        foreach ($request->data as $re){
            $data=[
                'user_id'=>$request->user()->id,
                'fashion_company_id'=>$re['id'],
                'instruction_applied_date'=>Carbon::now(),
                'instruction_array'=>json_encode($re),
            ];
            $find = InstructorUser::where('fashion_company_id',$re['id'])->first();
            Log::info($find);
            if($find){
                $find->update($data);
            }else{
                InstructorUser::create($data);
            }
            InstructorLogs::create($data);
        }
        return jsonFormat(200,'','successfully store');
    }
    public function getInstruction(){
        $user= DB::table('instructors_user_pivot')->distinct('user_id')->pluck('user_id');
        $data = User::with('companies.company')->whereIn('id',$user)->get();
        return jsonFormat(200,$data,'successfully store');
    }

    public function getInstructionList(Request $request){
            $array = [];
            if($request->user_id != null){
                $data['user'] = User::with('companies.company')->where('id',$request->user_id)->first();
                $insts=InstructorUser::with('user','instruction')->where('user_id',$request->user_id)->get();
                foreach ($insts as $inst){
                    $json = json_decode($inst->instruction_array);
                    $json->status=$inst->status;
                    $json->inst_id=$inst->id;
                    $json->user_name=isset($inst->user->name)? $inst->user->name: "";
                    $json->user_email=isset($inst->user->email)?$inst->user->email: "" ;
                    $array[]=$json;
                }
                $data['instruction_list']=$array;
                $data['logs']= InstructorLogs::with('user.companies.company','instruction')->where('user_id',$request->user_id)->get();
            }else{
                $data['user'] = "";
                $insts=InstructorUser::with('user','instruction')->get();
                foreach ($insts as $inst){
                    $json = json_decode($inst->instruction_array);
                    $json->status=$inst->status;
                    $json->inst_id=$inst->id;
                    $json->user_name=isset($inst->user->name)? $inst->user->name: "";
                    $json->user_email=isset($inst->user->email)?$inst->user->email: "" ;
                    $array[]=$json;
                }
                $data['instruction_list']=$array;
                $data['logs']= InstructorLogs::with('user.companies.company','instruction')->get();
            }
        return jsonFormat(200,$data,'list');
    }
    public function statusUpdate(Request $request){
        $inst=InstructorUser::find($request->id);
        $inst->update([
            'status'=>$request->status
        ]);

        FashionCompany::where('id',$inst->fashion_company_id)->update([
            'instruction'=>json_decode($inst->instruction_array)->instruction
        ]);
        $data=[
            'user_id'=>$inst->user_id,
            'fashion_company_id'=>$inst->fashion_company_id,
            'instruction_applied_date'=>Carbon::now(),
            'instruction_array'=>$inst->instruction_array,
            'status'=>$request->status
        ];
        InstructorLogs::create($data);
        return jsonFormat(200,$data,'update instruction');

    }
    public function getInstructionLogList(Request $request){
        $array = [];
        $insts=InstructorLogs::with('user','instruction')->get();
        foreach ($insts as $inst){
            $json = json_decode($inst->instruction_array);
            $json->status=$inst->status;
            $json->inst_id=$inst->id;
            $json->user_name=isset($inst->user->name)? $inst->user->name: "";
            $json->user_email=isset($inst->user->email)?$inst->user->email: "" ;

            $array[]=$json;
        }
        $data['instruction_list']=$array;
        $data['logs']= InstructorLogs::with('user.companies.company','instruction')->get();
        return jsonFormat(200,$data,'logs list');
    }


}
