<?php
ob_start();
session_start();
$page_title='Items';
include 'init.php';
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    $do='';
    $do=(isset($_GET['do']))?$_GET['do']:'manage';
// if(isset($_GET['do'])){ $do=$_GET['do'];}else{$do='manage';}
// <============================================================================>
        // <== Start Manage  Page ==>
// <===============================================================================>
  if($do=='manage'){

        
         $stmt=$con->prepare("SELECT * FROM items");
         $stmt->execute();
         $items=$stmt->fetchAll();

        
        ?>
<h1 class="text-center"> Manage Items</h1>
<div class="container manage">
    <div class="table-responsive">
        <table id='delete' class="table text-center table-bordered ">
            <thead>
                <tr>

                    <td>Name</td>
                    <td>Description</td>
                    <td>Price</td>
                    <td>Date</td>
                    <td>Image</td>
                    <td>Status</td>
                    <td>Rate</td>
                    <td>Country Made</td>
                    <td>Offer</td>
                    <td>featured</td>
                    <td>#ID</td>

                </tr>

            </thead>
            <?php
                        foreach($items as $item){
                        
                            echo"<tr>";
                                echo "<td>" . $item['Name'] ."</td>";
                                echo "<td>" . $item['Description'] ."</td>";
                                echo "<td>" . $item['Price'] ."</td>";
                                echo "<td>" . $item['Add_date'] ."</td>";
                                echo "<td>" . $item['image'] ."</td>";
                                echo "<td>" . $item['Status'] ."</td>";
                                echo "<td>" . $item['Rating'] ."</td>";
                                echo "<td>" . $item['country_made'] ."</td>";
                                echo "<td>" . $item['offer'] ."</td>";
                                echo "<td>" . $item['featured'] ."</td>"; 
                                echo "<td>" . $item['item_iD'] ."</td>";
                                echo "<td> </td>";
                                echo "<td class='btn-con'>";?>
            <a href='items.php?do=edit&itemid=<?php echo $item['item_iD']?>' class='btn btn-success edit'><i
                    class='fa fa-edit'></i>Edit</a>

            <a onClick='ajax_del("items.php?do=delete",<?php echo $item["item_iD"]?>);disableScroll()' href="#"
                class='btn btn-danger confirm'><i class='fas fa-times'></i>Delete</a>
            <?php

                                        }
                                        
                                    echo  "</td>";

                               
                            echo"</tr>";
                        

                        ?>

            </tr>
        </table>
    </div>
    <a echo href="items.php?do=add" class="btn btn-primary"><i class="fa fa-plus"></i>Add New Item</a>
</div>

<?PHP

// <============================================================================>
        // <== Start Add Page ==>
// <===============================================================================>
  }elseif($do=='add'){?>

<h1 class="text-center">Add New Item </h1>
<div class="container">
    <h3 class="msg">ok</h3>
    <form id="add_item" class="form-horizontal" action="#" method='POST' enctype="multipart/form-data">

        <!-- start Name field  -->
        <div class="form-group">
            <div class="col-sm-10">
                <input id="#name" type="text" name="name" class="form-control" autocomplete="off" required="required"
                    placeholder="Name Of Item" />
            </div>
        </div> <!-- END Name field  -->
        <!-- <=========================================================>    -->
        <!-- start Description field  -->
        <div class="form-group">
            <div class="col-sm-10">
                <input id="#description" type="text" name="description" class="form-control"
                    placeholder="Describe Categori" />
            </div>

        </div> <!-- END description field  -->
        <!-- <==========================================================>    -->
        <!-- start Price  field  -->
        <div class="form-group">
            <div class="col-sm-10">
                <input type="number" min="0" name="price" value="$  " class="form-control" autocomplete="off"
                    required="required" placeholder="Price Of Item" />
            </div>
        </div> <!-- END price field  -->
        <!-- <=========================================================>    -->
        <!-- start image field  -->
        <div class="form-group">
            <label class="col-sm-2 control-label"> Image of item </label>
            <div class="col-sm-10">
                <input type="file" name="img" id="multipleFile" required accept="image/*" multiple>
            </div> <!-- END image field  -->
            <!-- <==========================================================>    -->
            <!--Start Status field  -->
            <div class="form-group">



                <label class="col-sm-2 control-label">Status</label>

                <select name="status">

                    <option value="New">New</option>
                    <option value="Like New">Like New</option>
                    <option value="Old">Old</option>

                </select>
            </div>

        </div> <!-- END Status field  -->
        <!-- <==========================================================>    -->
        <!-- start Country of made field  -->
        <div class="form-group">
            <div class="col-sm-10">
                <input type="text" name="country" class="form-control" placeholder="Country of Origin" />
            </div>
        </div> <!-- END country of made field  -->
        <!-- <==========================================================>    -->
        <!-- start offer field  -->
        <div class="form-group">
            <!-- <label class="col-sm-2 control-label">Offer</label> -->
            <div class="col-sm-10">
                <input type="number" min="0" name="offer" class="form-control" placeholder="Price After Sale" />
            </div>
        </div> <!-- END offer field  -->
        <!-- <==========================================================>    -->
        <!-- start Visibility field  -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Visible</label>
            <div class="col-sm-10">
                <div>
                    <input id="vis-yes Visibility" type="radio" name="Visibility" value="0" checked />
                    <lable for="vis-yes">Yes</lable>
                </div>
                <div>
                    <input id="vis-no Visibility" type="radio" name="Visibility" value="1" />
                    <lable for="vis-no">No</lable>
                </div>
            </div>
        </div><!-- END Visibility field  -->

        <!-- <=============================================================>    -->
        <!-- start features field -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Featured </label>
            <div class="col-sm-10">
                <div>
                    <input id="featured-yes featured" type="radio" name="featured" value="0" />
                    <lable for="adds-yes">Yes</lable>
                </div>
                <div>

                    <input id="featured-no featured" type="radio" name="featured" value="1" checked />
                    <lable for="adds-no"> No</lable>

                </div>

            </div>

        </div><!-- END  features field  -->
        <!-- <=======================================================>    -->

        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <!-- to show reight after item insert to cart -->
                <h2 id="msg" class="text-center"><i class="fas fa-check"></i></h2>

                <button onClick="ajax_insert('items.php?do=insert','#add_item')" class="btn btn-primary btn-lg" />Add
                Item</button>

            </div>


        </div>

    </form>
</div>
<?php
 // <============================================================================>
        // <== Start insert Page ==>
// <===============================================================================>
      }elseif($do=='insert'){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
     if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
        $zname     =$_POST['name'];
        $zdesc     =$_POST['description'];
        $zprice    =$_POST['price'];
        $zimg      =$_FILES['img']['name'];
        $zstatus   =$_POST['status'];
        $zcountry  =$_POST['country'];
        $zoffer    =$_POST['offer'];
        $zfeature  =$_POST['featured'];
        $zvisibil  =$_POST['Visibility'];
        $userId    =$_SESSION['ID']; 
        $stmt=$con->prepare("INSERT INTO items( Name , Description , Price,image,Status,  country_made,offer ,featured ,visibilty,member_iD  ) values('$zname','$zdesc','$zprice','$zimg','$zstatus','$zcountry','$zoffer','$zfeature','$zvisibil','$userId')");
        $stmt->execute();
        
        $msg = '<h3 div  class="text-center alert alert-success">Insert Data SUCCESSFUL </h3>';
            redirect_home($msg,"items.php",2);
    }else{
        $msg = '<h5 div  class="text-center alert alert-danger">Cant Brows  this page directory , Pleas Login </h5>';
                
        redirect_home($msg,"index.php",5);}

    }
// <============================================================================>
        // <== Start Edite Page ==>
// <===============================================================================>
} elseif($do=='edit'){
        $itemId='';
        if(isset($_GET['itemid'])){ $itemId=$_GET['itemid'];} 
         $stmt=$con->prepare(" SELECT * FROM items WHERE item_iD = ?")  ;                            
        $stmt->execute(array($itemId));
        $item=$stmt->Fetch(); 
            

    ?>
<h1 class="text-center">Edit Item </h1>
<div class="container">
    <form id="update_item" class="form-horizontal" action="#" method='POST' enctype="multipart/form-data" multiple>
        <!-- start ID field  -->
        <div class="form-group">
            <!-- <label class="col-sm-2 control-label">Name</label> -->
            <div class="col-sm-10">
                <input type="hidden" name="id" value="<?php echo $item['item_iD'] ?>" class="form-control"
                    autocomplete="off" />
            </div>
        </div> <!-- END ID field  -->
        <!-- <=========================================================>    -->

        <!-- start Name field  -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" value="<?php echo $item['Name'] ?>"
                    autocomplete="off" required="required" placeholder="Name Of Item" />
            </div>
        </div> <!-- END Name field  -->
        <!-- <=========================================================>    -->
        <!-- start Description field  -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <input type="text" name="description" value="<?php echo $item['Description'] ?>" class="form-control"
                    placeholder="Describe Categori" />
            </div>

        </div> <!-- END description field  -->
        <!-- <==========================================================>    -->
        <!-- start Price  field  -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Price</label>
            <div class="col-sm-10">
                <input type="text" name="price" class="form-control" autocomplete="on" required="required"
                    value="<?php echo $item['Price'] ?>" placeholder="Price Of Item" />
            </div>
        </div> <!-- END price field  -->
        <!-- <=========================================================>    -->
        <!-- start image field  -->
        <div class="form-group">
            <label class="col-sm-2 control-label"> Image </label>
            <div class="col-sm-10">
                <img name="img" width="200" height="150" src="<?php echo $style_path; ?>img/categori/<?php echo $item['image'] ?>">
                <input type="file" name="img" value="<?php echo $item['image'] ?>" class="form-control"  action="image"
                    placeholder="Image of item" accept="image/*" required/>

            </div>
        </div> <!-- END image field  -->
        <!-- <==========================================================>    -->
        <!-- start Status field  -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Status</label>
            <div class="col-sm-10">
                <select name="status" value="<?php echo $item['Status'] ?>">
                    <option>New</option>
                    <option>Like New</option>
                    <option>Old</option>
                </select>
            </div>
        </div> <!-- END Status field  -->
        <!-- <==========================================================>    -->
        <!-- start Country of made field  -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Country of Origin</label>
            <div class="col-sm-10">
                <input type="text" name="country" value="<?php echo $item['country_made'] ?>" class="form-control"
                    placeholder="Country of Origin" />
            </div>
        </div> <!-- END country of made field  -->
        <!-- <==========================================================>    -->
        <!-- start offer field  -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Offer</label>
            <div class="col-sm-10">
                <input type="text" name="offer" value="<?php echo $item['offer'].'.' ;?>" class="form-control"
                    placeholder="Sale" />
            </div>
        </div> <!-- END offer field  -->
        <!-- <==========================================================>    -->
        <!-- start Visibility field  -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Visible</label>
            <div class="col-sm-10">
                <div>
                    <input id="vis-yes" type="radio" name="Visibility" value="0"
                        <?php if($item['visibilty']==0){echo 'checked';} ?> />
                    <lable for="vis-yes">Yes</lable>
                </div>
                <div>
                    <input id="vis-no" type="radio" name="Visibility" value="1"
                        <?php if($item['visibilty'] == 1){echo 'checked';} ?> />
                    <lable for="vis-no">No</lable>
                </div>
            </div>
        </div><!-- END Visibility field  -->

        <!-- <=============================================================>    -->
        <!-- start features field -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Featured </label>
            <div class="col-sm-10">
                <div>
                    <input id="featured-yes" type="radio" name="featured" value="0"
                        <?php if($item['featured']==0){echo 'checked';} ?> />
                    <lable for="adds-yes">Yes</lable>
                </div>
                <div>

                    <input id="featured-no" type="radio" name="featured" value="1"
                        <?php if($item['featured']==1){echo 'checked';} ?> />
                    <lable for="adds-no"> No</lable>

                </div>
            </div>
        </div><!-- END  features field  -->
        <!-- <=======================================================>    -->
        <!-- href='items.php?do=edit&itemid=".$item['item_iD']."' -->
        <div class="form-group form-group-lg">
            <!-- <a href='items.php?do=update&itemid=". $item["item_iD"] ."'>
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Update" class="btn btn-primary btn-lg" />
                </div>
            </a> -->
            <h2 id="msg" class="text-center"><i class="fas fa-check"></i></h2>

            <button onClick="ajax_insert('items.php?do=update','#update_item','#msg')"
                class="btn btn-primary btn-lg" />Update</button>
        </div>
    </form>
</div>


<?php



// <============================================================================>
        // <== Start update Page ==>
// <===============================================================================>
} elseif($do=='update'){
       echo'<h1 class="text-center">Update Item </h1>';
       $itemId    =$_POST['id'];
        $zname     =$_POST['name'];
        $zdesc     =$_POST['description'];
        $zprice    =$_POST['price'];
        $zimg      =$_FILES['img']['name'];
        $zstatus   =$_POST['status'];
        $zcountry  =$_POST['country'];
        $zoffer    =$_POST['offer'];
        $zfeature  =$_POST['featured'];
        $zvisibil  =$_POST['Visibility']; 
        $value=$itemId;
        $check = check_item('item_iD','items',$value);
        if($check>0){
   
                $stmt=$con->prepare("UPDATE items SET Name=?,Description=?,Price=?,image=?,Status=?,country_made=?,offer=?,featured=?,visibilty=? where item_iD =?");
                $stmt->execute(array($zname,$zdesc,$zprice,$zimg,$zstatus,$zcountry,$zoffer,$zfeature,$zvisibil,$itemId));
               $msg='<h3 div  class="text-center alert alert-success"> SUCCESSFUL Update </h3>';
                
                    redirect_home($msg,"items.php",2);
            }else{
                $msg='<h3 div  class="text-center alert alert-danger"> Data Not found </h3>';
                
                redirect_home($msg,"items.php",5);
            }



// <============================================================================>
        // <== Start Delete  Page ==>
// <===============================================================================>
} elseif($do=='delete'){
    if(isset($_POST['del_id']) && !empty($_POST['del_id']) && is_numeric($_POST['del_id'])){
        $itemId=$_POST['del_id']; 
        $stmt=$con->prepare("DELETE FROM items WHERE item_iD =? ");
        $stmt->execute(array($itemId));
        $msg='<h3 div  class="text-center alert alert-danger"> Item Successfully Deleted </h3>';
            redirect_home($msg,"items.php",2);

    }// <============================================================================>
        // <== Start Details Page ==>
// <===============================================================================>
} elseif($do=='details'){
    $itemId=''; 
    if(isset($_GET['itemid'])){ $itemId = $_GET['itemid'];} 
     $stmt=$con->prepare(" SELECT * FROM items WHERE item_iD = ? limit 1")  ;                            
    $stmt->execute(array($itemId));
    $items=$stmt->fetchAll();
    foreach($items as $item){ 
        

?>
<h1 class="text-center">Product Details </h1>
<div class="container">
    <form class="form-horizontal" action="3" method='POST'>
        <!-- start ID field  -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Product ID </label>
            <div class="col-sm-10">
                <input type="text" name="id" value="<?php echo $itemId ?>" class="form-control" autocomplete="off"
                    disabled />
            </div>
        </div> <!-- END ID field  -->
        <!-- <=========================================================>    -->

        <!-- start Name field  -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" value="<?php echo $item['Name'] ?>"
                    autocomplete="off" required="required" placeholder="Name Of Item" disabled />
            </div>
        </div> <!-- END Name field  -->
        <!-- <=========================================================>    -->
        <!-- start Description field  -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <input type="text" name="description" value="<?php echo $item['Description'] ?>" class="form-control"
                    placeholder="Describe Categori" disabled />
            </div>

        </div> <!-- END description field  -->
        <!-- <==========================================================>    -->
        <!-- start Price  field  -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Price</label>
            <div class="col-sm-10">
                <input type="text" name="price" class="form-control" autocomplete="on" required="required"
                    value="<?php echo $item['offer'] ?>" placeholder="Price Of Item" disabled />
            </div>
        </div> <!-- END price field  -->
        <!-- <=========================================================>    -->
        <!-- start image field  -->
        <div class="form-group">
            <!-- <label class="col-sm-2 control-label"> Image </label> -->
            <div class="col-sm-10">
                <img src="<?php echo $style_path; ?>img/categori/<?php echo $item['image'] ?>">
                <!-- <input type="file" name="img" value="<?php  ?>" class="form-control" placeholder="Image of item" disabled/> -->
            </div>
        </div> <!-- END image field  -->
        <!-- <==========================================================>    -->
        <!-- start Status field  -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Status</label>
            <div class="col-sm-10">
                <select name="status" disabled>
                    <option><?php echo $item['Status'] ?></option>
                </select>

            </div>
        </div> <!-- END Status field  -->
        <!-- <==========================================================>    -->
        <!-- start Country of made field  -->
        <div class="form-group">
            <label class="col-sm-2 control-label">Country of Origin</label>
            <div class="col-sm-10">
                <input type="text" name="country" value="<?php echo $item['country_made'] ?>" class="form-control"
                    placeholder="Country of Origin" disabled />
            </div>
        </div> <!-- END country of made field  -->
    </form>
</div>

<?php

    }


} //end details page 
// <==================================================================================>
    //   Start Search  Page to search in website
// <==================================================================================>
elseif($do=='search'){

    
    $stmt=$con->prepare("SELECT * FROM items,categories ");
    $stmt->execute();
    $rows=$stmt->fetchall();
// print_r($rows).'\n';
}
include_once '../includes/templates/footer.php';
}?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="ajax-script.js"></script> -->