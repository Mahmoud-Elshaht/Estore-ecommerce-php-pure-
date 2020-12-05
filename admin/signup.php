<?php
//parameter of function 'get_title()' to echo page title in Browser
$page_title ='SignUp';


// $File_path='admin/';// path of files in folder admin 
include_once 'init.php';
?>
<h1 >Sign Up</h1>
<form id="add_member" class="form-horizontal" action="#" method='POST' enctype="multipart/form-data">
                
            <!-- start user name faild  -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">username</label>
                        <div class="col-sm-10 col-lg-4">
                            <input type="text"  name="username"  class="form-control" autocomplete="off" placeholder="username" required/>
                        </div>
                
            </div>
           

            <!-- start password faild  -->
            <div class="form-group">
                    <label class="col-sm-2 control-label">password</label>
                        <div class="col-sm-10 col-lg-4">
                            <input type="password"  name="password" class="form-control" autocomplete="new-password"placeholder="password"  required/>
                         </div>

            </div> <!-- END password faild  -->
            
            <!-- start email faild  -->
            <div class="form-group">
                    <label class="col-sm-2  control-label">email</label>
                        <div class="col-sm-10 col-lg-4">
                            <input type="email" name="email" autocomplete="off" class="form-control"placeholder="Email" required/>
                         </div>
            </div> <!-- END email faild  -->
           
            <!-- start fullname faild  -->
            <div class="form-group">
                    <label class="col-sm-2 control-label">fullName</label>
                        <div class="col-sm-10 col-lg-4">
                            <input type="text" name="full" class="form-control" autocomplete="off" placeholder="FullName"required/>
                         </div>
            </div><!-- END fullname faild  -->
            
            <!-- start user name faild  -->
            <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10 col-lg-4">
                             <h2 id="msg" class="text-center"><i class="fas fa-check"></i></h2>

                            <button onClick="ajax_insert('members.php?do=insert','#add_member')" class="btn btn-primary btn-lg" />Sign
                            Up</button>
                        </div>
            </div>
            <!-- ========================== -->
        </form>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo $style_path; ?>js/ajax-script.js"></script>