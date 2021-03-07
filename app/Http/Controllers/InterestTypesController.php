<?php

namespace App\Http\Controllers;

use App\Models\InterestTypes;
use Illuminate\Http\Request;

class InterestTypesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InterestTypes  $interestTypes
     * @return \Illuminate\Http\Response
     */
    public function show(InterestTypes $interestTypes)
    {
        $interestTypes = InterestTypes::all();
        // return $interestTypes;
        return response()->json($interestTypes, 200);
    }
}
