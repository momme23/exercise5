<?php require_once("../../resources/config.php"); ?>
<?php include(TEMPLATE_BACK . "/header.php"); ?>

<?php 


if(($_SESSION['admin']) == 0) {
    
    redirect("../../public/user/index.php");
}

?>

        <div id="page-wrapper">

            <div class="container">


                
                <?php
                
                if($_SERVER['REQUEST_URI'] == "/Zosimos_Zaubertrankfachhandel/public/admin/" || $_SERVER['REQUEST_URI'] == "/Zosimos_Zaubertrankfachhandel/public/admin/index.php") {
                    
                    include(TEMPLATE_BACK . "/admin_content.php");
                }
                
                if(isset($_GET['orders'])){
                    
                    include(TEMPLATE_BACK . "/orders.php");
                }
                if(isset($_GET['articles'])){
                    
                    include(TEMPLATE_BACK . "/articles.php");
                }
                if(isset($_GET['categories'])){
                    
                    include(TEMPLATE_BACK . "/categories.php");
                }
                if(isset($_GET['add_article'])){
                    
                    include(TEMPLATE_BACK . "/add_article.php");
                }
                if(isset($_GET['edit_article'])){
                    
                    include(TEMPLATE_BACK . "/edit_article.php");
                }
                if(isset($_GET['users'])){
                    
                    include(TEMPLATE_BACK . "/users.php");
                }
                if(isset($_GET['add_user'])){
                    
                    include(TEMPLATE_BACK . "/add_user.php");
                }
                if(isset($_GET['salereports'])){
                    
                    include(TEMPLATE_BACK . "/salereports.php");
                }
                if(isset($_GET['delete_order_id'])){
                    
                    include(TEMPLATE_BACK . "/delete_order.php");
                }
                if(isset($_GET['delete_category_id'])){
                    
                    include(TEMPLATE_BACK . "/delete_category.php");
                }
                if(isset($_GET['delete_article_id'])){
                    
                    include(TEMPLATE_BACK . "/delete_article.php");
                }
                if(isset($_GET['delete_salereports_id'])){
                    
                    include(TEMPLATE_BACK . "/delete_salereports.php");
                }
                if(isset($_GET['delete_user_id'])){
                    
                    include(TEMPLATE_BACK . "/delete_user.php");
                }
                    
                
                ?>


            </div>


        </div>

<?php include(TEMPLATE_BACK . "/footer.php"); ?>

