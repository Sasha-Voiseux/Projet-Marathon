<?php
namespace Database\Seeders;
use Faker\Factory as Faker;
use App\Models\Jeu;
use Illuminate\Database\Seeder;
class JeuxSeeder extends Seeder

{
    /**

     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        $faker = Faker::create();
        $jeux = new Jeu();
        $jeux->nom = "Vik-Team" . $faker->words(2, true);
        $jeux->description = "Vik-Team" . $faker->text(300);
        $jeux->regles = "Vik-Team" . $faker->text(300);
        $jeux->langue = "Fr";
        $jeux->url_media = $faker->imageUrl(640, 480);
        $jeux->nombre_joueurs = 10;
        $jeux->duree = "30 minutes";
        $jeux->user_id=1;
        $jeux->theme_id=1;
        $jeux->editeur_id=1;
        $jeux->categorie="Jeu de Cartes";
        $jeux->save();
    }
}
