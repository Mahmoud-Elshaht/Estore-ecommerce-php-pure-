<?php
ob_start();
session_start();
$page_title='manageCart';
include 'init.php';
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    $do='';
    $do=(isset($_GET['do']))?$_GET['do']:'manage';

// <==================================================================================>
    //   Start insertCart Page
// <==================================================================================>
if($do =='insertCart'){//insert items to user cart
    echo '<h1 class="text-center">insert Cart </h1>'; 
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
         $itemId='';
        //  $count=$_POST['count'];
        //  echo $count;
       if(isset($_POST['del_id'])){$itemId=$_POST['del_id'];} ;
            $stmt=$con->prepare(" SELECT * FROM items where item_iD =? ")  ;                            
            $stmt->execute(array($itemId));
            $items=$stmt->fetchAll();
        foreach($items as $item){
            $zname      =$item['Name'];
            $zprice     =$item['Price'];
            $zoffer     =$item['offer'];
            $zimg       =$item['image'];
            $userId     =$_SESSION['ID'];
            $productID  =$itemId;
   
            $query=$con->prepare("INSERT INTO cartlist(ProductName,product_Price,Productoffer,image,user_id,Product_id ) values(:zname ,:zprice ,:zoffer,:zimg ,:zmember_iD,:zProduct_id)");

                $query->bindparam(':zname',$zname);
                $query->bindparam(':zprice',$zprice);
                $query->bindparam(':zoffer',$zoffer);
                $query->bindparam(':zimg',$zimg); 
                $query->bindparam(':zmember_iD',$userId); 
                $query->bindparam(':zProduct_id',$productID); 
                $query->execute();
            echo"sucess insert";
            // header('Location: ' . $_SERVER['HTTP_REFERER']);
}}}//end insert cart
// <==================================================================================>
    //   Start deleteFromCart Page
// <==================================================================================>    
elseif($do=='deleteFromCart'){ //delete item from user cart 
    echo '<h1 class="text-center">insertCart </h1>';
    if(isset($_POST['del_id']) && !empty($_POST['del_id']) && is_numeric($_POST['del_id'])){
        $itemId=$_POST['del_id']; //$_POST['itemid']
        $stmt=$con->prepare("DELETE FROM cartlist WHERE ID =? ");
        $stmt->execute(array($itemId));
        header('Location: ' . $_SERVER['HTTP_REFERER']);

}}//end deleteFromCart
}//end of parent if 
else{
    $msg = '<h5 div  class="text-center alert alert-danger">Cant Brows  this page direct , Pleas Signin </h5>';
            
    redirect_home($msg,"index.php",5);
}
include_once '../includes/templates/footer.php';
?>
