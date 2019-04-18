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
    private $id;
    private $articlename;
    private $article;
    private $author;
    private $file;
    private $date;
    
    function getFile() {
        return $this->file;
    }

    function setFile($file) {
        $this->file = $file;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
  
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
