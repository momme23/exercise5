<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

<h3 class="text-center"><?php display_message(); ?></h3>
    <div class="container">

      <header>
            <h1 class="text-center">Login</h1>
        <div class="col-md-4 col-md-offset-5">         
            <form class="" action="" method="post">
                
                <?php login_user(); ?>
                
                <div class="form-group"><label for="">
                    Email<input type="text" name="email" class="form-control"></label>
                </div>
                 <div class="form-group"><label for="password">
                    Passwort<input type="password" name="password" class="form-control"></label>
                </div>

                <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-default" >
                </div>

            </form>
        <p>Noch kein Benutzerkonto?<a href="register.php">Hier registrieren</a></p>
        </div>  
            


    </header>


        </div>

<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>