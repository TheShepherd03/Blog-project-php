<?php require "../includes/header.php";//require the common header file
  require "../config/config.php";//require the config file for database connection
  
  if(isset($_SESSION['username'])){
    header("Location:../index.php");//if there is a logged in user redirect to index page
  }
  if(isset($_POST['submit'])){//check if submit button is clicked
    if($_POST['email']=='' OR $_POST['password']==''){//check if email is entered,and password
      echo "Please fill in all provided fields";//if either of the fields is empty,urge user to fill them in
    }else{
      //take all relevant data
      $email=$_POST['email'];
      $password=$_POST['password'];

      //write login query
      $login=$conn->query("SELECT * FROM users WHERE email = '$email'");
      //execute query and fetch data
      $login->execute();
      $row=$login->FETCH(PDO::FETCH_ASSOC);

      if($login->rowCount()>0){
        //verify pass and redirect logged in user
        if(password_verify($password, $row['userpass'])){
            $_SESSION['username']=$row['username'];
            $_SESSION['user_id']=$row['id'];
            header("Location:../index.php");
        }else{echo "invalid credentials";}
      }
    }
  }

  

  

  

  
?>
<!-- Page Header-->
        <header class="masthead" style="background-image: url('../assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>TheBlogSpot</h1>
                           
                        </div>
                    </div>
                </div>
            </div>
        </header>
       
                <!-- Main Content-->
        <div class="container px-4 px-lg-5">

               <form method="POST" action="login.php">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                   
                  </div>

                  
                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                    
                  </div>



                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                  <!-- Register buttons -->
                  <div class="text-center">
                    <p>a new member? Create an acount<a href="register.php"> Register</a></p>
                    

                   
                  </div>
                </form>

           
        </div>
<?php require "../includes/footer.php"//require the common footer file?>