<?php 
ob_start();
session_start();

$page_title ='CART';
include_once 'init.php';
if(isset($_SESSION['username'])){//if user log in will show cart page 
  $user_id=$_SESSION['ID']; 
?>

<!-- slider Area Start-->
<div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="single-slider slider-height2 d-flex align-items-center" data-background="<?php echo $style_path; ?>img/hero/category.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Cart List</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider Area End-->

<!--================Cart Area =================-->
<section class="cart_area section_padding">
    <?php 
     $userId=$_SESSION['ID'];
     $stmt=$con->prepare(" SELECT * FROM cartlist where user_id=? ")  ;                            
     $stmt->execute(array($userId));
     $items=$stmt->fetchAll();
    
    ?>
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php  foreach($items as $item){ ?>
                        <tr id="delete<?php echo $item['ID']?>">
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="<?php echo $style_path; ?>img/categori/<?php echo $item['image'] ?>" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <p><?php echo $item['ProductName'] ?></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5><?php // Price 
                    if($item['Productoffer']>0){
                        echo $item['Productoffer'];
                       }else{
                        echo $item['product_Price'];
                       }
                  
                  ?></h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    <!-- quantity  -->
                                    <span class="input-number-decrement"> <i class="ti-minus"></i></span>
                                    <input class="input-number" type="text" value="<?php echo $item['Quantity']; ?>"
                                        min="0" max="10">
                                    <span class="input-number-increment"> <i class="ti-plus"></i></span>
                                </div>
                            </td>
                            <td>
                                <h5><?php 
  // sum values of clumns('Productoffer' * 'Quantity') for show subtotal price 
                         $subtotal=0;
                        if ($item['Productoffer'] > 0 && $item['Quantity']>0){       
                                $subtotal+=$item['Productoffer'] * $item['Quantity'];
                        }elseif($item['Productoffer']>0){
                          $subtotal+=$item['Productoffer'];
                        }elseif($item['Quantity']>0){
                          $subtotal+=$item['product_Price'] * $item['Quantity'];
                        }elseif ($item['Productoffer'] == 0 && $item['Quantity']>0){       
                            $subtotal+=$item['product_Price'] * $item['Quantity'];
                    }else{
                        $subtotal+=$item['product_Price'];
                    }
                           echo '$ '.$subtotal;
                  
                                        
             
                  ?></h5>
                            </td> <!-- delete icon  -->
                            <td>
                                <button
                                    onclick="ajax_del('managecart.php?do=deleteFromCart',<?php echo $item['ID'];?>,'#parent')"><i
                                        class="far fa-trash-alt fa-2x btn-danger"></i></button>
                            </td>
                            <?php }?>
                        <tr class="bottom_button">
                            <td>
                                <a class="btn_1" href="#">Update Cart</a>
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                <!-- =================== -->
                                <div class="cupon_text float-right">
                                    <a class="btn_1" href="#">Close Coupon</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5> <?php
                  static $subtotal=0;
                  foreach($items as $item){
                  
                      if ($item['Productoffer'] > 0 && $item['Quantity']>0){       
                            $subtotal+=$item['Productoffer'] * $item['Quantity'];
                      }elseif($item['Productoffer'] > 0){
                                  $subtotal+=$item['Productoffer'];
                      }elseif($item['Quantity'] > 0){
                                  $subtotal+=$item['product_Price'] * $item['Quantity'];
                      }else{
                                  $subtotal+=$item['product_Price'];
                      }
                            
                  }
                  if($subtotal > 0){
                        echo'$'.$subtotal; 
                  }else{
                    echo '$0.00';
                  }     
            
              ?></h5>
                            </td>
                        </tr>
                        <tr class="shipping_area">
                            <td></td>
                            <td></td>
                            <td>
                                <h5>Shipping</h5>
                            </td>
                            <td>
                                <div class="shipping_box">
                                    <ul class="list">
                                        <li>
                                            Flat Rate: $5.00
                                            <input type="radio" aria-label="Radio button for following text input">
                                        </li>
                                        <li>
                                            Free Shipping
                                            <input type="radio" aria-label="Radio button for following text input">
                                        </li>
                                        <li>
                                            Flat Rate: $10.00
                                            <input type="radio" aria-label="Radio button for following text input">
                                        </li>
                                        <li class="active">
                                            Local Delivery: $2.00
                                            <input type="radio" aria-label="Radio button for following text input">
                                        </li>
                                    </ul>
                                    <h6>
                                        Calculate Shipping
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </h6>
                                    <select class="shipping_select">
                                        <option value="1">Bangladesh</option>
                                        <option value="2">India</option>
                                        <option value="4">Pakistan</option>
                                    </select>
                                    <select class="shipping_select section_bg">
                                        <option value="1">Select a State</option>
                                        <option value="2">Select a State</option>
                                        <option value="4">Select a State</option>
                                    </select>
                                    <input class="post_code" type="text" placeholder="Postcode/Zipcode" />
                                    <a class="btn_1" href="#">Update Details</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="checkout_btn_inner float-right">
                    <a class="btn_1" href="#">Continue Shopping</a>
                    <a class="btn_1 checkout_btn_1" href="#">Proceed to checkout</a>
                </div>
            </div>
        </div>
</section>
<!--================End Cart Area =================-->

<?php 
   }else{// if user not login will show this massege and  redirect to home page 
    $msg='<h3 div  class="text-center alert alert-danger"> Can\'t browse this page direct,<strong> Please login </strong>  </h3>';
    redirect_home($msg,"index.php",3);
   }
   include_once '../includes/templates/footer.php';
  ?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="ajax-script.js"></script> -->