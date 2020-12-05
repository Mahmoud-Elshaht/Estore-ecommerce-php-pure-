<?php
ob_start();
session_start();
//  $config='';
//parameter of function 'get_title()' to echo page title in Browser
 $page_title ='HOME';


// $File_path='admin/';// path of files in folder admin 
include_once 'init.php';
$do=(isset($_GET['do']))?$_GET['do']:'#';
// statment for fetch categoris 
$stmt=$con->prepare("SELECT * FROM categories ORDER BY iD DESC");
$stmt->execute();
$thecateg=$stmt->fetchall();
// function get_latest() for fetch last items 
$thelatest= get_latest('*','items','item_iD DESC',6); 

// <=== End php code =====>
?>

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

        <!-- slider Area Start -->
        <div class="slider-area ">
            <!-- Mobile Menu -->
            <div class="slider-active">
                <div class="single-slider slider-height" data-background="<?php echo $style_path; ?>img/hero/h1_hero.jpg">
                    <div class="container">
                        <div class="row d-flex align-items-center justify-content-between">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-none d-md-block">
                                <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                                    <img src="<?php echo $style_path; ?>img/hero/hero_man.png" alt="">
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-8">
                                <div class="hero__caption">
                                    <span data-animation="fadeInRight" data-delay=".4s">60% Discount</span>
                                    <h1 data-animation="fadeInRight" data-delay=".6s">Winter <br> Collection</h1>
                                    <p data-animation="fadeInRight" data-delay=".8s">Best Cloth Collection By 2020!</p>
                                    <!-- Hero-btn -->
                                    <div class="hero__btn" data-animation="fadeInRight" data-delay="1s">
                                        <a href="index.php" class="btn hero-btn">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-slider slider-height" data-background="<?php echo $style_path; ?>img/hero/h1_hero.jpg">
                    <div class="container">
                        <div class="row d-flex align-items-center justify-content-between">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-none d-md-block">
                                <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                                    <img src="<?php echo $style_path; ?>img/hero/hero_man.png" alt="">
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-8">
                                <div class="hero__caption">
                                    <span data-animation="fadeInRight" data-delay=".4s">60% Discount</span>
                                    <h1 data-animation="fadeInRight" data-delay=".6s">Winter <br> Collection</h1>
                                    <p data-animation="fadeInRight" data-delay=".8s">Best Cloth Collection By 2020!</p>
                                    <!-- Hero-btn -->
                                    <div class="hero__btn" data-animation="fadeInRight" data-delay="1s">
                                        <a href="industries.php" class="btn hero-btn">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- slider Area End-->

        <!-- ===== Category Area Start============================================= -->

        <section class="category-area section-padding30">
            <div class="container-fluid">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center mb-85">
                            <h2>Shop by Category</h2>
                        </div>
                    </div>
                </div>

                <!-- ===== start div Shop by Category============================================= -->

                <div class="row">
                    <?php
                    foreach($thecateg as $cat){

                    ?>
                    <div class="col-xl-4 col-lg-6">
                        <div class="single-category mb-30">
                            <div class="category-img">
                                <img src="<?php echo $style_path; ?>img/categori/<?php echo $cat['image'] ?>" width="10" height="200"
                                    alt="image of item">
                                <div class="category-caption">

                                    <span class="best"> <a href="categ.php?do=details&catid=<?php echo $cat['iD'] ?>">
                                            <h2><?php echo $cat['Name'] ?></h2>
                                        </a></span>
                                    <span class="collection">New Collection</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php }  ?>
                </div>
            </div>
        </section>
        <!--===== Category Area End===-->

        <!-- ==============Latest Products Start ======================== -->
        <section class="latest-product-area padding-bottom">
            <div class="container">
                <div class="row product-btn d-flex justify-content-end align-items-end">
                    <!-- Section Tittle -->
                    <div class="col-xl-4 col-lg-5 col-md-5">
                        <div class="section-tittle mb-30">
                            <h2>Latest Products</h2>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-7">
                        <div class="properties__button f-right">
                            <!--Nav Button  -->
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <!-- ==================== -->
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="#" href="index.php?do=all" role="tab"
                                     aria-controls="nav-home" aria-selected="true">All</a>

                                    <!-- ===================== -->
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="#"
                                        href="index.php?do=new" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">New</a>
                                    <!-- ============================= -->
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="#"
                                       href="index.php?do=featured" role="tab"
                                        aria-controls="nav-contact" aria-selected="false">Featured</a>
                                    <!-- ======================================= -->
                                    <a class="nav-item nav-link" id="offer nav-last-tab" data-toggle="#"
                                         href="index.php?do=offer" role="tab"
                                        aria-controls="nav-contact" aria-selected="false">Offer</a>
                                </div>
                            </nav>
                            <!--End Nav Button  -->
                        </div>
                    </div>
                </div>
                <!-- Nav Card -->
                <div class="tab-content" id="nav-tabContent">
                    <!-- card one -->
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                            <?php
                     foreach($thelatest as $item){
                        if(($do =='offer' && $item['offer']!=0) || ($do =='all') ||($do =='feature' && $item['featured']==0)||($do =='new'&& $item['Status']=='New')){

                    
                        ?>
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                        <img class="img-responsive"
                                            src="<?php echo $style_path; ?>img/categori/<?php echo $item['image'] ?>" width="200"
                                            height="200" alt="image of item">
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
     
                                            echo '<span class="edit-cog"><a href="items.php?do=edit&itemid='.$item['item_iD'].' ">';
                                             if(isset($_SESSION['username'])&&$_SESSION['ID']==2){
                                            echo '<i id="cogedit" class="fas fa-cog" ></i></a></span>';}
                                            //    ======================
                                            echo '<h4>'.$item['Name']."</br>".'</h4>'; 
                                            echo'<a id="details" href="single-product.php?do=details&itemid='.$item['item_iD'].'">Details</a>';
                                            ?>
                                         <div class="price">
                                <!-- button cart icon 'onclick' will to add item to cart -->
                                            <button onclick="ajax_add('managecart.php?do=insertCart',<?php echo $item['item_iD']; ?>)"><i class="fas fa-cart-plus"></i></button> 
                                            
                                            <ul>
                                                <?php
                                 // if item has offer will show price after ofer
                                                if($item['offer'] != 0 ){
                                                echo '<li> $'. $item['offer'].'</li>';
                                                echo '<li class="discount">';
                                               
                                            
                                            }else 
                                                echo '<li>';
                                                echo '$'. $item['Price'].'</li>';
                                               
                                         ?>
                                            </ul>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }}?>





        </section>
        <!--===Latest Products End =======-->


        <!--========== Best Product Start =========================-->
        <div class="best-product-area lf-padding">
            <div class="product-wrapper bg-height" style="background-image: url('<?php echo $style_path; ?>img/categori/card.png')">
                <div class="container position-relative">
                    <div class="row justify-content-between align-items-end">
                        <div class="product-man position-absolute  d-none d-lg-block">
                            <img src="<?php echo $style_path; ?>img/categori/card-man.png" alt="">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 d-none d-lg-block">
                            <div class="vertical-text">
                                <span>Manz</span>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">
                            <div class="best-product-caption">
                                <h2>Find The Best Product<br> from Our Shop</h2>
                                <p>Designers who are interesten creating state ofthe.</p>
                                <a href="index.php" class="black-btn">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shape -->
            <div class="shape bounce-animate d-none d-md-block">
                <img src="<?php echo $style_path; ?>img/categori/card-shape.png" alt="">
            </div>
        </div><!-- Best Product End-->

        <!--================= Best Collection Start ================================-->
        <div class="best-collection-area section-padding2">
            <div class="container">
                <div class="row d-flex justify-content-between align-items-end">
                    <!-- Left content -->
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="best-left-cap">
                            <h2>Best Collection of This Month</h2>
                            <p>Designers who are interesten crea.</p>
                            <a href="#" class="btn shop1-btn">Shop Now</a>
                        </div>
                        <div class="best-left-img mb-30 d-none d-sm-block">
                            <img src="<?php echo $style_path; ?>img/collection/collection1.png" alt="">
                        </div>
                    </div>
                    <!-- Mid Img -->
                    <div class="col-xl-2 col-lg-2 d-none d-lg-block">
                        <div class="best-mid-img mb-30 ">
                            <img src="<?php echo $style_path; ?>img/collection/collection2.png" alt="">
                        </div>
                    </div>
                    <!-- Riht Caption -->

                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <?php
                        $thelatest= get_latest('*','items','item_iD DESC',2); 
                        foreach($thelatest as $item){
                        ?>
                        <div class="best-right-cap ">
                            <div class="best-single mb-30">
                                <div class="single-cap">
                                    <h4><?php echo $item['Name']?></h4>
                                </div>
                                <div class="single-img">
                                    <img src="<?php echo $style_path; ?>img/categori/<?php echo $item['image'] ?>" width="80" height="150"
                                        alt="image of item">
                                </div>
                            </div>

                        </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div> <!-- Best Collection End -->

        <!--================== Latest Offers Start ================================-->
        <div class="latest-wrapper lf-padding">
            <div class="latest-area latest-height d-flex align-items-center"
                data-background="<?php echo $style_path; ?>img/collection/latest-offer.png">
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
        </div> <!-- Latest Offers End -->

        <!--=========== Shop Method Start===================================================-->
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
        </div><!-- Shop Method End-->

        <!--======== Gallery Start====================================================-->
        <div class="gallery-wrapper lf-padding">
            <div class="gallery-area">
                <div class="container-fluid">
                    <div class="row">
                        <?php
                        $thelatest= get_latest('*','items','item_iD DESC',5); 
                        foreach($thelatest as $item){
                        ?>
                        <div class="gallery-items">
                            <img src="<?php echo $style_path; ?>img/categori/<?php echo $item['image']  ?>" width="250" height="200"
                                alt="image of item">
                        </div>
                        <?php }?>
                    </div>

                </div>
            </div>
        </div><!-- Gallery End-->
    </main>
    <?php
          // path of files in folder template
    include_once '../includes/templates/footer.php'; ?>