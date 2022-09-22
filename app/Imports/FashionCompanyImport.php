<?php

namespace App\Imports;

use App\Models\FashionCompany;
use Maatwebsite\Excel\Concerns\ToModel;

class FashionCompanyImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new FashionCompany([
            "reference"=>$row[0],
            "ip_type"=>$row[1],
            "application"=>$row[2],
            "application_numbers"=>$row[3],
            "application_filing_date"=>$row[4],
            "patent_numbers"=>$row[5],
            "grant_date"=>$row[6],
            "country"=>$row[7],
            "due_date"=>$row[8],
            "last_instruction_date"=>$row[9],
            "action_type"=>$row[10],
            "estimated_cost"=>$row[11],
        ]);
    }
}
