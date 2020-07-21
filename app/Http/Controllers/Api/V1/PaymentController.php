<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Rules\Luna;
use App\Rules\ExpiredDate;

class PaymentController extends Controller
{
    public function init(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'sum' => 'required|numeric|between:0.01,9999999',
            'purpose' => 'required|string|max:50'
        ]);

        if ($validation->fails()) {
            return json_encode($validation->errors());
        } else {
            $request->session()->put('sum', $request->get('sum'));
            $request->session()->put('purpose', $request->get('purpose'));
            return session()->getId();
        }
    }

    public function pay(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'card_number' => ['required', new Luna],
            'cvc' => 'required|numeric|min:100|max:999',
            'exp_date' => ['required', new ExpiredDate],
        ]);

        if ($validation->fails()) {
            return json_encode($validation->errors());
        } else {
            return session()->getId();
        }
    }
}
