<?php

class articleController {
    function createAction(){
        $article = filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING);
        $author = $_SESSION['login'];
        $articlename = filter_input(INPUT_POST, 'articlename', FILTER_SANITIZE_STRING);

        $art = new article();
        $art->setArticlename($articlename);
        $art->setArticle($article);
        $art->setAuthor($author);
        
        $upl = $this->uploadAction();
        //var_dump($upl); var_dump($_FILES); die();
        
        $art->setFile($upl);
        
        $tabArt = $this->sendAction($art);
        
        //var_dump($tabArt); die();
        
        if($tabArt === true){
            $_SESSION['msg'] = 'Article publié';
            $_SESSION['msgCount'] += 1;
            header('Location:?action=article-liste');
        }
        else{
            $_SESSION['msg'] = 'Erreur dans la création de l\'article';
            $_SESSION['msgCount'] += 1;
            $_SESSION['typemsg'] = 'danger';
            return array('view' => 'createarticle');
        }
    }
    
    function sendAction(article $art){
        $oBdd = new dbController();
        
        $tabArt = $oBdd->insert($art, array(
            'article' => $art->getArticle(),
            'articlename' => $art->getArticlename(),
            'author' => $art->getAuthor(),
            'file' => $art->getFile(),
            'date' => date('Y-m-d H:i:s')
        ));
    
        return (!empty($tabArt))? true : false;
    }
    
    function listeAction(){
        $oBdd = new dbController();
        $article = new article();
        
        $tabArts = $oBdd->requestAll($article);
        
        //var_dump($tabArts); die();
        
        return array("view" => "accueil", "articles" => $tabArts);
    }
    
    function delAction(){
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $oBdd = new dbController();
        $article = new article();
        $article->setId($id);
        
        //var_dump($article);
        
        $oBdd->delete($article);
        
        //var_dump($tabArts); die();
        
        header('Location:?action=article-liste');
    }
    
    function listeautAction(){
        $oBdd = new dbController();
        $article = new article();
        
        $tabArts = $oBdd->requestClass($article, 
                array('champs'=>array(
                            'password',
                            'id',
                            'login'
                            ), 
                        'criteria'=>array( 
                            'author'=>$user->getEmail(), 
                            //'password'=>$user->getPassword(),
                            )
                    )
                );
        
        //var_dump($tabArts); die();
        
        return array("view" => "accueil", "articles" => $tabArts);
    }
    
    function uploadAction(){
        $dir = '/var/www/html/MVC/uploads/';
        $dirbdd = 'uploads/';
        $name = $_FILES['file']['name'];
        $type = $_FILES['file']['type'];
        $verifname = ($_FILES['file']['size'] > 0 && move_uploaded_file($_FILES['file']['tmp_name'], PATHUPL.$name))? $name : null;
        return $verifname;
    }
}
