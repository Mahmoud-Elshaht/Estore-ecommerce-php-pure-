<?php 
session_start();
 
$page_title ='PRODUCT LIST';
include_once 'init.php';
$do='';
$do=(isset($_GET['do']))?$_GET['do']:'#';
$stmt = $con -> prepare("SELECT Name FROM  categories ");
        $stmt->execute();
        $categoris = $stmt->fetchAll();


?>

<!-- slider Area Start-->
<div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="single-slider slider-height2 d-flex align-items-center" data-background="<?php echo $style_path; ?>img/hero/category.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>product list</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider Area End-->

<!-- product list part start-->
<section class="product_list section_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="product_sidebar">
                    <div class="single_sedebar">
                        <form action="#">
                            <input type="text" name="#" placeholder="Search keyword">
                            <i class="ti-search"></i>
                        </form>
                    </div>
                    <div class="single_sedebar">
                        <div class="select_option">
                            <div class="select_option_list">Category <i class="right fas fa-caret-down"></i> </div>
                            <?php foreach($categoris as $categori){?>
                            <div class="select_option_dropdown">
                                <li>
                                    <p><a href="#"></a><?php echo $categori['Name']; }?></p>
                                </li>

                            </div>

                        </div>
                    </div>
                    <div class="single_sedebar">
                        <div class="select_option">
                            <div class="select_option_list">Type <i class="right fas fa-caret-down"></i> </div>
                            <?php
                                 $stmt = $con -> prepare("SELECT type FROM  items ");
                                $stmt->execute();
                                $types = $stmt->fetchAll(); 
                                foreach($types as $type){
                            ?>
                            <div class="select_option_dropdown">
                                <li>
                                    <p><a href="#"><?php echo $type['type'];  } ?></a></p>
                                </li>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="product_list">
                    <div class="row">
                        <?php 
                            
                            if($do =='all'){
                                $stmt=$con->prepare("SELECT * FROM items ORDER BY item_iD  DESC ");
                                $stmt->execute();
                                $items=$stmt->fetchall();
                                foreach($items as $item){
                                ?>
                        <div class="col-lg-6 col-sm-6">
                            <div class="single_product_item">
                                <img src="<?php echo $style_path; ?>img/categori/<?php echo $item['image']  ?>" alt="" class="img-fluid">
                                <h3> <a href="single-product.php"><?php echo $item['Description'] ?></a> </h3>
                                <p><?php
                                if($item['offer']>0){
                                    echo'$ '. $item['offer'];
                                }else{
                                    echo'$ '. $item['Price'];
                                }
                                ;?></p>
                            </div>
                        </div>

                        <?php } }
                        else{
                            $thelatest= get_latest('*','items','item_iD DESC',4); 
                            
                            foreach($thelatest as $last){ ?>
                        <div class="col-lg-6 col-sm-6">
                            <div class="single_product_item">
                                <img height="150" width="400" src="<?php echo $style_path; ?>img/categori/<?php echo $last['image']  ?>" alt="imag of item" class="img-fluid img-responsive">

                                <h3> <a href="single-product.php"><?php echo $last['Description'] ?></a> </h3>
                                <p><?php 
                                     if($last['offer']>0){
                                                    echo '$ '.$last['offer'];

                                     }else{
                                            echo '$ '.$last['Price'];
                                     }
                                    ?></p>
                            </div>
                        </div>


                        <?php  } }?>

                    </div>
                    <div class="load_more_btn text-center">
                        <a href="product_list.php?do=all" class="btn_3">Load More</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product list part end-->

<!-- client review part here -->
<section class="client_review">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="client_review_slider owl-carousel">
                    <?php  
                        $stmt = $con -> prepare("SELECT * FROM  userdata ");
                        $stmt->execute();
                        $users=$stmt->fetchAll();
                        foreach($users as $user){
                        
                        ?>

                    <div class="single_client_review">
                        <div class="client_img">
                            <img src="<?php echo $style_path; ?>img/client_1.png" alt="#">
                        </div>
                        <p><?php echo $user['user_brief']; ?></p>
                        <h5><?php echo $user['FullName']; ?></h5>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- client review part end -->

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

<!-- subscribe part here -->
<section class="subscribe_part section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="subscribe_part_content">
                    <h2>Get promotions & updates!</h2>
                    <p>Seamlessly empower fully researched growth strategies and interoperable internal or “organic”
                        sources credibly innovate granular internal .</p>
                <!-- to show chek icon after subscrib -->
                    <h2 id="msg" class="text-center"><i class="fas fa-check"></i></h2>
                    <form id="email" action="#" method="post">
                        <div class="subscribe_form">
                            <input type="email" name="mail" placeholder="Enter your mail" required="required">
                            <button class="btn_1" onClick=" ajax_insert('members.php?do=mail','#email')" > Subscribe </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- subscribe part end -->

<?php include_once '../includes/templates/footer.php'; ?>