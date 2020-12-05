<?php
$header='';
ob_start();
include_once 'init.php'; 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo '<h1 class="text-center"> Insert Member</h1>';
       
        $user  =$_POST['fullName'];
        $email =$_POST['emailAddress'];
        $name  =$_POST['city'];
        $pass  =$_POST['country'];
        // $hashpass=sha1($_POST['password']);
        // <== check if failed is empty will echo erroe ==>
        $formerores=array();
        if(empty($user)){
            $formerores[]='user name cant by <strong> empty </strong> ';
        }

        if(empty($email)){
            $formerores[]=' email cant by<strong>empty </strong>';
        }

        if(empty($name)){
            $formerores[]=' full name cant by <strong> empty</strong> ';
        }
        if(empty($pass)){
            $formerores[]=' password cant by <strong> empty</strong> ';
        }
        // <== if faild empty will echo error ==>
        foreach($formerores as $eror){

            echo '<div class="alert alert-danger">'.$eror;}

         // <=== check if no eror will updat data ===>

        if(empty($formerores)){
            /* if userName is already Not registered will echo this massage and  redirect user to Inser page*/
            $value=$user;
            $check = check_item('UserName','userdata',$value);

            if($check==0){
                $stmt=$con->prepare("INSERT INTO userdata(UserName, UserEmail, FullName,LoginPassword,RegStatus,RegDate ) VALUES(:zuser,:zemail,:zname,:zpass,1,now())");
            
                $stmt->bindParam(':zuser',$user);
                $stmt->bindParam(':zemail',$email);
                $stmt->bindParam(':zname',$name);
                $stmt->bindParam(':zpass',$pass);
                $stmt->execute();
      
                $msg = '<h3 div  class="text-center alert alert-success">Insert Data 
                SUCCESSFUL </h3>';
            
                redirect_home($msg,"members.php",4);

        }else{
//if userName is already registered will echo this massage and redirect user to home page
            $msg = '<h3 div  class="text-center alert alert-danger"> Username is already registered Please enter another name </h3>';;
            redirect_home($msg,'members.php',6);
        }

        }   
   }else{
        $msg ="<div class='alert alert-danger text-center'> You Should Signin To Browse This Page <div>";
        redirect_home($msg);
   }

   include_once '../includes/templates/footer.php';
?>

