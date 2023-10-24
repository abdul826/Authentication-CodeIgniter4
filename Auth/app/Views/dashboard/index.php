<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title><?php echo $title ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Authentication</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
    
    </ul>
    <div class="my-2 my-lg-0">
        <a href="<?= base_url('/auth/logout') ?>">
         <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Logout</button>
        </a>
      
    </div>
  </div>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
            <table class="table">
  <thead>
    <tr>
      <th scope="col">S. No</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="row">Image</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><?php echo $userInfo['name']; ?></td>
      <td><?php echo $userInfo['email']; ?></td>
      <td scopr="row">    
        <img src="/images/<?= $userInfo['avatar']; ?>" alt="image" width="200" height="120">  
         <form action="<?= base_url('/auth/uploadImage') ?>" method="post" enctype="multipart/form-data" class="mt-2">
        <input type="file" class="form-control" id="userImage" name="userImage" size="10" >
        <input type="submit" class="mt-1">
        </form>
    </td>
    </tr>
  </tbody>
</table>
                    <?php
                    if(!empty(session()->getFlashData('notification'))){ ?>
                        <div class="alert alert-info">
                            <?= 
                            session()->getFlashData('notification');
                            ?>
                        </div>
                    <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>