<?php

include_once 'pathfiles.php';

include_once $functions_path.'functions.php';

include_once $admin_path.'config.php';
// include_once '../admin/init.php';




// $style_path='../assets/';
if(isset($_SESSION['username'])){ 
$userId=$_SESSION['ID'];                           
$stmt = $con -> prepare("SELECT * FROM  userdata WHERE   id=?   LIMIT 1 ");
        $stmt->execute(array($userId));
        $row=$stmt->fetch();
    }

      
    

// <== END PHP code =======================>
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> <?php get_title() ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $style_path; ?>img/favicon.ico">
        

		<!-- CSS here -->
            <link rel="stylesheet" href="<?php echo $style_path; ?>css/bootstrap.min.css">
            <link rel="stylesheet" href="<?php echo $style_path; ?>css/owl.carousel.min.css">
            <link rel="stylesheet" href="<?php echo $style_path; ?>css/flaticon.css">
            <link rel="stylesheet" href="<?php echo $style_path; ?>css/slicknav.css">
            <link rel="stylesheet" href="<?php echo $style_path; ?>css/animate.min.css">
            <link rel="stylesheet" href="<?php echo $style_path; ?>css/magnific-popup.css">
            <link rel="stylesheet" href="<?php echo $style_path; ?>css/fontawesome-all.min.css">
            <link rel="stylesheet" href="<?php echo $style_path; ?>css/themify-icons.css">
            <link rel="stylesheet" href="<?php echo $style_path; ?>css/slick.css">
            <link rel="stylesheet" href="<?php echo $style_path; ?>css/nice-select.css">
            <link rel="stylesheet" href="<?php echo $style_path; ?>css/style.css">
            <link rel="stylesheet" href="<?php echo $style_path; ?>css/back.css">
            
            
            
           
   </head>
   <body>
   <header>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
                <div class="header-top top-bg d-none d-lg-block">
                   <div class="container-fluid">
                       <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left d-flex">
                                    <div class="flag">
                            <!-- <img src=" flageimage " alt=""> -->
                                    </div>
                                    <div class="select-this">
                                        <form action="#">
                                            <div class="select-itms">
                                          <!-- select box here -->
                                            </div>
                                        </form>
                                    </div>
                                    <ul class="contact-now">     
                                        <!-- <li></li> -->
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                   <ul>     
                                   <?php
                                   
                                      if(isset($_SESSION['username'])){ 
                                        ?>   
                                      <li> <a href='members.php?do=edit&userid=<?php echo $row['id'];  ?>' >  My Account </a></li>; 
                                     
                                       <li><a href="product_list.php">Product List </a></li>
                                      
                                   
                                  
                                       <li><a href="cart.php">Cart</a></li>
                                       <li><a href="checkout.php">Checkout</a></li>
                                       <!-- ============ -->
                                       <?php } ?>
                                       
                                   </ul>
                                   
                                   
                                </div>
                                
                            </div>      
                       </div>                    
                   </div>
                </div>           
              <div class="header-bottom  header-sticky">
             
                    <div class="container-fluid">
                   
                        <div class="row align-items-center">

                            <!-- Logo -->
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                                <div class="logo">
                                  <a href="#"><img src="<?php echo $style_path; ?>img/logo/logo.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>                                                
                                        <ul id="navigation">                                                                                                                                     
                                            <li><a href="index.php?do=all">Home</a></li>
                                            <li><a href='categori.php?do=all'>categori</a></li>
                                            <li class="hot"><a href="#">Latest</a>
                                                <ul class="submenu">
                                                    <li><a href="product_list.php"> Product list</a></li>
                                                    
                                                </ul>
                                            </li>
                                             
                                            </li>
                                            <li><a href="#">Pages</a>
                                                <ul class="submenu">
                                                    <li><a href="logout.php">Login</a></li>
                                                    
                                                    <li><a href="about.php">About</a></li>
                                                    <?php if(!empty($_SESSION['username'])){ ?>
                                                    <li><a href="confirmation.php">Confirmation</a></li>
                                                    <li><a href="cart.php">Shopping Cart</a></li>
                                                    <li><a href="checkout.php">Product Checkout</a></li>  
                                                    <?php }?>
                                                            
                                                </ul>
                                            </li>
                                            <li><a class="5x" href="contact.php">Contact</a></li>
     <!--========================start pages Admin Control =================-->
                                           
                                                
            <?php 
                if(isset($_SESSION['username']) && $row['adminId']==1  ){?>
                    <li><a href="#"> <i class="fas  fa-bars 5x"></i></a>
                        <ul class="submenu">
                           <li><a href="dashboard.php">dashboard</a></li>
                           <li><a href="members.php?userid=' . $_SESSION['ID'] .'">Manage  Member</a></li>
                            <li> <a href="categ.php?do=manage">manage categori</a></li>
                          <li> <a href="items.php?do=manage">manage items</a></li>
                        </ul> 
                     </li>
             <?php  } ?>
                        
                  
<!--============================ END pages Admin Control=============== -->
                                        </ul>
                                    </nav>
                                </div>
                            </div> 
                            <div class="col-xl-5 col-lg-3 col-md-3 col-sm-3 fix-card">
                                <ul class="header-right f-right d-none d-lg-block d-flex justify-content-between">
                                   
         <!-- check if user login will show favoirt'heart' & shopping cart icons in header -->
                                     <?php  if(isset($_SESSION['username'])){ ?>
                                    
                                    <li>
                                        <div class="shopping-card">
                                            <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                                        </div>
                                    </li>
                                    <?php 
                                   }
                                    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
                                            echo ' <li class="d-none d-lg-block"> <a href="logout.php" class="btn header-btn">log out </a></li>';


                                    }else{
                                        echo ' <li class="d-none d-lg-block"> <a href="login.php" class="btn header-btn">login </a></li>';
                                    }
                                    ?>
                                   
                                </ul>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
    </header>