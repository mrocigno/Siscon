<?php
/**
 * Created by PhpStorm.
 * User: Matheus
 * Date: 05/03/2019
 * Time: 10:28
 */

namespace App\Import;
use App\Applicants;
use Maatwebsite\Excel\Concerns\ToModel;

class PlanImport extends ToModel{
    public function model(array $row){
        return new Applicants([
            'name'     => $row[0],
            'email'    => $row[1],
            'telefone' => $row[2],
        ]);
    }
}