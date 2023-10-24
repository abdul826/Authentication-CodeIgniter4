<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-4 mt-3">
                <h2>Sign In</h2>
                <hr>
                <?php
                    if(!empty(session()->getFlashData('success'))){ ?>
                        <div class="alert alert-success">
                            <?= 
                            session()->getFlashData('success');
                            ?>
                        </div>
                    <?php
                    }else if(!empty(session()->getFlashData('fail'))){ ?>
                     <div class="alert alert-danger">
                            <?= 
                            session()->getFlashData('fail');
                            ?>
                        </div>
                    <?php
                    }
                ?>
                <form action="<?= base_url('/auth/loginUser') ?>" method="post"  >
                <?= csrf_field();?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?= set_value('email'); ?>" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        <span class="text-danger text-sm">
                            <?= isset($validation) ? display_form_errors($validation, "email") : "" ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="<?= set_value('email'); ?>">
                        <span class="text-danger text-sm">
                            <?= isset($validation) ? display_form_errors($validation, "password") : "" ?>
                        </span>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <p>
                    <a href="<?= site_url("/auth/register"); ?>">Don't have Account, Sign Up</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>