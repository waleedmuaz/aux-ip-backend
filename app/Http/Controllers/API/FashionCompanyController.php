<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\FashionCompanyRequest;
use App\Http\Requests\ImportFileCSVRequest;
use App\Http\Requests\UpdateCompanyDetailRequest;
use App\Imports\FashionCompanyImport;
use App\Models\Company;
use App\Models\FashionCompany;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FashionCompanyController extends Controller
{


    /**
     * Show the profile for a given user.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user=$request->user();
        if($user->roles[0]->id==2){
            $fashion = FashionCompany::with('user')->where('user_id',$user->id)->orderBy('id','desc')->get();
        }else{
            $fashion = FashionCompany::with('user')->orderBy('id','desc')->get();
        }
        return jsonFormat(200,$fashion,'List of Company');
    }
    /**
     * Show the profile for a given user.
     * @return \Illuminate\Http\JsonResponse
     */

    public function imported(Request $request)
    {
        $path1 = $request->file('csv')->store('temp');
        $path=storage_path('app').'/'.$path1;
        Excel::import(new FashionCompanyImport(),$path);
        return jsonFormat(200,[],'successfully uploaded');
    }
    public function update(UpdateCompanyDetailRequest $request){
        FashionCompany::where('id',$request->id)
            ->update([
            $request->col=>$request->text
        ]);
        return jsonFormat(200,[],'successfully uploaded');
    }
    public function ListOfCompanies(){
        $company=  Company::get();
        return jsonFormat(200,$company,'list of companies');
    }
    public function store(CompanyStoreRequest $request){
        Company::create([
            'name'=>$request->name
        ]);
        $company=  Company::get();
        return jsonFormat(200,$company,'company created successfully');
    }
    public function formDataSubmit(FashionCompanyRequest $request){
        $data=[
            "reference"=>$request->reference,
            "ip_type"=>$request->ip_type,
            "application"=>$request->application,
            "application_numbers"=>$request->application_numbers,
            "application_filing_date"=>date('MM d Y', strtotime($request->application_filing_date)),
            "patent_numbers"=>$request->patent_numbers,
            "grant_date"=>date('MM d Y', strtotime($request->grant_date)),
            "country"=>$request->country,
            "due_date"=>date('MM d Y', strtotime($request->due_date)),
            "last_instruction_date"=>date('MM d Y', strtotime($request->last_instruction_date)),
            "action_type"=>$request->action_type,
            "estimated_cost"=>$request->estimated_cost,
            "user_id"=>$request->user_id
        ];
        FashionCompany::create($data);
        $fashion= FashionCompany::get();
        return jsonFormat(200,$fashion,'company created successfully');
    }
}
