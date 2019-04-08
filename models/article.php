<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of article
 *
 * @author Matthieu
 */
class article {
    private $articlename;
    private $article;
    private $author;
    private $date;
    function getDate() {
        
        return $this->date;
    }

    function setDate($date) {
        $this->date = $date;
    }

        
    function getArticlename() {
        return $this->articlename;
    }

    function getArticle() {
        return $this->article;
    }

    function getAuthor() {
        return $this->author;
    }

    function setArticlename($articlename) {
        $this->articlename = $articlename;
    }

    function setArticle($article) {
        $this->article = $article;
    }

    function setAuthor($author) {
        $this->author = $author;
    }
}
