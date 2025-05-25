<?php
namespace App\Traits ; 

trait GeneralTrait
{
    public function buildResponse($data=null,$type=null,$message=null,$status=null){
        $response = [
            'data'=>$data,
            'type'=>$type,
            'message'=>$message,
            'status'=>$status
        ];

        return response($response, $status);
    }
}
    



