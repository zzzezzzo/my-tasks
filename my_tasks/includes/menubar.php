<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img id="app-logo" src="../img/logo.png"> <?php echo $app_name; ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../css/icons/list.svg"> Tasks
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../tasks/list.php"><img src="../css/icons/list.svg"> Tasks List</a></li>
            <li><a class="dropdown-item" href="../tasks/new.php"><img src="../css/icons/new.svg"> New Task</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="../tasks/trash.php"><img src="../css/icons/trash.svg"> Tasks Trash</a></li>
          </ul>
        </li>
      </ul>
      <form method="get" action="../tasks/search.php" class="d-flex" role="search">
        <input class="form-control me-2" value="<?php if(isset($_GET["search"])) { echo $_GET["search"]; } ?>" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>