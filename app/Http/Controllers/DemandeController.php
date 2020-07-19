<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Demande;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DemandeController extends Controller
{

    public function user_demandes()
    {
        
        $id = Auth::id();

        $demandes = Demande::where('user_id',$id)->get();

        return view('profile.demande', compact('demandes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demandes = Demande::all();

        return view('demande.home', compact('demandes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {

            return view('demande.add');
        } else
            return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {

            $this->validate($request, [

                'titre' => 'required|max:100',
                'description' => 'required|max:255',
                'budjetmax' => 'required|numeric',
                'tel' => 'required',
                //'user_id'=>'required|unique:users|max:255',

            ]);

            $demande = new Demande();

            $demande->titre = $request->titre;

            $demande->description = $request->description;
            $demande->budjetmax = $request->budjetmax;
            $demande->tel = $request->tel;
            $demande->user_id = Auth::user()->id;
            $demande->save();
            return redirect('/mesDemandes')->with('success', 'la demande a été bien ajouté');
        } else
            return view('auth.login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()) {
            $demande = Demande::findOrFail($id);

            return view('demande.edit', compact('demande'));
        } else
            return view('auth.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            $demande = Demande::findOrFail($id);

            $demande->update([
                'titre' => $request->titre,
                'description' => $request->description,
                'budjetmax' => $request->budjetmax,
                'tel' => $request->tel,

            ]);

            session()->flash('success', 'Updated');

            return redirect('/mesDemandes')->with('success', 'la demande a été bien mise jour');
        } else
            return view('auth.login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check()) {

            $demande = Demande::findOrFail($id);
            $demande->delete();

            return redirect('/mesDemandes')->with('success', 'la demande a été bien supprimé');
        } else
            return view('auth.login');
    }
}
