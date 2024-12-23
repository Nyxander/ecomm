<?php

 //Connect to database
 require "conn.php";

    $new=$confirm="";
    if(isset($_POST['submit'])){
           
                    
        $new = ($_POST['new']);
        $confirm = ($_POST['confirm']);
          $email = ($_POST['email']);
          $key = ($_POST['key']);
                    
        if(!$new){
            echo'<div class="alert alert-danger absolue center text-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                        <span class="text-danger">Enter new password!</span>
                </div>';
            
        }else
        if(!$confirm){
            echo'<div class="alert alert-danger absolue center text-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                        <span class="text-danger">Confirm new password!</span>
                </div>';
        }else
        if($new !== $confirm){
            echo'<div class="alert alert-danger absolue center text-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                        <span class="text-danger">Password did not match!</span>
                </div>';
        }else
        {
            $pass = password_hash($new, PASSWORD_DEFAULT);
             //$pass = md5($new);
             
            $sql = "UPDATE staff SET
            
           
            pass = '$pass',
            activation = NULL
            WHERE mail = '$email' 
            ";
            
            $res = mysqli_query($conn, $sql);
            if($res == TRUE){
             $_SESSION['success']="true";
                header('Location:../index.php');
                //echo "<script type='text/javascript'> document.location = 'reset.php'; </script>";
                exit();
                
            }else{
                 echo'<div class="alert alert-danger absolue center text-center" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <span class="text-danger"><Oops! Your account could not be activated. Please recheck the link or contact the system administrator.</span>
                    </div>';
            }
            
          
        }
    }
?>
