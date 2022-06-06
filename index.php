<?php include('./include/connect.php');
 session_start();

 error_reporting(0);
 
 if (isset($_SESSION['email'])) {
     header("Location: home1.php");
 }
   if(isset($_POST['submit'])){

    $email=htmlspecialchars($_POST['email']);
    $password=htmlspecialchars(md5($_POST['password']));
      $sql = "SELECT * FROM professor WHERE email = '$email' AND password = '$password'";
      $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result) === 1) {
              $row = mysqli_fetch_assoc( $result);
            if ($row['email'] === $email && $row['password'] === $password) {
              $id_professor = $row['id_professor'];
              $_SESSION['id_professor'] = $id_professor;
              header("Location: home1.php?id_professor=".$id_professor);
            }
             
      } 
     else{
      $msg = '<div class="alert alert-danger">Courriel ou mot de passe erroné</div>';
        } 
     
  }
  if(isset($_POST['check'])){
    setcookie('email',$email,time() + 365*24*3600,null,null,false,true);
    setcookie('password',$_POST['password'],time() + 365*24*3600,null,null,false,true);
  }
 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ESEFA</title>
    <link rel="stylesheet" href="css/login.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="js/bootstrap.bundle.min.js" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css"
    />
  </head>
  <body>
    <div class="main">
      <div class="container">
        <div
          class="row"
          style="align-items: center; display: flex; justify-content: center"
        >
          <div class="col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6">
            <!--offset ==> move to the right the divs-->
            <form class="form_horizontal" method="POST" style="background-color: rgba(0,0, 0, 0.4);padding: 2rem;border-radius: 31px;border: 1px solid rgb(252, 95, 4);">
              <div class="form_icon"><i class="fa fa-user-circle"></i></div>
              <h3 class="title">Bienvenue</h3>
              <?php echo $msg;?>
              <div class="form-group">
                <span class="input-icon" ><i class="fa fa-user" style="color: rgb(252, 95, 4);"></i></span>
                <input
                  class="form-control"
                  type="email"
                  name="email"
                  placeholder="Email"
                  value="<?php  if(isset($_COOKIE['email'])) echo $_COOKIE['email']; else echo''; ?>"
                  required
                />
                <br />
              </div>
              <div class="form-group">
                <span class="input-icon"><i class="fa fa-lock" style="color: rgb(252, 95, 4);"></i></span>
                <input
                  class="form-control"
                  type="password"
                  name="password"
                  placeholder="Password"
                  value="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password']; else echo'';?>"  
                  required
                />
              </div>
              <center >
              <input type="checkbox" name="check" id="check">
              <label for="check" style="font-weight: bolder;color: white;">se souvenir de moi</label>
              </center>
              <br />
              <button name="submit" class="btn btn-primary " style="height: 39px;border: none;">Entrer</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

