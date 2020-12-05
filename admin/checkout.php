<?php 
session_start();

$page_title ='CHECKOUT';
include_once 'init.php';
$user_id=$_SESSION['ID'];
$sql=$con->prepare("SELECT * FROM cartlist where user_id =? ");
  $sql->execute(array($user_id));
  $rows=$sql->fetchAll();
 
  foreach($rows as $row){
?>



<!-- slider Area Start-->
<div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="single-slider slider-height2 d-flex align-items-center" data-background="<?php echo $style_path; ?>img/hero/category.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider Area End-->

<!--================Checkout Area =================-->
<section class="checkout_area section_padding">
    <div class="container">
        <?php if(empty($_SESSION['username'])){ ?>
        <div class="returning_customer">
            <p>
                If you have shopped with us before, please enter your details in the
                boxes below. If you are a new customer, please proceed to the
                Billing & Shipping section.
            </p>
            <p>Please Login To Billing Details </p>
            <form class="row contact_form" action="login.php" method="post" novalidate="novalidate">
                <div class="col-md-6 form-group p_star">
                    <input type="text" class="form-control" id="name" name="name" requered="required" />
                    <span class="placeholder" data-placeholder="Username"></span>
                </div>
                <div class="col-md-6 form-group p_star">
                    <input type="password" class="form-control" id="password" name="password" requered="required" />
                    <span class="placeholder" data-placeholder="Password"></span>
                </div>
                <div class="col-md-12 form-group">
                    <button type="submit" value="submit" class="btn_3">
                        log in
                    </button>

                    <div class="creat_account">
                        <input type="checkbox" id="f-option" name="selector" />
                        <label for="f-option">Remember me</label>
                    </div>
                    <a class="lost_pass" href="#">Lost your password?</a>
                </div>
            </form>
        </div>
        <div class="cupon_area">

            <?php }

     if(!empty($_SESSION['username'])){ 

    
    ?>

            <!-- =================/ -->
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Billing Details</h3>
                        <form id="order" class="row contact_form" action="#" method="post"
                            novalidate="novalidate">
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="first" name="name" required="required" />
                                <span class="placeholder" data-placeholder="First name"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="last" name="lastname" required="required" />
                                <span class="placeholder" data-placeholder="Last name"></span>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="company" name="company"
                                    placeholder="Company name" />
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="number" name="phone" required="required" />
                                <span class="placeholder" data-placeholder="Phone number"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="email" name="companyemail"
                                    required="required" />
                                <span class="placeholder" data-placeholder="Email Address"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="country_select" class="form-control" name="country"
                                    required="required" />
                                <span class="placeholder" data-placeholder="Country"></span>

                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add1" name="add1" required="required" />
                                <span class="placeholder" data-placeholder="Address line 01"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add2" name="add2" required="required" />
                                <span class="placeholder" data-placeholder="Address line 02"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="city" name="city" required="required" />
                                <span class="placeholder" data-placeholder="Town/City"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="country_select" class="form-control" name="district"
                                    required="required" />
                                <span class="placeholder" data-placeholder="District"></span>

                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="zip" name="zip"
                                    placeholder="Postcode/ZIP" />
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <input type="checkbox" id="f-option2" name="selector" />
                                    <label for="f-option2">Create an account?</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <h3>Shipping Details</h3>
                                    <input type="checkbox" id="f-option3" name="selector" />
                                    <label for="f-option3">Ship to a different address?</label>
                                </div>
                                <textarea class="form-control" name="message" id="message" rows="1"
                                    placeholder="Order Notes"></textarea>
                                    <h2 id="msg" class="text-center"><i class="fas fa-check"></i></h2>
                                    <button onclick="ajax_insert('members.php?do=order','#order')" type="submit" value="submit" name="submit " class="btn_3">
                                Submit </button>
                            </div>

                           
                        </form>
                    </div>
                    <!-- =================== -->
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li>
                                    <a href="">Product
                                        <span> Total</span>
                                    </a>
                                    
                                </li>
                                
                                <li>
                                    <?php
                    foreach($rows as $row){
                  ?>
                                    <a href="#"><?php echo $row['ProductName']; ?>
                                        
                                        <span class="last">
                                            $<?php
                                            $subtotal=0;
                                            if ($row['Productoffer'] > 0 && $row['Quantity']>0){       
                                                    $subtotal+=$row['Productoffer'] * $row['Quantity'];
                                            }elseif($row['Productoffer']>0){
                                              $subtotal+=$row['Productoffer'];
                                            }elseif($row['Quantity']>0){
                                              $subtotal+=$row['product_Price'] * $row['Quantity'];
                                            }elseif ($row['Productoffer'] == 0 && $row['Quantity']>0){       
                                                $subtotal+=$row['product_Price'] * $row['Quantity'];
                                            }else{
                                            $subtotal+=$row['product_Price'];
                                            }
                                              echo $subtotal;

                      }


                  //  $stmt=$con->prepare("SELECT  SUM(Productoffer) As value_sum FROM cartlist where user_id=?");
                  //           $stmt->execute(array($user_id));
                  //           $count=$stmt->fetch(PDO::FETCH_ASSOC);
                  //      echo  $count['value_sum'] ;
                           
                  ?></span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="list list_2">
                                <li>
                                    <a href="#">Subtotal
                                        <span>$ <?php 
                   static $subtotal=0;
                   foreach($rows as $row){
                   
                       if ($row['Productoffer'] > 0 && $row['Quantity']>0){       
                             $subtotal+=$row['Productoffer'] * $row['Quantity'];
                       }elseif($row['Productoffer'] > 0){
                                   $subtotal+=$row['Productoffer'];
                       }elseif($row['Quantity'] > 0){
                                   $subtotal+=$row['product_Price'] * $row['Quantity'];
                       }else{
                                   $subtotal+=$row['product_Price'];
                       }
                             
                   }
                   if($subtotal > 0){
                         echo $subtotal; 
                   }else{
                     echo '$0.00';
                   }     ?>
                       </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Shipping
                                        <span>Flat rate: $50.00</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Total
                                        <span> $ <?php if($subtotal > 0){
                         echo 50 + $subtotal ; 
                   }else{
                     echo '$0.00';
                   }   ?></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option5" name="selector" />
                                    <label for="f-option5">Check payments</label>
                                    <div class="check"></div>
                                </div>
                                <p>
                                    Please send a check to Store Name, Store Street, Store Town,
                                    Store State / County, Store Postcode.
                                </p>
                            </div>
                            <div class="payment_item active">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option6" name="selector" />
                                    <label for="f-option6">Paypal </label>
                                    <img src="img/product/single-product/card.jpg" alt="" />
                                    <div class="check"></div>
                                </div>
                                <p>
                                    Please send a check to Store Name, Store Street, Store Town,
                                    Store State / County, Store Postcode.
                                </p>
                            </div>
                            <div class="creat_account">
                                <input type="checkbox" id="f-option4" name="selector" />
                                <label for="f-option4">I’ve read and accept the </label>
                                <a href="#">terms & conditions*</a>
                            </div>
                            <a class="btn_3" href="#">Proceed to Paypal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!--================End Checkout Area =================-->


<?php include_once '../includes/templates/footer.php'; }}?>