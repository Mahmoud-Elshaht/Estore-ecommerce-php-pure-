<?php
// <=====================================================================================>
// <== func for print page titel if Variable '$page_title' in page =======>
function get_title() {
    global $page_title;
    if(isset($page_title)){
        echo $page_title;
    }else{echo 'defualt';}
}// <=== End func get title =======>
// <=====================================================================================>
   //REDIRECTED Function for REDIRECTED user to another page after an event
    //  REDIRECTED Function [This function accept parameter]
    // $erroe msg  = echo the error massage 
    // $page       =page name to derict fo it 
    // $second     =second before redirect

    function redirect_home($msg ,$page = null,$seconds = 4){

        if($page===null){ //if $page==null will transferred user to the previous page 
            if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!==''){
                $page=$_SERVER['HTTP_REFERER'];   
                echo $msg;
                echo "<div class='text-center alert alert-info'>You Will Be Rderict To $page  After $seconds Seconds <div>";
                header("refresh:$seconds;url=$page");
                exit(); 
            }
        }else{
            echo $msg;
            echo "<div class='text-center alert alert-info'>You Will Be Rderict To $page  After $seconds Seconds <div>";
            header("refresh:$seconds;url=$page");
            exit();
        }
        echo $msg;
        echo "<div class='text-center alert alert-info'>You Will Be Rderict To $page  After $seconds Seconds <div>";
        header("refresh:$seconds;url=$page");
        exit();
    }//end func redirect_home()
// <=====================================================================================>
// check item check if item in database or no
//  check item function [this function accept parameter]
//    $select = the item to select     
//    $from   = the table name 
 //   $value = the value of select 

    function check_item($select, $from, $value){
        global $con;
        $stmt=$con->prepare("SELECT $select FROM $from WHERE $select=?");
        $stmt->execute(array($value));
        $count=$stmt->rowcount();
        return $count;
    }//END check item function  
//<===================================================================================>
// function countItem for count numder of item rows
//  accept two parameter [$item , $table]
// $item = item you want to count 
// $table = the to chose from database
function countitem($item , $table){
    global $con;
    $stmt = $con->prepare("SELECT COUNT($item) FROM $table");
    $stmt->execute();
    echo $stmt->fetchColumn();
}  //END function countitem()
// <===================================================================================>
// function get_latest for get last items from database [users , items ,coments,...]
// $select  = select the feild name 
// $table   =table name you will select field from here in database
// $oreder  = the Desc ordering
// $limit   = number of items want to selectfrom faild 
function get_latest($select,$table,$orderd,$limit){
    global $con;
    $stmt=$con->prepare("SELECT $select FROM $table  ORDER BY $orderd limit $limit");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;


}//end function get_latest()
// <============================================================================>
    