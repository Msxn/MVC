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
        
        $tabArt = $this->sendAction($art);
        
        if($tabArt === true){
            $_SESSION['msg'] = 'Article publié';
            $_SESSION['msgCount'] += 1;
            return array('view' => 'accueil');
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
            'date' => date('Y-m-d H:i:s')
        ));
    
        return (!empty($tabArt))? true : false;
    }
    
    function listeAction(){
        $oBdd = new dbController();
        $article = new article();
        
        $tabArts = $oBdd->requestAll($article);
        
        return array("view" => "accueil", "articles" => $tabArts);
    }
}
