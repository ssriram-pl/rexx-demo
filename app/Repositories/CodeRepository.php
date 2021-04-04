<?php

namespace App\Repositories;

use App\GeneratedCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CodeRepository
{

    /**
     * @param $request
     * @return mixed
     * generateCode function creates an array containing random code based on input request
     * Inserting bulk records to the table using eloquent model
     */
    public function generateCode($request)
    {
        $noOfCode = $request->no_of_code;
        $prefixCode = 'ABCD';
        $data = [];
        if (!empty($noOfCode)) {
            for($i=0;$i<$noOfCode;$i++) {
                $data[$i]['random_code'] = $prefixCode.mt_rand(100000, 999999);
                $data[$i]['created_by'] = Auth::user()->id;
                $data[$i]['created_at'] = $data[$i]['updated_at'] = Carbon::now();
            }
        }
        return GeneratedCode::insert($data);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * getCode function returns random code with user relation ship by eloquent pagination
     */
    public function getCode()
    {
        return GeneratedCode::with('user')->paginate(50);
    }

}
