<?php 
session_start();
 
$page_title ='SINGLE PRODUCT';
include_once 'init.php';
$do='';
$do=(isset($_GET['do']))?$_GET['do']:'#';
if($do =='details'){
   $itemId=''; 
  if(isset($_GET['itemid'])){ $itemId = $_GET['itemid'];} 
    $stmt=$con->prepare(" SELECT * FROM items WHERE item_iD = ? limit 1");                     
  $stmt->execute(array($itemId));
  $items=$stmt->fetchAll();
  foreach($items as $item){ 
?>

  <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="assets/img/hero/category.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>product Details</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

  <!--================Single Product Area =================-->
  <div class="product_image_area">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="product_img_slide owl-carousel">

            <div class="single_product_img">
              <img src="assets/img/categori/<?php echo $item['image']; ?>" alt="#" class="img-fluid">
            </div>
           
          </div>
        </div>
        <div class="col-lg-8">
        
          <div class="single_product_text text-center">
            <h3><?php echo $item['Name']; ?></h3>
            <p>  <?php echo $item['Description']; ?> </p>
            <div class="card_area">
             
                <div class="product_count_area"> 
                  <form class="form-horizontal" action="items.php?do=insertCart"     method='POST'>
                    <p>Quantity</p>
                    <div class="product_count d-inline-block">
                        <span class="product_count_item inumber-decrement"> <i class="ti-minus"></i></span>
                        
                        <input class="product_count_item input-number form-control"   type="text" name="count" value="1" min="0" max="10">
                      
                        <span class="product_count_item number-increment"> <i class="ti-plus"></i></span>
                    </div>
                    <?php if($item['offer']==0){?>
                    
                    <p><?php 
                                echo $item['Price'];
                          }else{
                              echo '<div class="price">'.'$ '.$item['offer'].'</div>';
                        } ?>
                    </p>
                  
                 </div>
                 <div id="delete <?php echo $item['ID']?>" class="add_to_cart">
                  <!-- to show reight after item insert to cart -->
                    <h2 class="text-center msg"><i class="fas fa-check"></i></h2>
                    <!-- to show erroe massage if item failed to add to cart-->
                    <h2 class="eror text-center"> ErrorوPlease try later </h2>
                     <!-- button 'add to cart' on event 'onclick' will add item to cart by ajax  -->
                    <a onclick="ajax_add('managecart.php?do=insertCart',<?php echo $item['item_iD']; ?>);disableScroll()" href="#" class="btn_3"> <i class="fas fa-cart-plus fa-2x"></i> Add to cart</a>
                 </div> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--================End Single Product Area =================-->
   <!-- subscribe part here -->
   <section class="subscribe_part section_padding">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-8">
             
                  <div class="subscribe_part_content">
                      <h2>Get promotions & updates!</h2>
                      <p>Seamlessly empower fully researched growth strategies and interoperable internal or “organic” sources credibly innovate granular internal .</p>
                      <form action="members.php?do=mail" method="post">
                            <div class="subscribe_form" >
                                <input  type="email" name="mail" placeholder="Enter your mail" required="required">
                                <button class="btn_1"> Subscribe </button>
                            </div>
                        </form>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- subscribe part end -->
  
  <?php include_once $folder.'footer.php'; 
}
}?>

  
  