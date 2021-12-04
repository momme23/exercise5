



                    <div class="col-lg-12">
                      

                      <h1 class="page-header">
                          Nutzer
                       
                      
                      <h3 class="bg bg-danger"><?php display_message(); ?></h3>




                      <div class="col-md-12">

                          <table class="table table-hover">
                              <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>E-Mail</th>
                                      <th>Vorname</th>
                                      <th>Name</th>
                                      <th>Adresse</th>
                                      <th>PLZ</th>
                                      <th>Ort</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  
                                  <?php users_admin(); ?>
                                  
                              </tbody>
                          </table> 
                      

                      </div>

                       <a href="index.php?add_user" class="btn btn-success">Nutzer Hinzufügen</a>
