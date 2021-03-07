<?php

namespace App\Http\Controllers;

use App\Models\InterestTypes;
use App\Models\Service;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookServiceEmail;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendEmail($data)
    {
        $details = [
            "title" => "Thank you for chooing ITbeeb",
            "body" => $data,
        ];
        Mail::to($data["email"])->send(new BookServiceEmail($details));
        return "email sent";
        // return response()->json($data);
        // $details = [
        //     "title" => "Thank you for chooing ITbeeb",
        //     "body"  => "Hello my name is ahmad"
        // ];
        // Mail::to("speks080@gmail.com")->send(new BookServiceEmail($details));
        // return "email sent";
    }
}
