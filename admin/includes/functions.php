<?php

function escape($string){
    global $connect;
return mysqli_real_escape_string($connect,$string);
}


function insertCategegories(){
    global $connect;
    if(isset($_POST['submit'])){
        $catTitle=escape($_POST['catTitle']);
        if($catTitle=="" || empty($catTitle)){
            echo "This field can't be empty";
        }else{
        $query="INSERT INTO categories(cat_title) VALUES ('$catTitle')";
        $addCategory=mysqli_query($connect,$query);
       if(!$addCategory){
           die("Damn FAILED!!".mysqli_error($connect));
            }
        }
    }
    
}

function displayAllCategories(){
  global $connect;
$query= "SELECT * FROM categories";// LIMIT 3: For limitting the categories to certain number
$allCategories=mysqli_query($connect,$query);
if(!$allCategories){
die("damn".mysqli_error($connect));
}
while($row=mysqli_fetch_assoc($allCategories)){
$catTitle=$row['cat_title'];
$catId=$row['cat_id'];
echo "<tr>";
echo "<td>$catId</td>";
echo "<td>$catTitle</td>";
echo "<td><a href='categories.php?cat_id=$catId'>delete</a></td>";//catching ID for deleting it
echo "<td><a href='categories.php?edit=$catId'>Edit</a></td>";//catching ID for deleting it
echo "</tr>";
    }  
}

function deleteCategory(){
    global $connect;
    if(isset($_GET['cat_id'])){
        $catId=$_GET['cat_id'];
      $query="DELETE FROM categories WHERE cat_id = $catId";
      $deleteCategory=mysqli_query($connect,$query);
    header("Location:categories.php");//for auto reload so that when you click for delete just click once
    }
}

function deletePost(){
    global $connect;
if(isset($_GET['delete'])){
    $getId=$_GET['delete'];
    $query="DELETE FROM posts WHERE post_id=$getId";
    $deleteCategory=mysqli_query($connect,$query);
    header("location:posts.php");
}
}

function postViewsCount(){
    global $connect;
    
}
?>