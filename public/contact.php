<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

         <!-- Kontakt feld -->

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Kontaktiere Uns</h2>
                    <h3>
                        <?php display_message(); ?>
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" method="post" >
                        
                        <?php send_message(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Dein Name *" id="name" required data-validation-required-message="Bitte einen Namen eingeben.">
                  
                                    
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Deine Email *" id="email" required data-validation-required-message="Bitte eine gültige Email-Adresse eingeben.">
                         
                                </div>
                                <div class="form-group">
                                    <input name="subject" type="text" class="form-control" placeholder="Deine Anliegen *" id="phone" required data-validation-required-message="Bitte Anliegen eingeben.">
                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" placeholder="Deine Nachricht *" id="message" required data-validation-required-message="Bitte eine Nachricht eingeben"></textarea>
                           
                                </div>
                            </div>
      
                            <div class="col-lg-12 text-center">

                                <button name="submit" type="submit" class="btn btn-default btn-xl">Abschicken</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>