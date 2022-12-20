<?php require "../includes/header.php";//require the common header file
   require "../config/config.php";//require the config file for database connections

    if(isset($_SESSION['username'])){//if there is a user logged in, redirect to index page
      header("Location:../index.php");
    }
  if(isset($_POST['submit'])){//check if the form is submitted
    if($_POST['email']=='' OR $_POST['username']=='' OR $_POST['password']==''){//check if the email,username,and password are filled
      echo 'please fill in the given fields';//if any of these field is not filled,urge user to fill them in
    }else{//if the email,username,password are filled
      //capture the relevant information
      $email = $_POST['email'];
      $username = $_POST['username'];
      $password = password_hash($_POST['password'],PASSWORD_DEFAULT);//hash the password(encrypt)

      $insert=$conn->prepare("INSERT INTO users (email,username,userpass)
      VALUES(:email,:username,:password)");//SQL query to insert the new user into the database
      $insert->execute(
        [':email'=>$email,
        ':username'=>$username,
        ':password'=>$password]
      );//bind the captured information to the values to be used in the SQL query
      header("location: login.php");//when redirect user to index page
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
                            <span class="subheading">You got a thought that you think is interesting?, Register and start blogging.</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
       
                <!-- Main Content-->
        <div class="container px-4 px-lg-5">

            <form method="POST" action="register.php">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="" name="username" id="form2Example1" class="form-control" placeholder="Username" />
               
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                
              </div>



              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Register</button>

              <!-- Register buttons -->
              <div class="text-center">
                <p>Aleardy a member? <a href="login.php">Login</a></p>
                

               
              </div>
            </form>


           
        </div>
 <?php require "../includes/footer.php"//require the common footer file?>