<?php
ob_start();
session_start();
$page_title ='Categori';
include_once 'init.php';
    // $itemId=''; 
    // if(isset($_GET['itemid'])){ $itemId = $_GET['itemid'];}   
    $stmt=$con->prepare(" SELECT * FROM items  ")  ;                            
    $stmt->execute();
    $items=$stmt->fetchall(); 


?>

 <!-- <============================================================================> -->
   <body>
       
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="<?php echo $style_path; ?>img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

   

    <main>

        <!-- slider Area Start-->
        <div class="slider-area ">
            <!-- Mobile Menu -->
            <div class="single-slider slider-height2 d-flex align-items-center" data-background="<?php echo $style_path; ?>img/hero/category.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Product Categori</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->

        <!-- Latest Products Start -->
        <section class="latest-product-area latest-padding">
            <div class="container">
                <div class="row product-btn d-flex justify-content-between">
                        <div class="properties__button">
                            <!--Nav Button  -->
                            <nav>                                                                               
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="#" href="categori.php?do=all" role="tab" aria-controls="nav-home" aria-selected="true">All</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="#" href="categori.php?do=new" role="tab" aria-controls="nav-profile" aria-selected="false">New</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="#" href="categori.php?do=feature" role="tab" aria-controls="nav-contact" aria-selected="false">Featured</a>
                                    <a   href="categori.php?do=offer" class="nav-item nav-link" id="nav-last-tab" data-toggle="#" role="tab" aria-controls="nav-contact" aria-selected="false">Offer</a>
                                </div>
                           
                            </nav>
                            <!--End Nav Button  -->
                        </div>
                    
                </div>
                <!-- Nav Card -->
                
                <div class="tab-content" id="nav-tabContent">
 
                    <!-- card one -->
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                         <?php 
                         
                            $do=(isset($_GET['do']))?$_GET['do']:'#';
                         foreach($items as $item){
                            if(($do =='offer' && $item['offer']!=0) || ($do =='all') ||($do =='feature' && $item['featured']==0)||($do =='new'&& $item['Status']=='New')){

                              ?>
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                       
                                        <img class="img-responsive" src="<?php echo $style_path; ?>img/categori/<?php echo $item['image'] ?>" width="10" height="200"  alt="image of item" >
                                        <div class="new-product">
                                            <?php 
                                            if($item['Status']=='New'){
                                             echo '<span>New</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star low-star"></i>
                                            <i class="far fa-star low-star"></i>
                                        </div>
                                            <?php
     
                                            echo '<span class="edit-cog" ><a href="items.php?do=edit&itemid='.$item['item_iD'].' ">';
                                             if(isset($_SESSION['username'])&&$_SESSION['ID']==2){
                                            echo '<i class="fas fa-cog"></i></a></span>';}
                                            //    ======================
                                            echo '<h4>'.$item['Name']."</br>".'</h4>'; 
                                            echo'<a id="details" href="items.php?do=details&itemid='.$item['item_iD'].'">Details</a>' 
                                            ;
         
                                            ?>  
                                        <div class="price">
                                            <ul>
                                            <?php if($item['offer'] != 0 ){
                                                echo '<li> $'. $item['offer'].'</li>';
                                                echo '<li class="discount">';
                                               
                                            
                                            }else 
                                                echo '<li>';
                                                echo  $item['Price'].'</li>';
                                               
                                         ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         <?php }}
        //  =============================================================
                         ?>
                        </div>
                    </div>

                </div>
                                       
                <!-- End Nav Card -->
                
            </div>
           
        </section>
        <!-- Latest Products End -->

        <!-- Latest Offers Start -->
        <div class="latest-wrapper lf-padding">
            <div class="latest-area latest-height d-flex align-items-center" data-background="<?php echo $style_path; ?>img/collection/latest-offer.png">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-5 col-lg-5 col-md-6 offset-xl-1 offset-lg-1">
                            <div class="latest-caption">
                                <h2>Get Our<br>Latest Offers News</h2>
                                <p>Subscribe news latter</p>
                            </div>
                        </div>
                            <div class="col-xl-5 col-lg-5 col-md-6 ">
                            <div class="latest-subscribe">
                            <h2 id="msg" class="text-center"><i class="fas fa-check"></i></h2>
                                <form id="email" action="#" method="post">
                                    <input type="email" name="mail" placeholder="Your email here" required autocomplete="off">
                                    <button onClick=" ajax_insert('members.php?do=mail','#email')">Shop Now</button>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- man Shape -->
                <div class="man-shape">
                    <img src="<?php echo $style_path; ?>img/collection/latest-man.png" alt="">
                </div>
            </div>
        </div>
        <!-- Latest Offers End -->
        <!-- Shop Method Start-->
        <div class="shop-method-area section-padding30">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-package"></i>
                            <h6>Free Shipping Method</h6>
                            <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-unlock"></i>
                            <h6>Secure Payment System</h6>
                            <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                        </div>
                    </div> 
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-reload"></i>
                            <h6>Secure Payment System</h6>
                            <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop Method End-->
        <!-- Gallery Start-->
        <div class="gallery-wrapper lf-padding">
            <div class="gallery-area">
                <div class="container-fluid">
                    <div class="row">
                    <?php 
        $latestitem=5; //number of lates item will show 
        $thelatest=get_latest("*","items","item_iD DESC",$latestitem);
         foreach($thelatest as $item){?>
                        <div class="gallery-items">
                            <img src="<?php echo $style_path; ?>img/categori/<?php echo $item['image']   ?>" alt="">
                           

                        </div> 
        <?php } ?>
                     
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery End-->

    </main>
    <?php   

    include_once '../includes/templates/footer.php';
    
    ?>