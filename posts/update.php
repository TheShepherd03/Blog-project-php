<?php require "../includes/header.php";//require the common header file
    require "../config/config.php";//require the config file for database connection
    if(isset($_GET['update_id'])){//check if the update_id is present
      $upID=$_GET['update_id'];//capture the update_id
      $select=$conn->prepare("SELECT * FROM posts WHERE id=:id");//SQL select query to select post to update
      $select->execute(
        [':id'=>$upID]//bind the relevant parameters
      );
      $post=$select->fetch(PDO::FETCH_OBJ);//capture data from the query

      if($_SESSION['user_id'] != $post->user_id){//check if the logged in user_id is equal to the post's update_id
        header("Location:../index.php");//if not, redirect to index page
      }
    

    if(isset($_POST['submit'])) { //check if the form is submitted
      if($_POST['title'] == '' or $_POST['subtitle'] == '' or $_POST['body'] == '') { //check if the title,subtitle,and body fields are filled
        echo "please fill in all provided fields"; //if not, urge user to fill them
      } else{ //if the required fields are filled
        unlink("images/".$post->img."");//remove the old post picture from our directory
        //capture the relevant information
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $body = $_POST['body'];
        $img=$_FILES['img']['name'];
        $dir='images/'.basename($img);


        $update = $conn->prepare("UPDATE posts SET title = :title, subtitle = :subtitle, body = :body,img=:img WHERE id = '$upID'"); //SQL query to update post to database
        $update->execute(
          [ //bind the captured fields to the variables that'll be used in the SQL query
            ':title' => $title,
            ':subtitle' => $subtitle,
            ':body' => $body,':img'=>$img
            
          ]
        );
        if(move_uploaded_file($_FILES['img']['tmp_name'],$dir)){//after saving the updated post picture in our directory, redirect to index page
          header("location:../index.php");
        }
        
      }
    }
  }
?>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('images/<?php echo $post->img;?>')">
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

            <form method="POST" action="update.php?update_id=<?php echo $upID;?>" enctype="multipart/form-data">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="title" value="<?php echo $post->title; ?>" id="form2Example1" class="form-control" placeholder="title" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="subtitle" value="<?php echo $post->subtitle; ?>" id="form2Example1" class="form-control" placeholder="subtitle" />
            </div>

            <div class="form-outline mb-4">
                <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body" rows="8"><?php echo $post->body; ?></textarea>
            </div>

             <div class="form-outline mb-4">
                <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
            </div>


              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>

          
            </form>


           
        </div>
        
<?php require "../includes/footer.php"//require the common footer file?>