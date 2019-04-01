<?php //var_dump($resAction); die(); 
    if($page === 'update'){
        $action = 'user-update';
    }else{
        $action = 'user-signin';
    }
?>
<form method="POST" action="?action=<?=$action;?>">
    <div class='container'>
        <div class="form-group row">
            <label class="col-sm-1 col-form-label">E-mail :</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="exemple@exemple.fr"
                       <?php if(isset($resAction)){ ?>
                       value="<?=$resAction['user']->getEmail();?>"
                       <?php } ?>
                       >
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-1 col-form-label">Pseudo :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputLogin3" name="login" placeholder="thisismylogin"
                       <?php if(isset($resAction)){ ?>
                       value="<?=$resAction['user']->getLogin();?>"
                       <?php } ?>
                       >
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-1 col-form-label">Mot de Passe :</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="mdp12345" value=""
                       >
            </div>
        </div>
        <input type="submit" class="btn btn-primary">
    </div>
</form>

