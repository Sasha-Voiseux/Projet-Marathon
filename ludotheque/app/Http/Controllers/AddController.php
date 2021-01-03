<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Commentaire;
use App\Models\Jeu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AddController extends Controller
{
    public function index() {
        $jeux = Jeu::all();
        return view('Jeux.index', compact('jeux'));
    }
    public function add()
    {
        return view('jeux_add');
    }

    public function commentairestore(Request $request)
    {

        $request->validate(
            [
                'commentaire' => 'required',
                'note' => 'required',
            ],
            [
                'commentaire.required' => 'Le commentaire est requis',
                'note.required' => 'La description est requise',
            ]

        );

        $commentaire = new Commentaire();
        $commentaire->commentaire = $request->commentaire;
        $commentaire->note = $request->note;
        $commentaire->user_id = Auth::user()->id;
        $commentaire->date_com = new \DateTime('now');
        $commentaire->jeu_id = $request->jeu;

        $commentaire->save();

        return redirect()->route('jeu_show',['id' => $request->jeu]);
    }

}
