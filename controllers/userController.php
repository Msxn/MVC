<?php
class userController {
    function loginAction(){
        $email =  filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $password =  filter_input(INPUT_POST, 'password', FILTER_SANITIZE_ENCODED);
        
        $objUser = new user();
        $objUser->setEmail($email);
        $objUser->setPassword($password);
        //$objUser->setId($id);
        
        $resultCheck = $this->checkAction($objUser);
       
        if($resultCheck){
            $_SESSION['msg'] = 'Vous êtes connecté ';
            $_SESSION['typemsg'] = 'primary';
            $_SESSION['msgCount'] = 1;
            //var_dump($resultCheck); die();
            $_SESSION['login'] = $resultCheck['login'];
            //$_SESSION['id'] = $objUser->getId();
            //var_dump($_SESSION['id']); die();
            $_SESSION['connected'] = true;
            return array('view' => 'welcome');
        }
        $_SESSION['msg'] = 'Erreur de Login/Mot de Passe';
        $_SESSION['typemsg'] = 'danger';
        $_SESSION['msgCount'] = 1;
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
        
        //var_dump($user->getPassword()); die();
        //$tabUser = $oBdd->requestById($user, $user->getId());
        $tabUser = $oBdd->request($user,
                  array('champs'=>array(
                            'password',
                            'id',
                            'login'
                            ), 
                        'criteria'=>array( 
                            'email'=>$user->getEmail(), 
                            //'password'=>$user->getPassword(),
                            )
                    ) 
                );
        //var_dump($tabUser); die();
        if(empty($tabUser)){ 
            return false;
        }else{
            $_SESSION['id'] = $tabUser['id'];
            return $tabUser;
        }
        /*
        $query = 'SELECT * FROM Users WHERE email = :login LIMIT 1';
        
        $req = $oBdd->getBddlink()->prepare($query);
        
        $req->execute(array(
                    'login'=>$user->getLogin()
                ));
        
        $tabUser = $req->fetch(PDO::FETCH_ASSOC);
        */
        return (password_verify($user->getPassword(), $tabUser['password']))? true : false;
    }
    
    function editAction(){
        $oBdd = new dbController;
        $user = new user();
        
        $oBdd->findObjectById($user, $_SESSION['id']);
        //var_dump($tab); die();
        return array('view' => 'update', 'user' => $user);
    }
    
    function deleteAction(){
        $oBdd = new dbController();
        $user = new user();
        $user->setId($_SESSION['id']);
        
        $tabDel = $oBdd->delete($user);//, array('id'=>$user->getId()));
        
        if($tabDel){
            return 'accueil';
        }
        else{
            return '404';
        }
    }
    
    function logoutAction(){
        $_SESSION['connected'] = false;
        session_destroy();
        return null;
    }
}
