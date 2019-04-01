<?php
class userController {
    function loginAction(){
        $login =  filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $password =  filter_input(INPUT_POST, 'password', FILTER_SANITIZE_ENCODED);
        $id =  filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        
        $objUser = new user();
        $objUser->setLogin($login);
        $objUser->setPassword($password);
        //$objUser->setId($id);
        
        $resultCheck = $this->checkAction($objUser);
       
        if($resultCheck){
            $_SESSION['msg'] = 'Vous êtes connecté';
            $_SESSION['typemsg'] = 'primary';
            $_SESSION['login'] = $objUser->getLogin();
            $_SESSION['login'] = $objUser->getId();
            $_SESSION['connected'] = true;
            return array('view' => 'welcome');
        }
        $_SESSION['msg'] = 'Erreur de Login/Mot de Passe';
        $_SESSION['typemsg'] = 'danger';
        $_SESSION['connected'] = false;
        return $resultCheck;
    }
    
    function signinAction(){
        $login =  filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $password = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_ENCODED), PASSWORD_DEFAULT);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        
        $objUser = new user();
        $objUser->setLogin($login);
        $objUser->setPassword($password);
        $objUser->setEmail($email);
        
        $signin = $this->signAction($objUser);
        
        if($signin){
            echo 'INSCRIT';
            return 'articlelist';
        }
    }
    
    function signAction(user $user){
        $oBdd = new dbController();
        
        $tabUser = $oBdd->insert($user, array(/*
                'champs' => array('pwd','login','email'),
                'criteria' => array(*/
                'email' => $user->getEmail(),
                'login' => $user->getLogin(),
                'password' => $user->getPassword()
            )
        );
        
        if(empty($tabUser)){ 
            return false;
        }
    }
    
    function updateAction(){
        $login =  filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $password = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_ENCODED), PASSWORD_DEFAULT);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $oBdd = new dbController();
        
        $user = new user();
        $user->setLogin($login);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setId($_SESSION['id']);
        
        $tabUser = $oBdd->update($user,array(
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'login' => $user->getLogin(),
                'password' => $user->getPassword()
                ));
        if(empty($tabUser)){
            return 'welcome';
        }else{
            return 'accueil';
        }
    }
    
    function checkAction(user $user){
        $oBdd = new dbController();
        
        //$tabUser = $oBdd->requestById($user, $user->getId());
        $tabUser = $oBdd->request($user,
                  array('champs'=>array(
                            'password',
                            'id'
                            ), 
                        'criteria'=>array( 
                            'email'=>$user->getLogin(), 
                            //'password'=>$user->getPassword(),
                            )
                    ) 
                );
        if(empty($tabUser)){ 
            return false;
        }else{
            $_SESSION['id'] = $tabUser['id'];
        }
        
        
        /*
        $query = 'SELECT * FROM Users WHERE email = :login LIMIT 1';
        
        $req = $oBdd->getBddlink()->prepare($query);
        
        $req->execute(array(
                    'login'=>$user->getLogin()
                ));
        
        $tabUser = $req->fetch(PDO::FETCH_ASSOC);
        */
        //var_dump($tabUser); die();
        return (password_verify($user->getPassword(), $tabUser['password']))? true : false;
    }
    
    function editAction(){
        $oBdd = new dbController;
        $user = new user();
        
        $tabEdit = $oBdd->findObjectById($user, $_SESSION['id']);
        //var_dump($tab); die();
        return array('view' => 'update', 'user' => $user);
    }
    
    function logoutAction(){
        $_SESSION['connected'] = false;
        session_destroy();
        return null;
    }
}
