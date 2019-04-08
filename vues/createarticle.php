<form action='?action=article-create' enctype="multipart/form-data" method='POST'>
    <div id='container-fluid' style="padding-left: 4%; padding-right: 4%;">
        <div class="row">&nbsp;</div>
        <div class="form-group row">
            <label class="col-sm-12 col-form-label text-center">
                <span class="d-inline p-2 bg-primary text-white rounded h1 text-center">Créer un article</span>
            </label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">
                <span class="d-inline p-2 bg-dark text-white rounded">Pseudo :</span>
            </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="<?=$_SESSION['login'];?>" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">
                <span class="d-inline p-2 bg-dark text-white rounded">Nom de l'article : </span>
            </label>
            <div class="col-sm-9">
                <input type='text' name='articlename' class='form-control'>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-form-label text-center">
                <span class="d-inline p-2 bg-primary text-white rounded">Article : </span>
            </label>
        </div>
        
        <div class="form-group row">
            <div class="col-sm-12">
                <textarea cols="10" name='article' id='article'></textarea>
                <script>
                    CKEDITOR.replace('article');
                </script>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12">
                <input type="hidden" name="MAX_FILE_SIZE" value=2000000" />
                <input type='file' class="btn btn-outline-info" name='file'><br>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12 text-center">
                <input type='submit' value='Publier' class="btn btn-success btn-lg">
            </div>
        </div>
    </div>
</form>

