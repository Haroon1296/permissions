<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $fillable = ['module_id','operation_name','operation_slug','is_view_visible','is_add_visible','is_edit_visible','is_delete_visible','status'];
}
