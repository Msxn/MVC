<?php
class userController {
    function loginAction(){
        $login =  filter_input(INPUT_POST, 'login', FILTER_SANITIZE_EMAIL);
        $password =  filter_input(INPUT_POST, 'password', FILTER_SANITIZE_EMAIL);
        
        $objUser = new user();
        $objUser->setLogin($login);
        $objUser->setPassword($password);
        
        $resultCheck = $this->checkAction($objUser);
       
        if($resultCheck){
            $_SESSION['msg'] = 'Vous êtes connecté';
            $_SESSION['typemsg'] = 'primary';
            $_SESSION['connected'] = true;
            return 'articlelist';
        }
        $_SESSION['msg'] = 'Erreur de Login/Mot de Passe';
        $_SESSION['typemsg'] = 'danger';
        $_SESSION['connected'] = false;
        return $resultCheck;
    }
    
    function checkAction(user $user){
        $oBdd = new dbController();
        
        $query = 'SELECT * FROM Users WHERE email = :login';
        
        $req = $oBdd->getBddlink()->prepare($query);
        
        $req->execute(array(
                    'login'=>$user->getLogin()
                ));
        
        $tabUser = $req->fetch(PDO::FETCH_ASSOC);
        
        //var_dump($tabUser); die();
        
        return (password_verify($user->getPassword(), $tabUser['pwd']))? true : false;
    }
    
    function logoutAction(){
        $_SESSION['connected'] = false;
        session_destroy();
        return null;
    }
}
