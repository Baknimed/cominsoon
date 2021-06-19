<?php

namespace App\Models;


use App\Commons\APICode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class TReview extends Model
{
    protected $table = 't_reviews';

    protected $fillable = [
        'user_id', 'transport_id', 'score', 'comment', 'status'
    ];

    protected $hidden = [];

    protected $casts = [
        'user_id' => 'integer',
        'transport_id' => 'integer',
        'score' => 'float',
        'status' => 'integer',
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function transport()
    {
        return $this->hasOne(Transport::class, 'id', 'transport_id');
    }

    public function validateCreate($data)
    {
        $validateData = $data->all();
        $resp = (object)[
            'code' => APICode::WRONG_PARAMS,
            'message' => ''
        ];
        $rules = [
            'transport_id' => 'required',
            'score' => 'required',
            'comment' => 'required',
        ];
        $message_errors = [];
        $validator = Validator::make($validateData, $rules, $message_errors);
        if ($validator->fails()) {
            $resp->message = $validator->messages();
        } else {
            $resp->code = APICode::SUCCESS;
        }
        return $resp;
    }
}
