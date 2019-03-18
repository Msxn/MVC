<?php
class userController {
    function loginAction(){
        $login =  filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $pwd =  filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_EMAIL);
        
        $objUser = new user();
        $objUser->setLogin($login);
        $objUser->setPassword($pwd);
        
        $resultCheck = $this->checkAction($objUser);
       
        if($resultCheck){
            $_SESSION['msg'] = 'Vous êtes connecté';
            $_SESSION['typemsg'] = 'primary';
            return 'welcome';
        }
        $_SESSION['msg'] = 'Erreur de Login/Mot de Passe';
        $_SESSION['typemsg'] = 'danger';
        return $resultCheck;
    }
    
    function checkAction(user $user){
        return ($user->getPassword() == 'toto')? true : false;
            
    }
}
