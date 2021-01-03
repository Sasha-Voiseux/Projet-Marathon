<?php

namespace App\Http\Controllers;

use App\Http\Services\DureeConvert;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use App\Models\Jeu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\DB;
use App\Models\Mecanique;
use League\CommonMark\Extension\Mention\Mention;

class JeuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index(Request $request)
    {

        $editeur_id = $request->get('editeur', null);
        if (isset($editeur_id)) {
            $jeux = Jeu::where('editeur_id', $editeur_id)->get();
        } else {
            $jeux = Jeu::all();
        }
        return view('jeu.listeJeux', ['jeux' => $jeux]);
    }

    function indexTheme(Request $request)
    {
        $theme_id = $request->get('theme', null);
        if (isset($theme_id)) {
            $jeux = Jeu::where('theme_id', $theme_id)->get();
        } else {
            $jeux = Jeu::all();
        }
        return view('jeu.listeJeux', ['jeux' => $jeux]);
    }

    function indexMecanique(Request $request)
    {

        $mecanique_id = $request->get('mecanique', null);
        if (isset($mecanique_id)) {
            $mecanique = Mecanique::find($mecanique_id);
            $jeux = $mecanique->jeux;

        } else {
            $jeux = Jeu::all();
        }
        return view('jeu.listeJeux', ['jeux' => $jeux]);
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
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $jeu = Jeu::find($id);
        return view('jeu.show', ['jeu' => $jeu]);
    }

    public function regles($id)
    {
        $jeu = Jeu::find($id);
        return view('jeu.regles', ['jeu' => $jeu]);
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
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'nom' => 'required|unique:jeux',
                'description' => 'required',
                'theme' => 'required',
                'editeur' => 'required',
                'langue' => 'required',
                'age' => 'required',
                'image' => 'file|max:500000',
            ],
            [
                'nom.required' => 'Le nom est requis',
                'nom.unique' => 'Le nom doit être unique',
                'description.required' => 'La description est requise',
                'theme.required' => 'Le théme est requis',
                'editeur.required' => 'L\'editeur est requis',
                'langue.required' => 'la langues est requise',
                'age.required' => 'l\'age est requise',
                'image.file' => 'Poids max 500Ko',
            ]
        );

        $jeu = new Jeu();
        $jeu->nom = $request->nom;
        $jeu->description = $request->description;
        $jeu->theme_id = $request->theme;
        $jeu->user_id = Auth::user()->id;
        $jeu->editeur_id = $request->editeur;
        $jeu->url_media = 'https://picsum.photos/seed/'.$jeu->nom.'/200/200';
        $jeu->langue = $request->langue;
        $jeu->age = $request->age;
        $jeu->nombre_joueurs = $request->nombre_joueurs;
        $jeu->duree = $request->duree;
        $jeu->categorie = $request->categorie;

        if($request->file('image') !== null){

            $file = $request->file('image');


            $extension = $file->getClientOriginalExtension();

            // File upload location
            $location = public_path().'/img/';

            $filename = uniqid().'.'.$extension;

            // Upload file
            $file->move($location, $filename);

            $jeu->url_media = '/img/'.$filename;

        }


        $jeu->save();

        $jeu->mecaniques()->attach($request->avec_mecaniques);

        $jeu->save();


        return Redirect::route('pagination');
    }


    public function add()
    {
        return view('jeux_add');
    }

    public function randomGames()
    {
        $randomGames = Jeu::inRandomOrder()->limit(5)->get();
        return view('jeu.index', compact('randomGames'));
    }

    public function noteMoyenne1($jeu)
    {
        $somme = 0;
        $nbNotes = 0;
        foreach (\App\Models\Commentaire::all() as $com)

            if ($jeu->id == $com->jeu_id) {
                $somme += $com->note;
                $nbNotes++;
            }
        if ($nbNotes == 0)
            return 'Pas de notes.';
        return $somme / $nbNotes;
    }

    public function bestGames()
    {
        $jeux = Jeu::all();
        $bestGames = array();
        while (count($bestGames) < 5) {
            $memoire = 0;
            $max = 0;
            foreach ($jeux as $jeu) {
                $a = $this->noteMoyenne1($jeu);
                    if ($max < $a && (!in_array($jeu,$bestGames))) {
                        $max = $a;
                        $memoire = $jeu;
                    }
            }
            array_push($bestGames, $memoire);
        }
        return view('jeu.index2', compact('bestGames'));
        }

    function tri()
    {
        $jeux = Jeu::all()->sortBy('nom');

        return view('jeu.tri', ['jeux' => $jeux]);
    }

    function triChrono($id)
    {
        $jeu = Jeu::find($id);

        return view('jeu.showTri', ['jeu' => $jeu]);
    }

    function triEditeur()
    {
        $jeux = Jeu::all();

        return view('jeu.groupeEditeur', ['jeux' => $jeux]);
    }
    function list($n=15){
        $jeux=DB::table('jeux')->paginate($n);
        return view('jeu.listeJeuxPages',['jeux'=>$jeux]);
    }

    function search() {
        $q = request()->input('meca');
        /*if (isset($q)) {
            $mecanique = Mecanique::find($q);
        }*/
        $r = request()->input('nombre_joueurs');
        $s = request()->input('duree');
        $t = request()->input('langue');
        $jeux = Jeu::where('nombre_joueurs','like',"%$r%")
            ->where('langue','like',"%$t%")
            ->where('duree','like',"%$s")
            ->get();

        return view('rechercher')->with('jeux',$jeux);
    }

}
