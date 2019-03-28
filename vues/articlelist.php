<?php
/*
$articlelist = mysqli_query($loginbdd, 'SELECT * FROM Article ORDER BY id desc');
$fetch = mysqli_fetch_all($articlelist, MYSQLI_ASSOC);

    foreach($fetch as $article){ ?>
    <div class="col-sm-4">
        <article>
            
            <h2> <?php echo $article['name']; ?> <br></h2>
            
            <?=substr(html_entity_decode($article['article']),0 , 100)?>
            <?php 
                echo (strlen($article['article'])>100)? '[...]':'';
            ?>
            
            <?php $strtime = strtotime($article['date']);
            //$strtimeupd = (is_null($article['updateart']))? strtotime($article['updateart']) : '';
            echo '<div class="text-right">Publié le '.date('d/m/Y',$strtime).' à '.date('h:i',$strtime).' par '.$article['autor'].'.</div>';
            //echo ($strtimeupd === '')? 'Mis à jour le '.date('d/m/Y', $strtimeupd).' à '.date('h:i', $strtimeupd) : '';
            
            if(!is_null($article['uploads'])){ ?>
                <a href="<?=$article['uploads']?>" download><i class="fas fa-file-download"></i></a>
            <?php }else{ ?>
                <i class="fas fa-file-download"></i>
            <?php }
            $genToken = genToken($article['id']);
            if(isset($_SESSION['login']) && $article['autor'] === $_SESSION['login']){ ?>
                <a href="include/adminfc/_suprarticle.php?id=<?=$article['id'];?>&token=<?=$genToken;?>"><i class="fas fa-times-circle"></i></a>
            <?php } ?>
            
        </article>
    </div>
    <?php } ?>
 
 */
