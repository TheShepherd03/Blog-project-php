<?php require "../includes/header.php";//require the common header file
    require "../config/config.php";//require the config file for database connection

    if(isset($_GET['post_id'])){//check if there is a postID
        $id=$_GET['post_id'];//capture postID
        $getpost=$conn->prepare("SELECT * FROM posts WHERE id = '$id'");//query database for post with this specific postID
        $getpost->execute();//execute the query
        $post=$getpost->fetch(PDO::FETCH_OBJ);//capture data from the query
    }else{echo "No post found";}//if there is no postID provided, print out no post was found
    
?>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('images/<?php echo $post->img;//display post picture?>')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1><?php echo $post->title;//print out postTitle ?></h1>
                            <h2 class="subheading"><?php echo $post->subtitle//print out postSubtitle?></h2>
                            <span class="meta">
                                Posted by
                                <a href="#!"><?php echo $post->user_name;//print out who wrote the post ?></a>
                                <?php echo "on ".date('M',strtotime($post->creation_date))." ".date('d',strtotime($post->creation_date))." ".date('Y',strtotime($post->creation_date));//formatted date of post creation ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <p><?php echo $post->body;//print out the post body?></p>
                        <?php if(isset($_SESSION['user_id']) AND $_SESSION['user_id']==$post->user_id){?>
                        <a class="btn btn-danger text-center" href="delete.php?delete_id=<?php echo $post->id;?>">Delete</a>            
                        <a class="btn btn-info text-center" href="update.php?update_id=<?php echo $post->id;?>">Update</a>       
                        <?php }?>
                    </div>
                    
                </div>
            </div>
        </article>
 <?php require "../includes/footer.php"//require the common footer file?>
