<?php

namespace App\Models;

use App\Commons\APICode;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Subscriber extends Authenticatable
{
    use Notifiable;

    protected $table = 'subscribers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */





    public function create($data)
    {
        $this->email = $data->email;
        $this->save();
        return $this;
    }
}
