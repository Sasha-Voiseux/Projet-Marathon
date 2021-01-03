<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jeu extends Model {
    use HasFactory;

    protected $table = 'jeux';

    public $timestamps = false;

    protected $fillable = ['nom', 'description', 'regles', 'langue',
        'url_media', 'age', 'nombre_joueurs', 'categorie', 'duree'];

    function createur() {
        return $this->belongsTo(User::class);
    }

    function theme() {
        return $this->belongsTo(Theme::class);
    }

    function editeur() {
        return $this->belongsTo(Editeur::class);
    }

    function mecaniques() {
        return $this->belongsToMany(Mecanique::class, 'avec_mecaniques');
    }
    function acheteurs() {
        return $this->belongsToMany(User::class, 'achats')
            ->as('achat')
            ->withPivot('prix', 'lieu', 'date_achat');
    }

    function commentaires() {
        return $this->hasMany(Commentaire::class);
    }
    function prixMoyen(){
        $somme=0;
        $nb=0;
        foreach($this->acheteurs as $acheteur){

            if (isset($acheteur->achat->prix)){
                $somme+=$acheteur->achat->prix;
                $nb++;
            }

        }
        if ($nb ==0)
            return 'Pas de prix indiqué.';
        return sprintf("%6.2f€",$somme/$nb);


    }

    function noteMoyenne1($jeu) {
        $somme=0;
        $nbNotes=0;
        foreach( \App\Models\Commentaire::all() as $com)
            if ($jeu->id == $com->jeu_id) {
                $somme += $com->note;
                $nbNotes++;
            }
        if ($nbNotes==0)
            return 'Pas de notes.';
        return $somme/$nbNotes;
    }

  function prixMax(){
        $max='Pas de prix.';

        foreach($this->acheteurs as $acheteur){

            if ($acheteur->achat->prix > $max && $max != 'Pas de prix.') {
                $max = $acheteur->achat->prix;

            } elseif ($max == 'Pas de prix.') {
                $max = $acheteur->achat->prix;

            }

        }
        if ($max=='Pas de prix.')
            return $max;
        return $max . '€';




    }


    function prixMin(){
        $min='Pas de prix.';

        foreach($this->acheteurs as $acheteur){

            if ($acheteur->achat->prix < $min && $min != 'Pas de prix.') {
                $min = $acheteur->achat->prix;

            } elseif ($min == 'Pas de prix.') {
                $min = $acheteur->achat->prix;

            }

        }
        if ($min=='Pas de prix.')
            return $min;
        return $min . '€';




    }
    function nbAchat(){
        $nb=0;
        foreach($this->acheteurs as $acheteur){
            $nb++;
        }
        return $nb;
    }

}
