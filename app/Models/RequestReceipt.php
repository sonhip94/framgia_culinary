<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class RequestReceipt extends Model
{
    protected $fillable = ['name','ration','description','avatar','user_id','image','status'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
