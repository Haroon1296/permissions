<?php

namespace App;
use App\Operation;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Privilege extends Model
{
    protected $fillable = ['user_id','operation_id','is_add','is_edit','is_view','is_delete','status'];

    Static function checkPermission($crud, $slug)
    {
        $user_operation = Operation::where('operations.operation_slug', $slug)
        ->join('privileges', function($join){
            $user_id = Auth::id(); // user id
            $join->on('privileges.operation_id', 'operations.id');
            $join->where('privileges.user_id', '=', $user_id);
        })
        ->first();
        
        $ret = false;
        $v = '';

        if($user_operation){
            //    
            if($crud == "ADD"){
                $v = $user_operation->is_add;   
            }
            elseif($crud == "EDIT"){
                $v = $user_operation->is_edit;   
            }
            elseif($crud == "VIEW"){  
                $v = $user_operation->is_view; 
            }
            elseif($crud == "DEL"){
                $v = $user_operation->is_delete;   
            }
            else{
                $v = 0;   
            }
    
            if($v == 1){
                $ret = true;
            }else{
                $ret = false;
            }

            return $ret;
        }else{
            return $ret;
        }

	}

}
