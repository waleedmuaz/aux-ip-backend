<?php



if(! function_exists('jsonFormat')){
    function jsonFormat($status,$data=array(),$message=""){
        if($data && $message){
            if($status==false){
                return response()->json([
                    'status'    =>  $status,
                    'messages'  =>  $message,
                    'errors'  =>  $data
                ]);
            }
            return response()->json([
                'status'    =>  $status,
                'messages'  =>  $message,
                'data'  =>  $data
            ]);
        }
        elseif($message){
            if($status==false){
                return response()->json([
                    'status'    =>  $status,
                    'messages'  =>  $message,
                ]);
            }
            return response()->json([
                'status'    =>  $status,
                'messages'  =>  $message,
            ]);
        }elseif($data){
            if($status==false){
                return response()->json([
                    'status'    =>  $status,
                    'errors'  =>  $data
                ]);
            }
            return response()->json([
                'status'    =>  $status,
                'data'  =>  $data
            ]);
        }
    }
}
