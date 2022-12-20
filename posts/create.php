<?php require "../includes/header.php";//require the common header file
   require "../config/config.php";//require the config file for database connection
?>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('../assets/img/praisethe.jpg')">
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
       <?php
       
        $categories=$conn->query("SELECT * FROM categories");//
        $categories->execute();//execute the query
        $category=$categories->fetchAll(PDO::FETCH_OBJ);
        if(isset($_POST['submit'])){//check if the form is submitted
            if($_POST['title']=='' OR $_POST['subtitle']=='' OR $_POST['body']==''
            OR $_POST['category_id']==''){//check if the title,subtitle,and body fields are filled
                echo "please fill in all provided fields";//if not, urge user to fill them
            }else{//if the required fields are filled

                //capture the relevant information
                $title = $_POST['title'];
                $subtitle = $_POST['subtitle'];
                $body = $_POST['body'];
                $category_id=$_POST['category_id'];
                $img= $_FILES['img']['name'];
                $user_id=$_SESSION['user_id'];//get the userID from the active session
                $user_name=$_SESSION['username'];//get the userName from the active session

                $dir='images/'.basename($img);//create path for the image directory

                $insert=$conn->prepare("INSERT INTO posts (title,subtitle,body,category_id,img,user_id,user_name)
                VALUES (:title, :subtitle, :body,:category_id,:img,:user_id,:user_name)");//SQL query to insert post to database
                $insert->execute(
                    [//bind the captured fields to the variables that'll be used in the SQL query
                        ':title'=>$title,
                        ':subtitle'=>$subtitle,
                        ':body'=>$body,
                        ':category_id'=>$category_id,
                        ':img'=>$img,
                        ':user_id'=>$user_id,
                        ':user_name'=>$user_name
                    ]
                );
                if(move_uploaded_file($_FILES['img']['tmp_name'],$dir)){//save the image of the post to the images directory
                    echo 'inserted';
                }
            }
        }
       ?>
                <!-- Main Content-->
        <div class="container px-4 px-lg-5">

            <form method="POST" action="create.php" enctype="multipart/form-data">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" />
               
            </div>

              <div class="form-outline mb-4">
                <input type="text" name="subtitle" id="form2Example1" class="form-control" placeholder="subtitle" />
            </div>

            <div class="form-outline mb-4">
                <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body" rows="8"></textarea>
            </div>

            <div class="form-outline mb-4">
                <select name="category_id" class="form-select" aria-label="Default select example">
                    <option selected>select category for post</option>
                    <?php foreach($category as $c){?>
                    <option value="<?php echo $c->id;?>"><?php echo $c->name;?></option><?php }?>
                </select>
            </div>  

             <div class="form-outline mb-4">
                <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
            </div>


              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
            </form>


           
        </div>
 <?php require "../includes/footer.php" //require the common footer file?>