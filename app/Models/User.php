<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user_profile;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Model implements Authenticatable
{
    use HasFactory, AuthenticableTrait;
    
    protected $primaryKey = 'user_id';

    protected $guarded = [''];

    public function user_profile(){
        return $this->hasOne(user_profile::class, 'user_id', 'user_id');
    }
}
