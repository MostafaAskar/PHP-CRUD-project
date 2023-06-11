<?php require('inc/header.php'); ?>
<?php require('inc/navbar.php'); ?>


<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
else{ 
    header('location: index.php');
}

$query = " SELECT title , body from posts where id=$id";
$result = mysqli_query($conn ,$query);
if(mysqli_num_rows($result)==0){
http_response_code(404);
}
else{
$post = mysqli_fetch_assoc($result);
}

?>


<div class="container-fluid pt-4">
    <div class="row">
    <?php if(isset($post)){?>

        <div class="col-md-6 offset-md-3">
            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
                    <h3>Edit post</h3>
                </div>
                <div>
                    <a href="index.php" class="text-decoration-none">Back</a>
                </div>
            </div>
            <?php if(isset($_SESSION['errors'])){ ?>
                    <div class="alert alert-danger">
                        <?php foreach($_SESSION['errors'] as $errors): ?>
                        <p> <?=$errors;?> </p>
                         <?php endforeach; ?>   
                 </div>

           <?php } unset($_SESSION['errors']);?>
            <form method="POST" action="update-post.php">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $post['title'];?>">
                </div>

                <div class="mb-3">
                    <label for="body" class="form-label">Body</label>
                    <textarea class="form-control" id="body" name="body" rows="5"><?= $post['body'];?></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
        </div>
    <?php }else{header('location: index.php');} ?>
</div>

<?php require('inc/footer.php'); ?>