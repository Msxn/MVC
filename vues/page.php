<?php

include PATHVIEW.'header.php';

if(!empty($_SESSION['msg'])){
    include PATHVIEW.'flash.php';
    $_SESSION['msg'] = '';
}

include PATHVIEW.$page.'.php';

include PATHVIEW.'footer.php';