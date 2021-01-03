<?php


namespace App\Http\Controllers;


use App\Models\Jeu;

class MoreController
{
    public function index() {
        $jeux = Jeu::all();
        return view('jeu.more', compact('info'));
    }
}
