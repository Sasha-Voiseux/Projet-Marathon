<?php


namespace App\Http\Services;


class DureeConvert
{
    static public function convertir($secondes){
        $chaine = 'Il y a ';
        $minutes=(int)($secondes/60);
        if ($minutes ==0)
            return $chaine. ' '. $secondes . ' secondes.';
        $heures=(int)($minutes/60);
        if ($heures ==0)
            return $chaine. ' '. $minutes . ' minutes.';
        $jours=(int)($heures/24);
        if ($jours ==0)
            return $chaine. ' '. $heures . ' heures.';
        $semaines =(int)($jours/7);
        if ($semaines ==0)
            return $chaine. ' '. $jours . ' jours.';
        $mois =(int)($jours/30);
        if ($mois ==0)
            return $chaine. ' '. $semaines . ' semaines.';
        $ans =(int)($mois/12);
        if ($ans ==0)
            return $chaine. ' '. $mois . ' mois.';
        return $chaine. ' '. $ans . ' ans.';
    }


    static public function noteMoyenne($jeu){
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

    static public function noteMax($jeu){
        $max='Pas de notes.';

        foreach( \App\Models\Commentaire::all() as $com) {

            if ($jeu->id == $com->jeu_id && $com->note > $max && $max != 'Pas de notes.') {
                $max = $com->note;

            } elseif ($max == 'Pas de notes.' && $jeu->id == $com->jeu_id) {
                $max = $com->note;

            }

        }
        return $max;




    }
    static public function noteMin($jeu){
        $min='Pas de notes.';

        foreach( \App\Models\Commentaire::all() as $com)

            if ($jeu->id == $com->jeu_id && $com->note < $min && $min !='Pas de notes.') {
                $min = $com->note;
            }
            elseif ($min=='Pas de notes.'&&$jeu->id == $com->jeu_id)
                $min=$com->note;
        return $min;

    }
    static public function nbCom($jeu){
        $nb=0;

        foreach( \App\Models\Commentaire::all() as $com)

            if ($jeu->id == $com->jeu_id) {
                $nb++;
            }
        return $nb;

    }
    static public function nbComTotal(){
        $nb=0;

        foreach( \App\Models\Commentaire::all() as $com)
                $nb++;

        return $nb;

    }
    static public function classement($jeu){
        $rank=1;

        if (DureeConvert::noteMoyenne($jeu)!='Pas de notes.') {
            foreach (\App\Models\Jeu::all() as $j)
                if ($j->theme == $jeu->theme && DureeConvert::noteMoyenne($j) > DureeConvert::noteMoyenne($jeu))
                    $rank++;

            return $rank;

        }
        else
            return 'Pas de classement.';
    }

    static public function nbUserTotal(){
        $nb=0;

        foreach (\App\Models\Jeu::all() as $jeu){
            $nb+=$jeu->nbAchat();


        }
        return $nb;
    }
    static public function colorR($note){
        if($note != 'Pas de notes.'){
            $pas=255/50;
            return (int)(255-$note*10*$pas);

        }


    }
    static public function colorG($note){
        if($note != 'Pas de notes.'){
            $pas=255/50;
            return (int)($note*10*$pas);

        }


    }
    static public function taille($classement){
       if($classement<=3)
           return '200px;';
       elseif($classement<=7)
            return '100px;';
       else
           return '50px;';


    }



}
