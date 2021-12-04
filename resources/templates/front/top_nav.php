<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Startseite</a>

            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="allarticles.php">Produkte</a>
                    </li>
                    <li class="nav-item">
                        <a href="about.php">Über Uns</a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php">Kontakt</a>
                    </li>

                </ul>

              <ul class="nav navbar-nav navbar-right">
                                  
    <?php if (isset($_SESSION['email']))
{
      if (!empty($_SESSION['email']))
      {
        echo ("<li class='nav-item'><a href='logout.php'>Logout</a>");
      }
}
          ?>
                
    <?php if (!isset($_SESSION['email']))
{
      if (empty($_SESSION['email']))
      {
        echo ("<li class='nav-item'><a href='login.php'>Login</a>");
      }
}
          ?> 
                <!--     <li class="nav-item">
                        <a href="login.php">Login  </a>
                    </li> -->
                    <li class="nav-item">
                        <a href="admin"><span class="glyphicon glyphicon-user"></span> Benutzer</a>
                    </li>
                     <li class="nav-item">
                        <a href="checkout.php"><span class="glyphicon glyphicon-shopping-cart"></span> Warenkorb</a>
                    </li>
                </ul>
            </div>

        </nav>
