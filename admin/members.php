<?php
ob_start();
session_start();
$page_title='MEMBERS';

include_once 'init.php'; 


    $do = isset($_GET['do']) ? $_GET['do']:'manage';
    // <======================================================================>
       // <===start manage member page ====>
    // <=========================================================================>
    if($do == 'manage'){
        if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
        $query='';
        if(isset($_GET['page']) && $_GET['page']=='pending'){
            $query='AND RegSTATUS=0';
        }
        //statment to show users in manage member page without Principal responsible  
        $stmt=$con->prepare("SELECT * FROM userdata WHERE adminId != 1 $query");
        $stmt->execute();
        $rows=$stmt->fetchall();
        
        
        ?>
    
        <h1 class="text-center"> Manage MEMBERS</h1>
        <!-- <h3 id="msg" class="text-center alert alert-danger" style="display:none;">Delete Data SUCCESSFUL </h3> -->
        <!-- <div  style="display:none;">  </div> -->
            <div class="container manage">
                <div class="table-responsive">
                    <table class="table text-center table-bordered">
                        <thead>
                            <tr >
                                <td>#id</td>
                                <td>UserName</td>
                                <td>Email</td>
                                <td>FullName</td>
                                <td>Register Date</td>
                                <?php 
                                if(isset($_SESSION['username'])&&$row['adminId']==2){?>
                                <td>admin_id</td>
                                <?php }?>
                            
                            </tr>
                        </thead>
                   
                        <?php
                        foreach($rows as $row){
                            echo"<tr>";
                                echo "<td>" . $row['id'] ."</td>";
                                echo "<td>" . $row['UserName'] ."</td>";
                                echo "<td>" . $row['UserEmail'] ."</td>";
                                echo "<td>" . $row['FullName'] ."</td>";
                                echo "<td>" . $row['RegDate'] ."</td>";
                                echo  "<td>" .$row['adminId'] ."</td>";
                                echo "<td> </td>";
                                echo "<td class='btn-con'>
                                        <a href='members.php?do=edit&userid=".$row['id']."'   class='btn btn-success edit'><i class='fa fa-edit'></i>Edit</a>";?>
                <!-- // ==================================== -->
                                 <a href="#" onClick="ajax_del('members.php?do=delete',<?php echo $row["id"] ?>)"  class="btn btn-danger confirm"> <i class="fa fa-times"></i>Delete</a>
                                 <?php
                                 //======================================================
                //                  echo  '<a class="delete btn btn-danger confirm" href="#" id="'.$row["id"].'"><i class="fas fa-times"></i>delete</a>';
                // //======================================================

                                        if($row['RegStatus']==0){?>
                                          <h2 id="activat" class="text-center msg"><i class="fas fa-check"></i></h2>
                                          <a onClick='ajax_add("members.php?do=activate",<?php echo $row["id"] ?>)' href='#' class='btn btn-danger activ'> <i class='fas fa-check'></i>Activate</a>
                                       <?php  } ?>
                                       
                                        
                                  </td>

                               
                            </tr>
                      <?php  } ?>

                       
                       
                     </tr>
                    </table>
                </div>
                <a  echo href="members.php?do=add"  class="btn btn-primary"><i class="fa fa-plus"></i>Add New Member</a>
                </div>
        
                <?php
    }}//<== End Manage Page
    // <=============================================================================>
        ////<== start ADD  page ==>
    // <==============================================================================>
    elseif($do =='add'){
        
        ?>
     
     <!-- <h3 id="msg" class="msg text-center alert alert-success">Inesrt Data SUCCESSFUL </h3>
     <h3 id="eror" class="eror text-center alert alert-danger"> userName is exist Please,Insert New userName  </h3> -->
     <form id="add_member" class="form-horizontal" action="#" method='POST' enctype="multipart/form-data">
                
            <!-- start user name faild  -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">username</label>
                        <div class="col-sm-10">
                            <input type="text"  name="username"  class="form-control" autocomplete="off" required="required"/>
                        </div>
                
            </div>
           

            <!-- start password faild  -->
            <div class="form-group">
                    <label class="col-sm-2 control-label">password</label>
                        <div class="col-sm-10">
                            <input type="password"  name="password" class="form-control" autocomplete="new-password" required="required"/>
                         </div>

            </div> <!-- END password faild  -->
            
            <!-- start email faild  -->
            <div class="form-group">
                    <label class="col-sm-2 control-label">email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" required/>
                         </div>
            </div> <!-- END email faild  -->
           
            <!-- start fullname faild  -->
            <div class="form-group">
                    <label class="col-sm-2 control-label">fullName</label>
                        <div class="col-sm-10">
                            <input type="text" name="full" class="form-control" required="required"/>
                         </div>
            </div><!-- END fullname faild  -->
            
            <!-- start user name faild  -->
            <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                             <h2 id="msg" class="text-center"><i class="fas fa-check"></i></h2>

                            <button onClick="ajax_insert('members.php?do=insert','#add_member')" class="btn btn-primary btn-lg" />Add
                            Item</button>
                        </div>
            </div>
            <!-- ========================== -->
        </form> 
        
    <?php
    } // <== End ADD page ==> 
    // <============================================================================>
        // <== Start Insert Page ==>
    // <===============================================================================>
    elseif($do=='insert'){  
         //To prevent the emergence of 'header' 
         echo'<div id="msg" style="display:none;"> It insert </div>';
       if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo '<h1 class="text-center"> Insert Member</h1>';
            $user  =$_POST['username'];
            $email =$_POST['email'];
            $name  =$_POST['full'];
            $pass  =$_POST['password'];
            $hashpass=sha1($_POST['password']);
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
                    $stmt=$con->prepare("INSERT INTO userdata(UserName, UserEmail, FullName,LoginPassword,RegDate ) VALUES(:zuser,:zemail,:zname,:zpass,now())");
                
                    $stmt->bindParam(':zuser',$user);
                    $stmt->bindParam(':zemail',$email);
                    $stmt->bindParam(':zname',$name);
                    $stmt->bindParam(':zpass',$hashpass);
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
            redirect_home($msg,'members.php',6);
       }
    
    }//<== END INSERT PAGE ==>
    // <=================================================================================>
    //    <== START Edit Page ===>
    // <==================================================================================>
   elseif($do == 'edit'){
     if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0 ;
        $stmt = $con -> prepare("SELECT * FROM  userdata WHERE   id=?   LIMIT 1 ");
        $stmt->execute(array($userid));
        $row=$stmt->fetch();
        $count=$stmt->rowcount();
         

        if($count > 0){?>
        <h1 class="text-center"> Edit-Profile</h1> 
        
            <div class="container">
                <form id="member_edit" class="form-horizontal" action="#" method='post' enctype="multipart/form-data">
                <input type="hidden" name="userid" value="<?php echo $userid ?>"
            <!-- start user name faild  -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" value="<?php  echo $row['UserName'] ?>"class="form-control" autocomplete="off" required="required"/>
                </div>
            </div><!-- END user name faild  -->
            
            <!-- start password faild  -->
            <div class="form-group">
                    <label class="col-sm-2 control-label">password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" autocomplete="new-password" placeholder=" New Password - Optional"/>
                </div>
            </div><!-- END password faild  -->
            
            <!-- start email faild  -->
            <div class="form-group">
                    <label class="col-sm-2 control-label">email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" value="<?php  echo $row['UserEmail']  ?>" class="form-control" required="required" autocomplete="off"/>
                </div>
            </div><!-- END email faild  -->
            
            <!-- start fullname faild  -->
            <div class="form-group">
                    <label class="col-sm-2 control-label">fullName</label>
                        <div class="col-sm-10">
                            <input type="text" name="full" value="<?php  echo $row['FullName']  ?>" class="form-control" required="required"/>
                </div>
            </div><!-- END fullname faild  -->
            
            <!-- start user name faild  -->
            <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                        <h2 id="msg" class="text-center"><i class="fas fa-check"></i></h2>

                        <button onClick="ajax_insert('members.php?do=update','#member_edit')" class="btn btn-primary btn-lg" />Save</button>
                </div>
            </div> <!-- END user name faild  -->
           
    <?php } else{ $msg = "<div class='text-center alert alert-danger'> You Should Signin To Browse This Page<div>";
           redirect_home($msg,'members.php');}
    }} //<== End Edit Page ===>
    // <==============================================================================>
        // <== Start Update Page Member ==>
    //<===============================================================================>
   elseif($do == 'update'){
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
       echo '<h1 class="text-center">UPDATE MEMBER DATA</h1>';
       echo '<div class="container">';
       if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id    =$_POST['userid'];
            $user  =$_POST['username'];
            $email =$_POST['email'];
            $name  =$_POST['full'];
            $pass  =$_POST['password'];
            // <== check if failed is empty will echo erroe ==>
            $formerores=array();
            if(empty($user)){
                $formerores[]='user name cant by <strong>empty </strong> ';
            }
            if(empty($email)){
                $formerores[]=' email cant by<strong>empty </strong>';
            }
            if(empty($name)){
                $formerores[]=' full name cant by <strong> empty</strong> ';
            }
           
            foreach($formerores as $eror){
                echo '<div class="alert alert-danger">'.$eror;}

             // <=== check if no eror updat data ===>
            if(empty($formerores)){
                    $value=$user;
                    $check = check_item('UserName','userdata',$value);
            
                        $stmt=$con->prepare("UPDATE userdata SET  UserName=?, UserEmail=?,FullName=? ,LoginPassword=? WHERE id=? ");
                        $stmt ->execute(array($user,$email,$name,$pass,$id));
                        $msg = '<h3 div  class="text-center alert alert-success"> SUCCESSFUL UPDATE</h3>';
                        redirect_home($msg,'members.php',4);
            }     
        }else{
           $msg ="<div class=' text-center alert alert-danger'> You Should Signin To Browse This Page<div>";
           redirect_home($msg);
       }


    }} //<== end Update page ==>
    // <=================================================================================>
        // <== Start Delete Page ==>
    // <===============================================================================>

    elseif($do =='delete'){
        if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
        echo '<h1 class="text-center">DELETE MEMBER </h1>';
        echo  '<div id="msg" style="display:none;"> It delete </div>';
        echo '<div class="container">';
            $userid = isset($_POST['del_id']) && is_numeric($_POST['del_id']) ? intval($_POST['del_id']) : 0 ;
            // check if item in database or No
            $check=check_item('id','userdata', $userid);

            if($check > 0){
                $stmt=$con->prepare("DELETE FROM userdata WHERE id=?");
                $stmt->execute(array($userid));
                $msg='<h3 div  class="text-center alert alert-success">USER DELETED</h3>';
                redirect_home($msg,'members.php',4);
                
            }else{
                $msg ="<div class=' text-center alert alert-danger'> You Should Signin To Browse This Page<div>";
                 redirect_home($msg);
            }

         echo '</div';


    }}//END delete Page
// <==================================================================================>
     //start activate page
// <==================================================================================>

elseif($do=='activate'){
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    echo '<h1 class="text-center">Activate MEMBER </h1>';
    echo '<div class="container">';
        $userid = isset($_POST['del_id']) && is_numeric($_POST['del_id']) ? intval($_POST['del_id']) : 0 ;
        // check if item in database or No
        $check=check_item('id','userdata', $userid); 

        if($check > 0){
            $stmt=$con->prepare("UPDATE userdata SET  RegStatus=1 WHERE id=? ");
            $stmt->execute(array($userid));
            $msg='<h4 div  class="text-center alert alert-success"><i class="fa fa-check"></i>USER Activated</h4>';
            redirect_home($msg,null,4);
            exit();
            
        }else{
            $msg ="<div class=' text-center alert alert-danger'> You Should Signin To Browse This Page<div>";
             redirect_home($msg);
        }

     echo '</div';

}}// END activate page 
// <==================================================================================>
     //start mail page
// <==================================================================================>
elseif($do=='mail'){// to insert email in database and send notificat for user
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
     $mail=$_POST['mail'];
     $username=$_SESSION['username'];
     if($mail !=''){//check if field of mail is empty
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo '<h1 class="text-center">mail  </h1>';
        $stmt=$con->prepare("UPDATE userdata SET  notficat_email=? WHERE UserName=? ");
        $stmt->execute([$mail , $username]);
        
    // <=== to send e-mail for user =====>
        // $to = 'melthkeel@gmail.com';
        // $subject = 'Hello from XAMPP!';
        // $message = 'This is a test';
        // $headers =  'MIME-Version: 1.0' . "\r\n"; 
        // $headers .= 'From: mahmoud.m.elshaht@gmail.com>' . "\r\n";
        // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
        
        // if (mail($to, $subject, $message,$headers)) {
        //    echo "SUCCESS";
        // } else {
        //    echo "ERROR";
        // }
         // <=== END send e-mail for user =====>
        // header('location:index.php');
        header('Location: ' . $_SERVER['HTTP_REFERER']);         
        


}
    }
}
}//End mail page
// <==================================================================================>
     //start order page 
// <==================================================================================>
elseif($do=='order'){// isert order info indatabase in table orderinfo
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo '<h1 class="text-center"> Insert Order</h1>';
           
            $firstname          =$_POST['name'];
            $lastname      =$_POST['lastname'];
            $company       =$_POST['company'];
            $phone         =$_POST['phone'];
            $companyemail  =$_POST['companyemail'];
            $country       =$_POST['country'];
            $add1          =$_POST['add1'];
            $add2          =$_POST['add2'];
            $city          =$_POST['city'];
            $district      =$_POST['district'];
            $zip           =$_POST['zip'];
            $userid        =$_SESSION['ID'];
            $message       =$_POST['message'];
            
            // <== check if failed is empty will echo erroe ==>
            $formerores=array();
            if(empty($firstname)){
                $formerores[]='name cant by <strong> empty </strong> ';
            }

            if(empty($lastname)){
                $formerores[]=' lastname cant by<strong>empty </strong>';
            }

            if(empty($company)){
                $formerores[]=' full name cant by <strong> empty</strong> ';
            }
            if(empty($phone)){
                $formerores[]=' password cant by <strong> empty</strong> ';
            }
            // <== if faild empty will echo error ==>
            foreach($formerores as $eror){

                echo '<div class="alert alert-danger">'.$eror;}

             // <=== check if no eror will Insert data ===>

            if(empty($formerores)){    
               
                    $stmt=$con->prepare("INSERT INTO orderinfo( 
                                                                firstName,
                                                                lastName,
                                                                companyName,
                                                                phone,
                                                                email,
                                                                country,
                                                                addressLine1,
                                                                addressLine2,
                                                                city,
                                                                postcode,
                                                                district,
                                                                user_id,
                                                                orderNotes  ) 
                                                        VALUES( 
                                                                :zfirstName,
                                                                :zlastName,
                                                                :zcompanyName,
                                                                :zphone,
                                                                :zemail,
                                                                :zcountry,
                                                                :zaddressLine1,
                                                                :zaddressLine2,
                                                                :zcity,
                                                                :zpostcode,
                                                                :zdistrict,
                                                                :zuser_id,
                                                                :zorderNotes)");
                
                    $stmt->bindParam(':zfirstName',$firstname);
                    $stmt->bindParam(':zlastName',$lastname);
                    $stmt->bindParam(':zcompanyName',$company);
                    $stmt->bindParam(':zphone',$phone);
                    $stmt->bindParam(':zemail',$companyemail);
                    $stmt->bindParam(':zcountry',$country);
                    $stmt->bindParam(':zaddressLine1',$add1);
                    $stmt->bindParam(':zaddressLine2',$add2);
                    $stmt->bindParam(':zcity',$city);
                    $stmt->bindParam(':zpostcode',$zip);
                    $stmt->bindParam(':zdistrict',$district);
                    $stmt->bindParam(':zuser_id',$userid);
                    $stmt->bindParam(':zorderNotes',$message);
                    
                    $stmt->execute();
          
                    $msg = '<h3 div  class="text-center alert alert-success">Insert Data 
                    SUCCESSFUL </h3>';
                    header('Location: ' . $_SERVER['HTTP_REFERER']); 
                    redirect_home($msg,'members.php',1);
                    // redirect_home($msg,"members.php",4);
            }
            }else{
//if userName is already registered will echo this massage and redirect user to home page
                $msg = '<h3 div  class="text-center alert alert-danger"> Username is already registered Please enter another name </h3>';;
                redirect_home($msg,'members.php',6);
            }




}}
else{
    $msg ="<div class=' text-center alert alert-danger'>Pleas Signin , To Allow Notficat For Your e-mail <div>";
         redirect_home($msg);
}//end mail page
    // else{
    //     $msg ="<div class=' text-center alert alert-danger'> You cant Browse This Page Derict , Pleas Signin<div>";
    //      redirect_home($msg);
    // }

    include_once '../includes/templates/footer.php';// footer file
?>
   
 
