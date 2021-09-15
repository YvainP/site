<?php
namespace website\controller;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use website\model\User;

class ControllerUser extends Controller{
    public function pageProfile(Request $request, Response $response,$args)
    {
        return $this->view->render($response, 'profile.html.twig');
    } 
 
    public function home(Request $request, Response $response,$args)
    {
        return $this->view->render($response, 'home.html.twig');
    }
    public function pageLogin(Request $request, Response $response,$args)
    {
        return $this->view->render($response, 'login.html.twig');
    }

    //vérifie les informations de connexion
    public function login(Request $request, Response $response,$args)
    {
        $pseudo = Functions::getFilteredPost($request,'pseudo');
        $pwdTyped = Functions::getFilteredPost($request,'password');
        $potentialUser = User::where('pseudo', '=', $pseudo)->first();
        echo 2;
        if(count($potentialUser)) {
            if(fctAuth::checkPassword($pseudo, $pwdTyped)){
                $_SESSION['user']['id'] = $potentialUser->id;
                echo 1;
                return Functions::redirect($response, 'home');
            } 
        }
        
        //return Functions::redirect($response, 'login');
    }
    
    public function pageRegister(Request $request, Response $response,$args)
    {
        $pseudo = Functions::getFilteredPost($request,'pseudo');
        return $this->view->render($response, 'registration.html.twig', ['pseudo' => $pseudo]);
    }

    //gère l'inscription
    public function register(Request $request, Response $response,$args)
    {
        $pseudo = Functions::getFilteredPost($request,'pseudo');
        $email = Functions::getFilteredPost($request,'email');
        $pwd = Functions::getFilteredPost($request,'password');

        //vérifie si le mail/pseudo est déjà pris 
        $isUser = User::where('pseudo', '=', $pseudo)
                      ->orWhere('email', '=', $email)
                      ->first();
        //si non on inscrit
        if($isUser == null) {
            //inscris l'utilisateur si chaque champ est valide    
            $newUser = new User();
            $newUser->pseudo = $pseudo;
            $newUser->email = $email;
            $newUser->password = password_hash($pwd, PASSWORD_DEFAULT);      
            $newUser->save();
            $_SESSION['user']['id'] = $newUser->id;
        //si oui on redemande à changer les informations 
        } else {
            return Functions::redirect($response, 'register');
        }
        return Functions::redirect($response, 'home');
    }

    public function logOut(Request $request, Response $response,$args){
        fctAuth::logout(); 
        return Functions::redirect($response, 'home');

    }

}
