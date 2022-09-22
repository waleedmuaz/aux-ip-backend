<?php

namespace App\Exports;

use App\Models\FashionCompany;
use Maatwebsite\Excel\Concerns\FromCollection;

class FashionCompanyExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FashionCompany::all();
    }
}
