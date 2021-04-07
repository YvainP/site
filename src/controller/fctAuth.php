<?php
namespace website\controller;

class fctAuth {

    //verifie si l'utilisateur est connecté
    public static function isConnected() : bool {
        return isset($_SESSION['user']);
    }
    //déconnecte l'utilisateur
    public static function logout()  {
        unset($_SESSION['user']);
    }

    //vérifie la validité du mdp entré
    public function checkPassword(string $pseudo, string $pwdTyped){
        $potentialUser = User::where('pseudo', '=', $pseudo)->first();
        return password_verify($pwdTyped, $potentialUser->password);
    }
}
