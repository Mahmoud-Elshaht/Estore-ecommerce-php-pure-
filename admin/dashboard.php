<?php
ob_start();
session_start();
$page_title='DASHBOARD';
include 'init.php';
if(isset($_SESSION['username'])){

   
    
    $latestUser = 5; //number of latest yser from database
   

  ?>
<div class="home-stats">
    <div class='container  text-center'>
        <h1>Dashboard </h1>
            <div class="row">
                <div class="col-md-3">
                <a href="members.php">
                    <div class="stat st-members"> Total Members
            <!-- function countitem  to count number of users in table userdata -->
                        <span><?php countitem('UserName','userdata'); ?></span>
                    </div>
                </a>
                </div>
                    <div class="col-md-3">
                    <a href="members.php?do=manage&page=pending">
                        <div class="stat st-pending"> Pending Members
                    <!-- echo number of users waiting activat from admin -->
                         <span><?php echo check_item('REgStatus', 'userdata', 0); ?></span>
                        </div>
                    </a>
                    </div>
               
                <div class="col-md-3">
                    <div class="stat st-item"> Total Item
                        <span>
                        <?php 
                        // function countitem  to count number of items in table items
                            countitem('item_iD ', 'items');
    
                        ?>



                        </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-coments"> Total Coments

                        <span><?php countitem('Allow_Comment', 'categories');?></span>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</div>
<!-- ================================================================= -->
<div class="latest">
    <div class="container">
        <div class="row">
            <div class="col-sm-6"> 
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-users"></i> Latest <?php 
                   echo $latestUser.' '; ?>Registerd Users </div>
                    <div class="panel-body">
                        <ul class='latest-user list-unstyled'>
                            <?php 
                                $thelatest=get_latest("*","userdata","id",$latestUser);
                                foreach($thelatest as $user){
                                    echo'<li>';
                                        echo  $user["UserName"];
                                        echo '<a href="members.php?do=edit&userid='.
                                                $user["id"].'">';
                                                if($user['RegStatus']==0){
                                                    echo  "<a href='members.php?do=activate&userid=".$user['id']."' class='btn btn-danger float-right activ' '> <i class='fas fa-check'></i>Activate</a>";
                                                  }else{}
                                            echo '<span class="btn btn-success float-right edit"> <i class="fa fa-edit ">Edit</i> </span>';
                                             
                                        echo  ' </a>';
                                        
                                     echo'</li>';
                                }
                            ?>
                        </ul>
                    </div>
                        
                   
                </div>
            </div>
            
            <div class="col-sm-6"> 
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-tag"></i> Latest Items
                    </div>
                    <div class="panel-body">
                        test
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    

<?php
}else{
    $msg ="<div class=' text-center alert alert-danger'> You cant Browse This Page Derict , Pleas Signin <div>";
     redirect_home($msg);
}
include_once '../includes/templates/footer.php';
