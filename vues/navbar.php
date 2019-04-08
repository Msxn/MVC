<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="?page=login">Navbarigation</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="?page=accueil">Home <span class="sr-only">(current)</span></a>
      </li>
      <?php if(!isset($_SESSION['connected']) || $_SESSION['connected'] === false){ ?>
      <li class="nav-item">
        <a class="nav-link" href="?page=login">LogIn</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=signin">SignIn</a>
      </li>
      <?php }else{ ?>
      <li class="nav-item">
        <a class="nav-link" href="?action=user-logout">LogOut</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?action=user-edit">Update</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=createarticle">Create Article</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?action=user-delete">Delete</a>
      </li>
      <?php } ?>
      
    </ul>
  </div>
</nav>