<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class CommentaireController extends Controller
{

    public function show(Request $request, $id) {
        $action = $request->query('action', 'show');
        $commentaire = Commentaire::find($id);

        return view('commentaires.show', ['commentaire' => $commentaire, 'action' => $action]);
    }


    public function delete(Request $request, $id) {
        $commentaire = Commentaire::find($id);
        $user = Auth::user();
        $jeu_id = $commentaire->jeu->id;
        if ($user->can('delete', $commentaire)  || $user->can('isAdmin',$commentaire) )  {
            Log::info("Delete ok : ");
            $action = $request->get('action','annule');
            if ($action=='valide') {
                $commentaire->delete();
            }
            return redirect()->route('jeu_show', ['id' => $jeu_id])->with('status', 'Commentaire supprimé');
        } else {
            Log::info("Delete impossible : ");
            return redirect()->route('jeu_show', ['id' => $jeu_id])->with('status', 'Impossible de supprimer le commentaire');
        }
    }


}
