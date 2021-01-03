<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Feuille_jeu extends Component
{
    public $nom;

    /**
     * Create a new component instance.
     *
     * @param $nom

     */
    public function __construct($nom) {
        $nom->nom = $nom;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.Feuille_jeu');
    }
}
