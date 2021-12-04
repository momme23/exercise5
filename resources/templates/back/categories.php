

            
            <?php add_category(); ?>
            

            <h1 class="page-header">
              Produkt Kategorien
            
            </h1>
            
            
            <div class="col-md-4">
                
                <h3 class="bg-danger"><?php display_message(); ?></h3>
                
                <form action="" method="post">
                
                    <div class="form-group">
                        <label for="category-title">Name</label>
                        <input name="cat_title" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                       <label for="article-title">Beschreibung</label>
                    <textarea name="cat_desc" id="" rows="10" class="form-control"></textarea>
                    </div>
            
                    <div class="form-group">
                        
                        <input name="add_category" type="submit" class="btn btn-primary" value="Hinzufügen">
                    </div>      
            
            
                </form>
            
            
            </div>
            
            
            <div class="col-md-8">
            
                <table class="table">
                        <thead>
            
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>
                        </thead>
            
            
                <tbody>
                    <?php show_categories_admin(); ?>
                </tbody>
            
                    </table>
            
            </div>
            
            