<?php

if(isset($_GET['postId'])){

    $postId=escape($_GET['postId']);

 

   } // 
$query="SELECT * FROM posts WHERE post_id=$postId";
$editPost=mysqli_query($connect,$query);
while($row=mysqli_fetch_assoc($editPost)){
    $id=$row['post_id'];
    $postOthor=$row['post_othor'];
    $title=$row['post_title'];
    $status=$row['post_status'];
    $image=$row['post_image'];
    $comment=$row['post_content'];
    $date=$row['post_date'];
    $tag=$row['post_tag'];
    $commentCount=$row['post_comment_count'];
    $postCategoryId=$row['post_cat_id'];
}
if(isset($_POST['update_post'])){
    $postOthor=$_POST['othor'];
    $postTitle=$_POST['post_title'];
    $updatePostCategoryId=$_POST['post_cat_id'];
    $postStatus=$_POST['post_status'];

    $postImage=$_FILES['post_image']['name'];
    $postImageTemp=$_FILES['post_image']['tmp_name'];

    $postTags=$_POST['post_tag'];
    $postContent=$_POST['post_content'];
    $postDate=date('d-m-y', strtotime($_POST['datePosted']));
    $postCommentCount=4;
    move_uploaded_file($postImageTemp,"./images/$postImage");


    if(empty($postImage)){
        $query = "SELECT * FROM posts WHERE post_id=$postId";
        $selectImage=mysqli_query($connect,$query);
        while($row = mysqli_fetch_array($selectImage)){
            $postImage=$row['post_image'];
        }
    }

    $query="UPDATE posts SET post_cat_id='$updatePostCategoryId', 
    post_title = '$postTitle', post_othor = '$postOthor', 
    post_date = now(), post_image = '$postImage', 
    post_content = '$postContent',
    post_tag = '$postTags',
    post_status = '$postStatus' WHERE post_id = $postId";
    $updatePost=mysqli_query($connect,$query);
    if(!$updatePost){
        die('Damn FAILED to UPDATE!'.mysqli_error($connect));
    }
    echo "<h3 class='bg-success'>PostUpdated. <a href='../post.php? postId=$id'>View Post</a> or <a href='./posts.php'>Edit more Post</a></h3>";
}
    
?>



<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="postOthor">Post Othor</label><br>
        <select name="othor" id="">
        <?php
        
        $query="SELECT * FROM users";
        $allUsers=mysqli_query($connect,$query);
        if(!$allUsers){
            die("FAILED!".mysqli_error($connect));
        }
        while($row=mysqli_fetch_assoc($allUsers)){
            $userId=$_row['user_id'];
            $postOthor=$row['username'];
            echo "<option value='$postOthor'>$postOthor</option>";
        }
        ?>
        
        </select>
    </div>
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $title?>" >
    </div>
    <div class="form-group">
        <label for="categoryId">Category</label><br>
        <select name="post_cat_id">
            <?php 
            
            $query="SELECT * FROM categories";
            $allCategories=mysqli_query($connect,$query);
            while($row=mysqli_fetch_assoc($allCategories)){
                $catId=$row['cat_id'];
                $catTitle=$row['cat_title'];
                echo"<option value='$catId'>$catTitle</option>";
            }

            ?>
            
        </select>

    </div>
    <div class="form-group">
        <label for="status">Post Status</label><br>

        <select name="post_status" id="">
            <option value="<?php echo $status?>"><?php echo $status?></option>
<?php
if($status == 'published')echo "<option value='draft'>Draft</option>";
else echo "<option value='published'>Publish</option>";
?>
            
        </select>
    </div>
    <div class="form-group">
        <label for="image">Post Image</label><br>
        <img width="100" src="./images/<?php echo $image;?>" >
        <input type="file" name="post_image"> 
    </div>
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea id="body" class="form-control" name="post_content" cols="30" rows="10"><?php echo $comment?> </textarea>
    </div>
    <div class="form-group">
        <label for="tag">Post Tag</label>
        <input value=" <?php echo $tag?>" type="text" class="form-control" name="post_tag">
    </div>
    <div class="form-group">
        <label for="tag">Date</label>
        <input  <?php echo $date?> type="date" class="form-control" name="datePosted">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="UPDATE">
    </div>
</form>