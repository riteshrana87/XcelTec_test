<?php

use App\Models\Subscription;

function enCodeVal($val){
    if(!empty($val)){
        $res = Hashids::encode($val);
        //$res = Hashids::encodeHex($val);
		return $res;
	}
}

function deCodeVal($val){
	if(!empty($val)){
		$res = Hashids::decode($val);
		//$res = Hashids::decodeHex($val);
		if(!empty($res)){
			return $res[0];
		}
	}
}

/**
     * This method is  used for pass error response.
     * @Created On: 10-04-2022;
     * @Update On : 10-04-2022;
     * @Updated By: Ritesh Rana;
     * @Author: Ritesh Rana
     * @version: 1.0.0
    */

    function errorResponse($errorMsg, $statuscode, $error=null)
    {
        if($error != null) {
            return response()->json([
                'result' => 0,
                'stausCode' => $statuscode,
                'message' => $errorMsg,
                'error' => $error
            ], $statuscode);
        }
        return response()->json([
            'result' => 0,
            'stausCode' => $statuscode,
            'message' => $errorMsg
        ], $statuscode);
    }


    /**
     * This method is  used for pass success response.
     * @Created On: 10-04-2022;
     * @Update On : 10-04-2022;
     * @Updated By: Ritesh Rana;
     * @Author: Ritesh Rana
     * @version: 1.0.0
    */

    function successResponse($message, $statuscode, $data = null)
    {
        return response()->json([
            'result' => 1,
            'stausCode' => $statuscode,
            'message' => $message,
            'data' => $data
        ], $statuscode);
    }


    /**
     * This method is  used for pass success response without data.
     * @Created On: 10-04-2022;
     * @Update On : 10-04-2022;
     * @Updated By: Ritesh Rana;
     * @Author: Ritesh Rana
     * @version: 1.0.0
    */

    function successResponseWithoutData($message,$statuscode)
    {
        return response()->json([
            'result' => 1,
            'stausCode' => $statuscode,
            'message' => $message,
        ], $statuscode);
    }

?>