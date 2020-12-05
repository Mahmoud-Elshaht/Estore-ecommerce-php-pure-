<?php 
ob_start();
session_start();
$page_title ='CONFIRMATION';
include_once 'init.php';
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
static $subtotal=0;//to sum total price 

$user_id=$_SESSION['ID'];
// statment for select all data from table orderinfo
$sql=$con->prepare("SELECT * FROM orderinfo where user_id =? ");
  $sql->execute(array($user_id));
  $rows=$sql->fetchAll();
 
  // statment for select all data from table cartlist 
  $sql=$con->prepare("SELECT * FROM cartlist where user_id =? ");
              $sql->execute(array($user_id));
              $carts=$sql->fetchAll();
 
  foreach($rows as $row){
    // to generat random order code (any number +current time of order - any number)
    $ordercode=166+str_replace(str_split('-: +'),'7', $row['date'])-149;

?>

    <!-- slider Area Start-->
    <div class="slider-area ">
      <!-- Mobile Menu -->
      <div class="single-slider slider-height2 d-flex align-items-center" data-background="<?php echo $style_path; ?>img/hero/category.jpg">
          <div class="container">
              <div class="row">
                  <div class="col-xl-12">
                      <div class="hero-cap text-center">
                          <h2>Confirmation</h2>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- slider Area End-->

  <!--================ confirmation part start =================-->
  <section class="confirmation_part section_padding">
  
    <div class="container">
   
      <div class="row">
        <div class="col-lg-12">
          <div class="confirmation_tittle">
            <span>Thank you. Your order has been received.</span>
          </div>
        </div>
       
        <div class="col-lg-6 col-lx-4">
          <div class="single_confirmation_details">
            <h4>order info</h4>
            <ul>
              <li>
              <!-- str_replace(str_split('\\/:*?"<>|'), ' ', $string); -->
                <p>order number</p><span>: <?php echo $ordercode ; ?></span>
              </li>
              <li>
                <p>date</p><span>: <?php echo $row['date']; ?></span>
              </li>
              <li>
                <p>total</p><span>: USD 
       
              <?php 
              
  // sum values of clumns('Productoffer' * 'Quantity') for show subtotal price 
                    foreach($carts as $cart){
                              
                      if($cart['Productoffer'] > 0 && $cart['Quantity']>0 ){
                        $subtotal+=  $cart['Productoffer'] * $cart['Quantity'];
                      }elseif($cart['Productoffer'] == 0 && $cart['Quantity']>0 ){
                        $subtotal+= $cart['product_Price'] * $cart['Quantity'];
                      }elseif($cart['Productoffer'] > 0 && $cart['Quantity']==0 ){
                        $subtotal+= $cart['Productoffer'];
                      }else{
                        $subtotal+= $cart['product_Price'];
                      }
                    
                  }
                  echo $subtotal;        
                  
                                        
              ?>
              </span>
              </li>
              <li>
                <p>Payment methord</p><span>: Check payments</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-lx-4">
          <div class="single_confirmation_details">
            <h4>Billing Address</h4>
            <ul>
              <li>
                <p>Street</p><span>: <?php echo $row['addressLine1']; ?></span>
              </li>
              <li>
                <p>city</p><span>: <?php echo $row['city']; ?></span>
              </li>
              <li>
                <p>country</p><span>: <?php echo $row['country']; ?></span>
              </li>
              <li>
                <p>postcode</p><span>: <?php echo $row['postcode']; ?></span>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-lx-4">
          <div class="single_confirmation_details">
            <h4>shipping Address</h4>
            <ul>
              <li>
                <p>Street</p><span>: <?php echo $row['addressLine1']; ?></span>
              </li>
              <li>
                <p>city</p><span>: <?php echo $row['city']; ?></span>
              </li>
              <li>
                <p>country</p><span>: <?php echo $row['country']; ?></span>
              </li>
              <li>
                <p>postcode</p><span>: <?php echo $row['postcode']; ?></span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
         
          <div class="order_details_iner">
            
           
            <h3>Order Details</h3>
           
            <table class="table table-borderless">
            
              <thead>
                <tr>
                  <th scope="col" colspan="2">Product</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Price</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <?php   
              
         
                 foreach($carts as $cart){?> 
              <tbody>
                <tr>
                 <!-- show all pruducts name in cartlist -->
                  <th colspan="2"><span><?php echo $cart['ProductName'];  ?></span></th>
                 <!-- show all Quantity of items in cartlist -->
                  <th><?php echo $cart['Quantity'];?></th>
    <!-- check if product have sale will show < price >after sale else will show price  -->
                  <th><!--Price --><?php if($cart['Productoffer']>0){
                      echo  $cart['Productoffer'];
                    }else{
                      echo  $cart['product_Price'];
                    }?></th>  
<!-- check if product have sale will show < total price > after sale (Productoffer * Quantity )else will show totaltprice by (cruntprice * Quantity) -->
                  <th> <span> <!--total -->
                  <?php 
                  if($cart['Productoffer'] > 0 && $cart['Quantity']>0 ){
                      echo  $cart['Productoffer'] * $cart['Quantity'];
                    }elseif($cart['Productoffer'] == 0 && $cart['Quantity']>0 ){
                      echo  $cart['product_Price'] * $cart['Quantity'];
                    }elseif($cart['Productoffer'] > 0 && $cart['Quantity']==0 ){
                      echo $cart['Productoffer'];
                    }else{
                      echo  $cart['product_Price'];
                    }
                    ?>
                  </span></th>
                </tr> 
                <?php }?>
                <tr>
                  <th colspan="3">Subtotal</th>
                  <th> <span> </span> </th>  
<!-- check if product have sale will show Subtotal after sale else will show Subtotal by current Price -->
                  <th><span>$<!--Subtotal --><?php 
                  echo $subtotal;
                  ?></span></th>
                </tr>
                <tr>
                  <th colspan="3">shipping</th>
                  <th><span> </span></th>
                  <th><span>flat rate: $50.00</span></th>
                </tr>
              </tbody>
             
              <tfoot>
                <tr>

                  <th scope="col" colspan="8">Quantity : 
                  <?php
        // show sum of values of column "Quantity" in table  cartlist from database
                   $stmt=$con->prepare("SELECT  SUM(Quantity) As Quantity_sum FROM cartlist where user_id=?");
                            $stmt->execute(array($user_id));
                            $row=$stmt->fetch(PDO::FETCH_ASSOC);
                       echo  $row['Quantity_sum'] ;
                           
                  ?>
                  </th>
                  <!-- show sum total of price in cartlist + $ 50 flate rate-->
                  <th scope="col" >Total : $ <?php echo 50 + $subtotal;?></th>
                  </tr>
              </tfoot>
              
            </table>
           
          </div>
                
        </div>
        
      </div>
     
    </div>
    
  </section>
  <!--================ confirmation part end =================-->

  
  <?php
   include_once '../includes/templates/footer.php';
    }// foreach End
}
    ?>