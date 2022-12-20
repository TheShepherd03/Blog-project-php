<?php require "../Blog-project-php/includes/header.php";//we start with requesting the common header(containing the navigation)

    require "../Blog-project-php/config/config.php";//the config file for database connections


    $posts=$conn->query("SELECT * FROM posts");//SQL query to get all posts from the database
    $posts->execute();//execute the query
    $rows=$posts->fetchAll(PDO::FETCH_OBJ);//capture the data from the query

    $categories=$conn->query("SELECT * FROM categories");//
    $categories->execute();//execute the query
    $category=$categories->fetchAll(PDO::FETCH_OBJ);//capture the data from the query

?>

        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/home-bg.png')">
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
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- Post preview-->
                    <?php foreach ($rows as $row){//for each data row returned from the query?>
                    <div class="post-preview">
                        <a href="../Blog-project-php/posts/post.php?post_id=<?php echo $row->id;//print out the postID?>">
                            <h2 class="post-title"><?php echo $row->title;//print out the postTitle?></h2>
                            <h3 class="post-subtitle"><?php echo $row->subtitle;//print out the postSubtitle?></h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!"><?php echo $row->user_name;//print out the userName of the user who created the post?></a>
                            <?php echo "on ".date('M',strtotime($row->creation_date))." ".date('d',strtotime($row->creation_date))." ".date('Y',strtotime($row->creation_date));//format the timestamp and print it out ?>
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                    <?php }?>
                    <!-- Pager-->
                    
                </div>
            </div>
        </div>
        
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <h3 class="text-center">Categories</h3>
        <?php foreach($category as $c){?>
            <div class="col-md-7">
                <a href="../Blog-project-php/categories/category.php?category_id=<?php echo $c->id;?>">
                    <div class="alert alert-primary bg-dark text-center text-white " role="alert">
                            <?php echo $c->name;?>
                    </div>
                </a>
            </div>
            <?php }?>
        </div>
        <?php require "../Blog-project-php/includes/footer.php" //the common footer file?>