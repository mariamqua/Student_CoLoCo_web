<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offre;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;

class OffreController extends Controller
{

    public function user_offres()
    {
        
        $id = Auth::id();

        $offres = Offre::where('user_id',$id)->get();

        return view('profile.offre', compact('offres'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offres = Offre::all();

        return view('offre.home', compact('offres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            return view('offre.add');
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

            $request->validate([
                'description' => 'required',
                'titre' => 'required|max:100',
                'adresse' => 'required|max:100',
                'latitude' => 'required|max:100',
                'longitude' => 'required|max:100',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'prix' => 'required|numeric',
                'superficie' => 'required|numeric',
                'capacite' => 'required|numeric',
                'tel' => 'required',
            ]);
            $image_name="";
            if ($files = $request->file('image')) {
                $destination_path = "public/storage/uploads/offres_images/"; // path relative to the disk above
                $offreImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destination_path, $offreImage);
                $image_name = "$offreImage";
            }

            $offre = new Offre();
            $offre->description = $request->description;
            $offre->titre = $request->titre;
            $offre->adresse = $request->adresse;
            $offre->latitude = $request->latitude;
            $offre->longitude = $request->longitude;
            $offre->image = $image_name;
            $offre->prix = $request->prix;
            $offre->superficie = $request->superficie;
            $offre->capacite = $request->capacite;
            $offre->tel = $request->tel;
            $offre->user_id = Auth::user()->id;
            $offre->save();
         
            return redirect('/mesOffres')->with('success', "l'offre a été bien ajouté");
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
        $offre = Offre::findOrFail($id);

        return view('offre.detail', [
            'offre' => $offre
        ]);
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


            $offre = Offre::findOrFail($id);

            return view('offre.edit', compact('offre'));
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
            $offre = Offre::findOrFail($id);

            $image_name="";
            if ($files = $request->file('image')) {
                $destination_path = "public/storage/uploads/offres_images/"; // path relative to the disk above
                $offreImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destination_path, $offreImage);
                $image_name = "$offreImage";
           

            $offre->update([
                'titre' => $request->titre,
                'adresse' => $request->adresse,
                'image' =>$image_name,
                'prix' => $request->prix,
                'tel' => $request->tel,
                'description' => $request->description,
                'superficie' => $request->superficie,
                'capacite' => $request->capacite,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
            }
            session()->flash('success', 'Updated');

            return redirect('/mesOffres')->with('success', "l'offre a été mise à jour");
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
            $offre = Offre::findOrFail($id);
            $offre->delete();

            return redirect('/mesOffres')->with('success', "l'offre a été bien supprimé");
        } else
            return view('auth.login');
    }
}
