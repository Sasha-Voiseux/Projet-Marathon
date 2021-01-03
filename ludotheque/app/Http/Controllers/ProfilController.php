<?php

namespace App\Http\Controllers;

use App\Models\Jeu;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index()
    {
        $user = Auth::user();
        return view('profil');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.]
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addAchat()
    {
        $jeux = Jeu::all();
        return view('achatjeu', [
            'jeux' => $jeux
        ]);
    }

    public function removeAchat($id) {
        $user = Auth::user();
        $user->ludo_perso()->detach($id);
        return redirect()->route('profil');
    }

    public function storeAchat(Request $request)
    {
        $request->validate([
            'jeu_id' => 'required',
            'lieu' => 'required',
            'date_achat' => 'required',
            'prix' => 'required | numeric',
        ]);
        $user = Auth::user();
        $user->ludo_perso()->attach($request->jeu_id, ['lieu' => $request->lieu,
            'prix' => $request->prix,
            'date_achat' => $request->date_achat]);
        $user->save();
        return redirect()->route('profil');
    }

    public function afficheAchat() {
        $user = Auth::user();
        $jeux = $user->ludo_perso1();
        return view('afficheachat', ['jeux' => $jeux]);
    }

}
