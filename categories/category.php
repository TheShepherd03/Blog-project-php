<?php
require "../includes/header.php";?>
<?php require "../config/config.php";

if(isset($_GET['category_id'])){
    $cat_id=$_GET['category_id'];
    $posts=$conn->query("SELECT posts.id AS id,posts.title AS title,posts.subtitle
     AS subtitle,posts.user_name AS username,posts.creation_date
      AS creation_date,posts.category_id AS category_id 
      FROM categories JOIN posts ON categories.id=posts.category_id 
      WHERE categories.id='$cat_id'");//SQL query to get all posts from the database
    $posts->execute();//execute the query
    $rows=$posts->fetchAll(PDO::FETCH_OBJ);

}
?>

<div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-12 col-lg-8 col-xl-7">
                    <!-- Post preview-->
                    <?php foreach ($rows as $row){//for each data row returned from the query?>
                    <div class="post-preview">
                        <a href="../posts/post.php?post_id=<?php echo $row->id;//print out the postID?>">
                            <h2 class="post-title"><?php echo $row->title;//print out the postTitle?></h2>
                            <h3 class="post-subtitle"><?php echo $row->subtitle;//print out the postSubtitle?></h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!"><?php echo $row->username;//print out the userName of the user who created the post?></a>
                            <?php echo "on ".date('M',strtotime($row->creation_date))." ".date('d',strtotime($row->creation_date))." ".date('Y',strtotime($row->creation_date));//format the timestamp and print it out ?>
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                    <?php }?>
                    <!-- Pager-->
                    
                </div>
</div>


<?php 
require "../includes/footer.php";
?>