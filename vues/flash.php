<?php if($_SESSION['msgCount'] >= 1){ ?>
    <div class="alert alert-<?=$_SESSION['typemsg']?> alert-dismissible fade show" role="alert"><?=$_SESSION['msg']; echo $_SESSION['login']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php 
    $_SESSION['msgCount'] -=1;
} ?>
