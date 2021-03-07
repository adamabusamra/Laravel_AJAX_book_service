<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\InterestTypes;
use App\Http\Controllers\EmailController;

class UsersController extends Controller
{
    public function create(Request $request)
    {
        $services = [];
        $interest = '';
        $interest = InterestTypes::findOrFail($request->interestLevelId)->interest_type;
        foreach ($request->serviceId as $value) {
            if ($request->serviceId) {
                $single = Service::findOrFail($value);
                array_push($services, $single->service);
            }
        }
        $newData = [
            "name" => $request->name,
            "mobile" => $request->number,
            "email" => $request->email,
            "services" => $services,
            "interest" => $interest
        ];

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->number,
            'services' => implode(',', $services),
            'interest_type_id' => $request->interestLevelId,
        ]);
        $emailController = new EmailController;
        $emailController->sendEmail($newData);

        return response()->json($user, 201);
    }
}
