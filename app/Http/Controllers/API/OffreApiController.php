<?php

namespace App\Http\Controllers\API;

use App\Offre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OffreResource;

class OffreApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offres = Offre::all();
        return response()->json(OffreResource::collection($offres), 200);

    }

    public function store(Request $request){
        
        $created=Offre::create($request->all());
        
    }
}
