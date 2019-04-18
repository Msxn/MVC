<?php
    //var_dump($resAction['articles']); die();
    if(isset($resAction) && !is_null($resAction)){
        foreach($resAction['articles'] as $article){ ?>
        <div class="col-lg-4">
            <article>
                <a class="btn btn-primary" href="?page=specificart&id=<?=$article->getId();?>"><h2> <?php echo $article->getArticlename(); ?> <br></h2></a>

                <?=substr(html_entity_decode($article->getArticle()),0 , 100)?>

                <p><?php 
                    echo (strlen($article->getArticle())>100)? '[...]':'';
                ?></p>

                <?php $strtime = strtotime($article->getDate());
                //$strtimeupd = (is_null($article['updateart']))? strtotime($article['updateart']) : '';
                echo '<div class="text-right">Publié le '.date('d/m/Y',$strtime).' à '.date('h:i',$strtime).' par '.$article->getAuthor().'.</div>';
                //echo ($strtimeupd === '')? 'Mis à jour le '.date('d/m/Y', $strtimeupd).' à '.date('h:i', $strtimeupd) : '';

                if(!is_null($article->getFile())){ ?>
                    <a href="uploads/<?=$article->getFile()?>" download><i class="fas fa-file-download"></i></a>
                <?php }else{ ?>
                    <i class="fas fa-file-download"></i>
                <?php } ?>
                <!--$genToken = genToken($article['id']);         &token=$genToken; -->
                <?php if(isset($_SESSION['login']) && $article->getAuthor() === $_SESSION['login']){ ?>
                    <a href="?action=article-del&id=<?=$article->getId();?>"><i class="fas fa-times-circle"></i></a>
                <?php } ?>

            </article>
        </div>
        <?php } ?>
    <?php } ?>
<!--
<div class="accordion">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Collapsible Group Item #1
                </button>
            </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
            </div>
        </div>
    </div>
</div>
-->