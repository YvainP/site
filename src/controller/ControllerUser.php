<?php
namespace website\controller;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use website\model\User;

class ControllerUser extends Controller{
    
    public function pagelogin(Request $request, Response $response,$args)
    {
        return $this->view->render($response, 'login.html.twig');
    }

    //vérifie les informations de connexion
    public function login(Request $request, Response $response,$args)
    {
        $pseudo = Functions::getFilteredPost($request,'pseudo');
        $password = Functions::getFilteredPost($request,'password');

        $potentialUser = User::where('pseudo', '=', $pseudo)
                      ->where('password', '=' , $password)->first(); 

        if(count($potentialUser)) {
            $_SESSION['userID'] = 2;//$potentialUser->id;
            return Functions::redirect($response, 'home');
        } else {
            echo 'nope';
            return Functions::redirect($response, 'login');
        }
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

        //vérifie si le mail/pseudo est déjà pris 
        $isUser = User::where('pseudo', '=', $pseudo)
                      ->orWhere('email', '=', $email)
                      ->first();
        echo $isUser;
        //si non on inscrit
        if($isUser == null) {
            //inscris l'utilisateur si chaque champ est valide    
            $newUser = new User();
            $newUser->pseudo = $pseudo;
            $newUser->email = $email;
            $newUser->password = Functions::getFilteredPost($request,'password');
            $newUser->save();

        //si oui on redemande à changer les informations 
        } else {
            
        }
        //return Functions::redirect($response, 'pageRegister');
    }

}
