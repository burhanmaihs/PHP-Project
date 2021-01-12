<?php

   include"inc/header.php";

?>

 <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <!-- page content starts from here -->
                        <?php

                        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

                        if($do == 'Manage'){
                            ?>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table mr-1"></i>
                                    All Books Data
                                </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Serial</th>
                                                <th>Thumbnail</th>
                                                <th>Name</th>
                                                <th>Description</th>       
                                                <th>Category</th>
                                                <th>Author</th>
                                                <th>Status</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot> 
                                            <tr>
                                                <th>Serial</th>
                                                <th>Thumbnail</th>
                                                <th>Name</th>
                                                <th>Description</th>       
                                                <th>Category</th>
                                                <th>Author</th>
                                                <th>Status</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody> 

                                            <?php

                                            $sql2 = "SELECT * FROM books";
                                            $result2 = mysqli_query($db,$sql2);
                                            $i = 0;

                                            while ($row = mysqli_fetch_assoc($result2)) {
                                                $b_id               = $row['b_id'];
                                                $b_name             = $row['b_name'];
                                                $b_desc             = $row['b_desc'];
                                                $b_thumbnail_photo  = $row['b_thumbnail_photo'];
                                                $b_cat              = $row['b_cat'];
                                                $b_author           = $row['b_author'];
                                                $b_status           = $row['b_status'];
                                                $b_quantity         = $row['b_quantity'];
                                                $i++;

                                                ?>

                                                <tr>   
                                                    <td><?php echo $i;?></td>         
                                                    <td>
                                                        <img src="img/books/<?php echo $b_thumbnail_photo;?>" width='120' class='rounded'>
                                                    </td>         
                                                    <td><?php echo $b_name;?></td>         
                                                    <td>
                                                        <?php 
                                                        echo substr($b_desc, 0, 100);
                                                        ?>
                                                            
                                                    </td>         
                                                    <td>
                                                        <?php 

                                                        $sql3 = "SELECT c_name FROM category WHERE c_id='$b_cat'";
                                                        $result3 = mysqli_query($db,$sql3);

                                                        while ($row = mysqli_fetch_assoc($result3)){
                                                            $cat_name = $row['c_name'];
                                                        }
                                                        echo $cat_name;

                                                        ?>
                                                            
                                                    </td>         
                                                    <td>
                                                       <?php 

                                                        $sql4 = "SELECT u_name FROM users WHERE u_id='$b_author'";
                                                        $result4 = mysqli_query($db,$sql4);

                                                        while ($row = mysqli_fetch_assoc($result4)) {
                                                            $user_name = $row['u_name'];
                                                        }
                                                        echo $user_name;

                                                        ?>
                                                    </td>         
                                                    <td>
                                                        <?php 

                                                        if($b_status == 1){
                                                            echo '<span class="badge badge-success">Active</span>';
                                                        }else if($b_status == 0){
                                                             echo '<span class="badge badge-warning">Pending</span>';
                                                        }

                                                        ?>
                                                            
                                                    </td>         
                                                    <td><?php echo $b_quantity ;?></td>
                                                    <td>
                                                        <a href="books.php?do=edit&editBooks=<?php echo $b_id;?>" type="button" class="btn btn-sm btn-dark">
                                                            Edit
                                                        </a>
                                                        <a href="" type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete<?php echo $b_id;?>">
                                                            Delete
                                                        </a>
                                                    </td>         
                                        <!-- modal code -->
                        <!-- The Modal -->
                        <div class="modal" id="delete<?php echo $b_id;?>">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h5 class="modal-title">Confirm Your Action</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">
                                <center>
                                    <a href="books.php?do=delete&deleteId=<?php echo $b_id;?>">
                                        <button class="btn btn-md btn-danger">YES</button>
                                    </a>
                                    <a href="#">
                                        <button class="btn btn-md btn-success">NO</button>
                                    </a>
                                </center>
                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              </div>

                            </div>
                          </div>
                        </div>
                                                                                                
                                            </tr>

                                                <?php
                                                
                                            }

                                            ?>

                                               
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                            <?php

                        }else if($do == 'add'){
                            ?>


                            <div class="card">
                                 <div class="card-body">
                                   <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <div class="form-group">
                                                <label for="text">Book Title</label>
                                                <input type="text" class="form-control" placeholder="Title" name="title">
                                            </div>
                                            <div class="form-group">
                                                <label>Book Description:</label>
                                                <textarea rows="10" cols="10" class="form-control" placeholder="Book Description" name="description"></textarea>
                                            </div>    
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Select Book Thumbnail:</label>
                                                <input type="file" name="thumbnail">
                                            </div>
                                            <div class="form-group">
                                                 <span>Select Category:</span>
                                                <div class="form-check" style="margin-top: 30px ">

                    <?php 

                    $sql = "SELECT * FROM category";
                    $result = mysqli_query($db,$sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $cat_id   = $row['c_id'];
                        $cat_name = $row['c_name'];
                        $cat_desc = $row['c_desc'];

                        ?>

                        <label class="form-check-label">
                          <input class="form-check-input" name="category" type="checkbox" value="<?php echo $cat_id;?>"> <?php echo $cat_name;?>
                        </label> <br>


                        <?php
                    }

                    ?>  

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="text">Book Quantity</label>
                                                <input type="text" class="form-control" placeholder="Enter Book Quantity" name="quantity">
                                            </div>
                                            <button type="submit" class="btn btn-success" name="addbook">Publish</button>
                                        </div>
                                    </div>
                                    </form>  

            <!-- add new book -->
            <?php 

            if(isset($_POST['addbook'])){
                $title       = $_POST['title'];
                $description = $_POST['description'];
                $category    = $_POST['category'];
                $quantity    = $_POST['quantity'];


                // book thumbnail
                $file_name   = $_FILES['thumbnail']['name'];
                $file_tmp    = $_FILES['thumbnail']['tmp_name'];



                if(empty($title) || empty($description) || empty($category) || empty($file_name)){

                    echo "<div class='alert alert-danger'>Fill All Information!</div>";
                }else{

                    $extn = strtolower(end(explode('.', $file_name)));
                    //universal image type array
                    $extensions = array('jpeg','jpg','png');

                    if(in_array($extn, $extensions) == false ){
                        //this file dose not contain an image
                        echo "<div class='alert alert-danger'>Fill Upload an Image!</div>";

                    }else{
                        $random     = rand();
                        $updateName = $random."_".$file_name;

                        move_uploaded_file($file_tmp, "img/books/".$updateName);

                        $sql = "INSERT INTO books (b_name,b_desc,b_thumbnail_photo,b_cat,b_author,b_status,b_quantity) VALUES ('$title','$description','$updateName', '$category', 'admin' , 0,'$quantity')";
                        $result = mysqli_query ($db,$sql);

                        if($result){
                            header('Location:books.php');
                        }else{
                            die("Book Publish Error!".mysqli_error($db));
                        }

                    }

                   
                }

            }



            ?>



                                 </div>
                             </div>


                            <?php

                        }else if($do == 'edit'){

                            if(isset($_GET['editBooks'])){

                                $edit_book = $_GET['editBooks'];


                                $sql5 = "SELECT * FROM books WHERE b_id = '$edit_book'";
                                $result5 = mysqli_query($db,$sql5);
                                            $i = 0;

                                while ($row = mysqli_fetch_assoc($result5)) {
                                    $b_id               = $row['b_id'];
                                    $b_name             = $row['b_name'];
                                    $b_desc             = $row['b_desc'];
                                    $b_thumbnail_photo  = $row['b_thumbnail_photo'];
                                    $b_cat              = $row['b_cat'];
                                    $b_author           = $row['b_author'];
                                    $b_status           = $row['b_status'];
                                    $b_quantity         = $row['b_quantity'];
                                }
                                ?>
<div class="card">
    <div class="card-body">
        <form action="books.php?do=update" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6"> 
                    <div class="form-group">
                        <label for="text">Book Title</label>
                        <input type="text" class="form-control" placeholder="Title" name="title" value="<?php echo $b_name;?>">
                    </div>
                    <div class="form-group">
                        <label>Book Description:</label>
                        <textarea rows="10" cols="10" class="form-control" placeholder="Book Description" name="description" value="<?php echo $b_desc;?>"><?php echo $b_desc;?></textarea>
                    </div>    
                </div>
                <div class="col-md-6">
                    <div>
                        <img src="img/books/<?php echo $b_thumbnail_photo;?>" width='300px'>
                    </div>
                    <div class="form-group">
                        <label>Select Book Thumbnail:</label>
                        <input type="file" name="thumbnail">
                    </div>
                    <div class="form-group">
                         <span>Select Category:</span>
                        <div class="form-check" style="margin-top: 30px ">

<?php 

$sql = "SELECT * FROM category";
$result = mysqli_query($db,$sql);

while ($row = mysqli_fetch_assoc($result)) {
$cat_id   = $row['c_id'];
$cat_name = $row['c_name'];
$cat_desc = $row['c_desc'];

?>

<label class="form-check-label">
  <input class="form-check-input" name="category" type="checkbox" value="<?php echo $cat_id;?>" <?php if($cat_id == $b_cat){echo 'checked';}?>> <?php echo $cat_name;?>
</label> <br>


<?php
}

?>  

                        </div>
                    </div>  
                    <div class="form-group">
                        <span>BookStatus</span>
                        <select class="form-control" name="status">
                            <option value="0" <?php if($b_status==0){echo 'selected';}?>>Pending</option>
                            <option value="1" <?php if($b_status==1){echo 'selected';}?>>Active</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="text">Book Quantity</label>
                        <input type="text" class="form-control" placeholder="Enter Book Quantity" name="quantity">
                    </div>
                    <input type="hidden" name="book_id" value="<?php echo $edit_book;?>">
                    <button type="submit" class="btn btn-success" name="editbook">Publish</button>
                </div>
            </div>
            </form>
    </div>
</div>



                                <?php
                            }



                        }else if($do == 'update'){


                            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                                $title       = $_POST['title'];
                                $book_id     = $_POST['book_id'];
                                $description = $_POST['description'];
                                $category    = $_POST['category'];
                                $status      = $_POST['status'];
                                $quantity    = $_POST['quantity'];

                                // book thumbnail
                                $file_name   = $_FILES['thumbnail']['name'];
                                $file_tmp    = $_FILES['thumbnail']['tmp_name'];
                                if(!empty($file_name)){

                                    $extn = strtolower(end(explode('.', $file_name)));
                                    //universal image type array
                                    $extensions = array('jpeg','jpg','png');

                                    if(in_array($extn, $extensions) == false ){
                                        //this file dose not contain an image
                                        echo "<div class='alert alert-danger'>Fill Upload an Image!</div>";

                                    }else{
                                        $random     = rand();
                                        $updateName = $random."_".$file_name;

                                        move_uploaded_file($file_tmp, "img/books/".$updateName);
                                        $query = "UPDATE books SET b_name='$title', b_desc='$description', b_thumbnail_photo='$updateName',b_cat='$category', b_status='$status',b_quantity='$quantity' WHERE b_id='$book_id'";
                                        $result = mysqli_query($db,$query);

                                        if($result){
                                            header('Location:books.php');
                                        }else{
                                            die("Book Publish Error!".mysqli_error($db));
                                        }
                                    }

                                }else{

                                    $query = "UPDATE books SET b_name='$title', b_desc='$description',b_cat='$category', b_status='$status',b_quantity='$quantity' WHERE b_id='$book_id'";
                                        $result = mysqli_query($db,$query);

                                        if($result){
                                            header('Location:books.php');
                                        }else{
                                            die("Book Publish Error!".mysqli_error($db));
                                        }


                                }

                            }

                        }else if($do == 'delete'){
                            //book delete from here
                            if(isset($_GET['deleteId'])){
                                $delete_book_id = $_GET['deleteId'];

                                //delete books image

                                $sql       = "SELECT b_thumbnail_photo FROM books WHERE b_id = '$delete_book_id'";

                                $result    = mysqli_query($db,$sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $photo = $row['b_thumbnail_photo'];
                                }

                                //delete photo
                                unlink('img/books/'.$photo);


                                $table     = 'books';
                                $table_id  = 'b_id';
                                $item_id   = $delete_book_id;
                                $url       = 'books.php';

                                delete($table,$table_id,$item_id,$url);

                            }

                        }



                        ?>
                         
                    </div>
                </main>
<?php

   include"inc/footer.php";

?>
