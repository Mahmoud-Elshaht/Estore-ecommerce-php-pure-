<?php
// <=============================================================================>
    // Categori page
// <=================================================================================>
ob_start();
session_start();
$page_title='Manage Categori';
include 'init.php';
if(isset($_SESSION['username'])){
    $do='';
    $do = isset($_GET['do']) ? $_GET['do']:'manage';

// <============================================================================>
        // <== Start Manage Page ==>
// <===============================================================================>
        if( $do == 'manage'){
           

            $stmt=$con->prepare("SELECT * FROM categories ");
            $stmt->execute();
            $rows = $stmt->fetchAll();
           
            ?>
     <!-- <================================================================> -->
            <h1 class="text-center"> Manage Categories</h1>
            <div class="container manage">
                <div class="table-responsive">
                    <table class="table text-center table-bordered ">
                        <thead >
                            <tr >
                                <td>#ID</td>
                                <td>Name</td>
                                <td>Description</td>
                                <td>image</td>
                                <td>Ordring</td>
                                <td>Visbility</td>
                                <td>Allow_Ads</td>
                                <td>memberID</td>
                                
                            </tr>
                            
                        </thead>
                        <?php
                        foreach($rows as $row){
                        
                            echo"<tr>";
                                echo "<td>" . $row['iD'] ."</td>";
                                echo "<td>" . $row['Name'] ."</td>";
                                echo "<td>" . $row['Description'] ."</td>";
                                echo "<td>" . $row['image'] ."</td>";
                                echo "<td>" . $row['Ordring'] ."</td>";
                                echo "<td>" . $row['Visbility'] ."</td>";
                                echo "<td>" . $row['Allow_Ads'] ."</td>";
                                echo "<td>" . $row['memberID'] ."</td>";
                                echo "<td> </td>";
                                echo "<td class='btn-con'>
                                        <a href='categ.php?do=edit&catid=".$row['iD']."' class='btn btn-success edit'><i class='fa fa-edit'></i>Edit</a>"?>

<a href="#" onClick="ajax_del('categ.php?do=delete',<?php echo $row["iD"]; ?>)"  class="btn btn-danger confirm"> <i class="fa fa-times"></i>Delete</a>


                                        <?php




                                        /*"<a href='categ.php?do=delete&catid=".$row['iD']."' class='btn btn-danger confirm''><i class='fas fa-times'></i>Delete</a>";*/
    

                                        }
                                        
                                    echo  "</td>";

                               
                            echo"</tr>";
                        

                        ?>
                        
                        </tr>
                    </table>
                </div>
                <a  echo href="categ.php?do=add"  class="btn btn-primary"><i class="fa fa-plus"></i>Add New Categori</a>
                </div>

                
        



      <?php 
// <============================================================================>
        // <== Start add Page ==>
// <===============================================================================>
        }elseif($do=='add'){ ?>

            
            <h1 class="text-center">Add New Categori </h1>
            <div class="container">
             <form id="add_categ" class="form-horizontal" action="#" method='POST' enctype="multipart/form-data">
                
                <!-- start Name field  -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name"  class="form-control" autocomplete="off" required="required" placeholder="Name Of Categori"/>
                    </div>
                </div> <!-- END Name field  -->
    <!-- <=========================================================>    --> 
                <!-- start Description field  -->
                <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" name="description" class="form-control" placeholder="Describe Categori" />
                    </div>
    
                </div> <!-- END description field  -->
<!-- <=========================================================>    --> 
    <!-- start image field  -->
    <div class="form-group">
                <div class="col-sm-10">
                    <input type="file" name="img" class="form-control" placeholder="Image of item" />
                </div>
    </div> <!-- END image field  -->
    <!-- <==========================================================>    -->
                <!-- start ordring field  -->
                <div class="form-group">
                        <label class="col-sm-2 control-label">ordring</label>
                            <div class="col-sm-10">
                                <input type="text" name="ordring" class="form-control" placeholder="Number To Arrange The Categori"/>
                    </div>
                </div> <!-- END ordring field  -->
    <!-- ======================================================================== -->
                <!-- start Visibility field  -->
                <div class="form-group">
                        <label class="col-sm-2 control-label">Visible</label>
                            <div class="col-sm-10">
                               <div>
                                   <input id="vis-yes" type="radio" name="Visibility" value="0" checked/>
                                   <lable for="vis-yes">Yes</lable>
                               </div>
                               <div>
                                   <input id="vis-no" type="radio" name="Visibility" value="1" />
                                   <lable for="vis-no">No</lable>
                               </div>
                    </div>
                </div><!-- END Visibility field  -->
    <!-- <============================================================>    -->
                <!-- start Allow Comenting Field  -->
                <div class="form-group">
                        <label class="col-sm-2 control-label">Allow Comenting  </label>
                            <div class="col-sm-10">
                               <div>
                                   <input id="com-yes" type="radio" name="commenting" value="0" checked/>
                                   <lable for="com-yes">Yes</lable>
                               </div>
                               <div>
                                   <input id="com-no" type="radio" name="commenting" value="1" />
                                   <lable for="com-no">No</lable>
                               </div>
                    </div>
                </div><!-- END  Allow Comenting field  -->
    <!-- <===========================================================>    -->    
               <!-- start Adds Field  -->
               <div class="form-group">
                        <label class="col-sm-2 control-label">Allow Adds </label>
                            <div class="col-sm-10">
                               <div>
                                   <input id="adds-yes" type="radio" name="adds" value="0" checked/>
                                   <lable for="adds-yes">Yes</lable>
                               </div>
                               <div>
                               
                                   <input id="adds-no" type="radio" name="adds" value="1" />
                                   <lable for="adds-no"> No</lable>
                                 
                               </div>
                    </div>
                </div><!-- END  Adds field  -->
   <!-- ==================================================================-->
 
                <div class="form-group form-group-lg">
                <a href="categ.php?do=insert">
                    <div class="col-sm-offset-2 col-sm-10">
                        <h2 id="msg" class="text-center"><i class="fas fa-check"></i></h2>
                        <button onclick="ajax_insert('categ.php?do=insert','#add_categ')" class="btn btn-primary btn-lg">Add</button>
                     </div> </a>
                </div>      
            </form>
        </div>
       



<?php
// <============================================================================>
        // <== Start Insert Page ==>
// <===============================================================================>
       }elseif($do == 'insert'){
                if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
                        
                        $name=$_POST['name'];
                        $desc=$_POST['description'];
                        $image=$_POST['img'];
                        $ordr=$_POST['ordring'];
                        $Visib=$_POST['Visibility'];
                        $coment=$_POST['commenting'];
                        $add=$_POST['adds'];
                        $userid=$_SESSION['ID'];

                //
                       $stmt=$con->prepare("INSERT INTO categories(Name ,Description,image ,Ordring,Visbility ,Allow_Comment ,Allow_Ads,memberID ) 
                       values(:zname,:zdesc,:zimg,:zordr,:zvisbl ,:zallowComent ,:zallowAdd,:zuser)");//
                       $stmt->bindparam(':zname',$name);
                       $stmt->bindparam(':zdesc',$desc);
                       $stmt->bindparam(':zimg',$image);
                       $stmt->bindparam(':zordr',$ordr);
                       $stmt->bindparam(':zvisbl',$Visib);
                       $stmt->bindparam(':zallowComent',$coment);
                       $stmt->bindparam(':zallowAdd',$add);
                       $stmt->bindparam(':zuser',$userid);
                       $stmt->execute();

                       $msg = '<h3 div  class="text-center alert alert-success">Insert Data Data  SUCCESSFUL </h3>';
                
                    redirect_home($msg,"categ.php",4);

                }else{$msg = '<h5 div  class="text-center alert alert-danger">Cant Brows  this page directory , Pleas Login </h5>';
                
                    redirect_home($msg,"index.php",4);}



        
// <============================================================================>
        // <== Start edit Page ==>
// <===============================================================================>
        }elseif($do=='edit'){

            $cateid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0 ;

            $stmt=$con->prepare("SELECT * FROM categories WHERE iD=?"); 
            $stmt->execute(array($cateid));
            $cat = $stmt->fetch();
            $count=$stmt->rowcount();

            if($count > 0){
            ?>
            <h1 class="text-center">Edit Categori </h1>
            <div class="container">
             <form id="categ_edit" class="form-horizontal" action="#" method='POST' enctype="multipart/form-data">
             <input type="hidden" name="catid" value="<?php echo $cateid; ?>">
                
                <!-- start Name field  -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name"  class="form-control" autocomplete="off" value="<?php echo $cat['Name'] ?>" required="required" placeholder="Name Of Categori"/>
                            </div>
                </div> <!-- END Name field  -->
    <!-- <=========================================================>    --> 
                <!-- start Description field  -->
                <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" name="description" class="form-control" value="<?php echo $cat['Description'] ?>"  placeholder="Describe Categori" />
                            </div>
    
                </div> <!-- END description field  -->
    <!-- <=========================================================>    --> 
                <!-- start image field  -->
    <div class="form-group">
            <!-- <label class="col-sm-2 control-label"> Image </label> -->
                <div class="col-sm-10">
                <img src="<?php echo $style_path; ?>img/categori/<?php echo $cat['image'] ?>" width="75px" height="150px"  alt="image of item"> 
                    <input type="file" name="img" value="<?php echo $cat['image']?>" class="form-control" placeholder="Image of item" />
                </div>
    </div> <!-- END image field  -->
    <!-- <==========================================================>    -->
                <!-- start ordring field  -->
                <div class="form-group">
                        <label class="col-sm-2 control-label">ordring</label>
                            <div class="col-sm-10">
                                <input type="text" name="ordring" class="form-control"  value="<?php echo $cat['Ordring'] ?>"  placeholder="Number To Arrange The Categori"/>
                    </div>
                </div> <!-- END ordring field  -->
    <!-- <==========================================================>    -->
                <!-- start offer field  -->
                <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">Offer</label>
                            <div class="col-sm-10">
                                <input type="text" name="offer" class="form-control"  value="<?php echo $cat['offer'] ?>" placeholder="Number Of Descound"/>
                    </div>
                </div> END offer field  -->
    <!-- <==========================================================>    -->
                <!-- start Visibility field  -->
                <div class="form-group">
                        <label class="col-sm-2 control-label">Visible</label>
                            <div class="col-sm-10">
                               <div>
                                   <input id="vis-yes" type="radio" name="Visibility" value="0" <?php if($cat['Visbility']==0){echo 'checked';} ?>/>
                                   <lable for="vis-yes">Yes</lable>
                               </div>
                               <div>
                                   <input id="vis-no" type="radio" name="Visibility" value="1" <?php if($cat['Visbility']==1){echo 'checked';} ?>/>
                                   <lable for="vis-no">No</lable>
                               </div>
                    </div>
                </div><!-- END Visibility field  -->
    <!-- <============================================================>    -->
                <!-- start Allow Comenting Field  -->
                <div class="form-group">
                        <label class="col-sm-2 control-label">Allow Comenting  </label>
                            <div class="col-sm-10">
                               <div>
                                   <input id="com-yes" type="radio" name="commenting" value="0" <?php if($cat['Allow_Comment']==0){echo 'checked';} ?>/>
                                   <lable for="com-yes">Yes</lable>
                               </div>
                               <div>
                                   <input id="com-no" type="radio" name="commenting" value="1" <?php if($cat['Allow_Comment']==1){echo 'checked';} ?>/>
                                   <lable for="com-no">No</lable>
                               </div>
                    </div>
                </div><!-- END  Allow Comenting field  -->
    <!-- <===========================================================>    -->    
               <!-- start Adds Field  -->
               <div class="form-group">
                        <label class="col-sm-2 control-label">Allow Adds </label>
                            <div class="col-sm-10">
                               <div>
                                   <input id="adds-yes" type="radio" name="adds" value="0" <?php if($cat['Allow_Ads']==0){echo 'checked';} ?>/>
                                   <lable for="adds-yes">Yes</lable>
                               </div>
                               <div>
                               
                                   <input id="adds-no" type="radio" name="adds" value="1" <?php if($cat['Allow_Ads']==1){echo 'checked';} ?>/>
                                   <lable for="adds-no"> No</lable>
                                 
                               </div>
                    </div>
                </div><!-- END  Adds field  -->              
     <!-- <=======================================================>    -->            
 
                <div class="form-group form-group-lg">
                <!-- 'categ.php?do=edit&catid=".$row['iD']."' -->
                <a href="categ.php?do=edit&catid='. $cat['iD']' . ">
                    <div class="col-sm-offset-2 col-sm-10">
                    <h2 id="msg" class="text-center"><i class="fas fa-check"></i></h2>

                    <button onClick="ajax_insert('categ.php?do=update','#categ_edit')" class="btn btn-primary btn-lg" />Save</button>
                     </div> </a>
                </div>      
            </form>
        </div>
         


<?php
            }
// <============================================================================>
        // <== Start update Page ==>
// <===============================================================================>
        }elseif($do=='update'){
            echo '<h1 class="text-center">Update Categoris DATA</h1>';
            echo '<div class="container">';
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
            $zid=$_POST['catid'];
            $zname=$_POST['name'];
            $zdesc=$_POST['description'];
            $zimage=$_FILES['img']['name'];
            $zordr=$_POST['ordring'];
            $zvisibl=$_POST['Visibility'];
            $zcoment=$_POST['commenting'];
            $zads=$_POST['adds'];
            $formerores=array();
            if(empty($zname)){
                echo '<h6 div  class="text-center alert alert-success"> Name field Cant Be Empty </h6>';
            }else{
            $value=$zid;
            $check = check_item('iD','categories',$value);
            if($check>0){
                $stmt=$con->prepare("UPDATE categories SET  Name=?,Description=?,image=?,Ordring=?,Visbility=?,Allow_Comment=?  ,Allow_Ads=? WHERE iD=? ");
                        $stmt->execute(array($zname,$zdesc,$zimage,$zordr ,$zvisibl ,$zcoment ,$zads ,$zid));

                $msg = '<h3 div  class="text-center alert alert-success"> SUCCESSFUL UPDATE</h3>';
                redirect_home($msg,'categ.php',2);

                
            }else{
                echo '<h3 div  class="text-center alert alert-danger"> Data Not Found </h3>';
                redirect_home($msg,'index.php',5);
            }
        } 
        }//if($_SERVER

    

// <============================================================================>
        // <== Start delete Page ==>
// <===============================================================================>
}elseif($do =='delete'){
    echo '<h1 class="text-center">DELETE MEMBER </h1>';
    echo  '<div id="msg" style="display:none;"> It delete </div>';
    echo '<div class="container">';
        $categ_id = isset($_POST['del_id']) && is_numeric($_POST['del_id']) ? intval($_POST['del_id']) : 0 ;
        // check if item in database or No
        $check=check_item('iD','categories', $categ_id);

        if($check > 0){
            $stmt=$con->prepare("DELETE FROM categories WHERE iD=?");
            $stmt->execute(array($categ_id));
            echo '<h3 id="msg" div  class="text-center alert alert-success">USER DELETED</h3>';
        }else{
            echo "<div id='eror' class=' text-center alert alert-danger'> You Should Signin To Browse This Page<div>";
             
        }

     echo '</div';




}//END delete Page
// <============================================================================>
        // <== Start details Page ==>
// <===============================================================================>
    elseif($do=='details'){
        $cateid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0 ;

            $stmt=$con->prepare("SELECT * FROM categories WHERE iD=?"); 
            $stmt->execute(array($cateid));
            $cat = $stmt->fetch();
            $count=$stmt->rowcount();

            if($count > 0){
            ?>
            <h1 class="text-center">Details Of Categori </h1>
            <div class="container">
             <form class="form-horizontal" action="?do=update" method='POST'>
             <input type="hidden" name="catid" value="<?php echo $cat['iD']  ?> " disabled>
                
                <!-- start Name field  -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name"  class="form-control" autocomplete="off" value="<?php echo $cat['Name'] ?>" required="required" placeholder="Name Of Categori"disabled/>
                            </div>
                </div> <!-- END Name field  -->
    <!-- <=========================================================>    --> 
                <!-- start Description field  -->
                <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" name="description" class="form-control" value="<?php echo $cat['Description'] ?>"  placeholder="Describe Categori" disabled/>
                            </div>
    
                </div> <!-- END description field  -->
    <!-- <=========================================================>    --> 
                <!-- start image field  -->
    <div class="form-group">
            <!-- <label class="col-sm-2 control-label"> Image </label> -->
                <div class="col-sm-10">
                <img src="<?php echo $style_path; ?>img/categori/<?php echo $cat['image'] ?>" width="75px" height="150px"  alt="image of item"> 
                    <input type="file" name="img" value="<?php echo $cat['image']?>" class="form-control" placeholder="Image of item" disabled/>
                </div>
    </div> <!-- END image field  -->
                   
     <!-- <======================================================>    -->            
 
                <div class="form-group form-group-lg">
                <!-- 'categ.php?do=edit&catid=".$row['iD']."' -->
                <a href="categ.php?do=edit&catid='. $cat['iD']' . ">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="Add Categori" class="btn btn-primary btn-lg"/>
                     </div> </a>
                </div>      
            </form>
        </div>
         
<?php
    }} //end details page
    else{
        $msg='<h3 div  class="text-center alert alert-danger">You cant Browse This Page Derict , Pleas Signin </h3>';
         redirect_home($msg,'index.php',4);
    }
}
include_once '../includes/templates/footer.php';// footer file