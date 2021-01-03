<?php
namespace App\Policies;
use App\Models\Commentaire;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;
class CommentairePolicy

{
    use HandlesAuthorization;
    /**

     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(){
    }
    function isAdmin(User $user, Commentaire $commentaire) {
        Log::info("isAdmin policy : ".$user->id ."=".$commentaire->jeu->user_id);
        return $user->id === $commentaire->jeu->user_id;
    }
    function update(User $user, Commentaire $commentaire) {
        return $user->id === $commentaire->user_id;
    }
    function delete(User $user, Commentaire $commentaire) {
        return $user->id === $commentaire->user_id;
    }
}

