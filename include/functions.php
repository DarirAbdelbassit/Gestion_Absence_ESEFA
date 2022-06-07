<?php

   //***********Professeur Validation Functions********** */

   function login(){
       
       if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
       {

        global $conn;
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $email=htmlspecialchars($email);
        $password=htmlspecialchars(md5($password));
        
        if( user_login($email,$password)){ 
            
            if(isset($_POST['check']))
            {
                setcookie('email',$email,time() + 365*24*3600,null,null,false,true);
                setcookie('password',$_POST['password'],time() + 365*24*3600,null,null,false,true);
            }
             header("Location:home1.php?id_professor=".$_SESSION['id_professor']);
        }
        else 
         echo'<div class="alert alert-danger">Courriel ou mot de passe erroné</div>';
      }
      
   }
   // user
   function user_login($email, $password)
   {
    global $conn;
    $sql = "SELECT * FROM professor WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if ($row['email'] === $email && $row['password'] === $password) {
                    $_SESSION['id_professor'] = $row['id_professor'];
                    return true;
                }
            }
   }
?>