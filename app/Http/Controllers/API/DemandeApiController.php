<?php

namespace App\Http\Controllers\API;

use App\Demande;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DemandeResource;

class DemandeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demandes = Demande::all();
        return response()->json(DemandeResource::collection($demandes), 200);

    }

    public function store(Request $request){
        
        $created=Demande::create($request->all());
        
    }
}
