<?php
class userController {
    function loginAction(){
        $login =  filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $pwd =  filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_EMAIL);
        
        var_dump($_POST);
        die();
        return $this;
    }
}
