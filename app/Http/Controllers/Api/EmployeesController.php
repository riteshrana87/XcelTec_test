<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeMaster;
use App\Http\Resources\EmployeesResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeesController extends Controller
{
    /*
        @Author : Ritesh Rana
        @Desc   : Display a listing of the resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 04/10/2022
    */
    
    public function index()
    {
        try {
            $empdata = EmployeeMaster::with('salary','department')->where('status','active')->get();
            $empdatalist = EmployeesResource::collection($empdata);

            $data = array(
                'emp_data' => $empdatalist,
            );
            Log::info('create Employee list');
            return successResponse('create Employee list successfully', 200, $data);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Unable to like Post due to err: ' . $e->getMessage());
            return errorResponse('Something went wrong on processing Payment',500);
        }
    }
}
