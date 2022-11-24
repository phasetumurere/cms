<form action="" method="post">
                                <div class="form-group">
                                    <label for="catTitles">Edit Category</label>
                                    
                                     <?php 
                                    if(isset($_GET['edit'])){
                                        $getCatId=$_GET['edit'];
                                        $query="SELECT * FROM categories WHERE cat_id = $getCatId";
                                        $allCategories=mysqli_query($connect,$query);
                                        while($row=mysqli_fetch_assoc($allCategories)){
                                            $catId=$row['cat_id'];
                                            $catName=$row['cat_title'];
                                            ?>
<input type="text" name="catTitles" class="form-control" value="<?php if(isset($catName)) echo $catName;?>">
                                      <?php }}?>

                             
                            <?php
                            if(isset($_POST['update'])){
                                $ogname=$_POST['catTitles'];
                                $query=" UPDATE categories SET cat_title = '{$ogname}' WHERE cat_id = $catId";
                                $updateCategory= mysqli_query($connect,$query);
                                if(!$updateCategory){
                                    die("Damn FAILED!!".mysqli_error($connect));
                                }

                            }                            
                        
                            ?>
                            </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update" value="UpdateCategory">
                                </div>
                            </form>