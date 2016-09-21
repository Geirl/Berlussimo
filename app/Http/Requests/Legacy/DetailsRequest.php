<?php

namespace App\Http\Requests\Legacy;


use App\Http\Requests\Request;
use Auth;

class DetailsRequest extends Request
{
    public function authorize() {
        return check_user_mod(Auth::user()->id, 'details');
    }

    public function rules() {
        return [];
    }
}