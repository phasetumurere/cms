<?php

if (isset($_POST['create_post'])) {
    $postOthor = escape($_POST['post_othor']);
    $postTitle = escape($_POST['post_title']);
    $postCategoryId = escape($_POST['post_cat_id']);
    $postStatus = escape($_POST['post_status']);

    $postImage = $_FILES['post_image']['name'];
    $postImageTemp = $_FILES['post_image']['tmp_name'];

    $postTags = escape($_POST['post_tag']);
    $postContent = escape($_POST['post_content']);
    $postDate = date('d-m-y', strtotime($_POST['datePosted']));
    // $postCommentCount=4;

    move_uploaded_file($postImageTemp, "./images/$postImage");

    $query = "INSERT INTO posts (post_cat_id, post_title, post_othor, post_date, post_image, post_content, post_tag, post_status)
     VALUES ('$postCategoryId', '$postTitle', '$postOthor', '$postDate', '$postImage', '$postContent', '$postTags', '$postStatus')";
    $addPostQuery = mysqli_query($connect, $query);
    // if(!$query){
    //     die('DAMN FAILED'.mysqli_error($connect));
    //     }else{
    //         echo "inserted successifully";
    //     }
    $individualPostId = mysqli_insert_id($connect);
    echo "<p class='bg-success'>Post " . $postTitle . " inserted Successifully <a href='../post.php?postId=$individualPostId'>View the Posts</a> </p>";
    // echo "<h3 class='bg-success'>PostUpdated. <a href='../post.php? postId=$id'>View Post</a> or <a href='./posts.php'>Edit more Post</a></h3>";

}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="postOthor">Post Othor</label><br>
        <select name="post_othor" id="">
            <?php

            $query = "SELECT * FROM users";
            $allUsers = mysqli_query($connect, $query);
            if (!$allUsers) {
                die("FAILED!" . mysqli_error($connect));
            }
            while ($row = mysqli_fetch_assoc($allUsers)) {
                $userId = escape($_row['user_id']);
                $postOthor = escape($row['username']);
                echo "<option value='$postOthor'>$postOthor</option>";
            }
            ?>

        </select>
    </div>
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="categoryId">Category</label><br>
        <select name="post_cat_id">
            <?php

            $query = "SELECT * FROM categories";
            $allCategories = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_assoc($allCategories)) {
                $catId = $row['cat_id'];
                $catTitle = $row['cat_title'];
                echo "<option value='$catId'>$catTitle</option>";
            }

            ?>

        </select>

    </div>

    <div class="form-group">
        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="draft">Draft</option>
            <option value="published">Publish</option>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea id="body" class="form-control" name="post_content" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label for="tag">Post Tag</label>
        <input type="text" class="form-control" name="post_tag">
    </div>
    <div class="form-group">
        <label for="tag">Date</label>
        <input type="date" class="form-control" name="datePosted">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish">
    </div>
</form>