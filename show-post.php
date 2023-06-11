<?php require('inc/header.php'); ?>
<?php require('inc/navbar.php'); ?>


<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id =1;
}

 $query  = "SELECT  title , body FROM posts WHERE id =$id";
 $reslut = mysqli_query($conn,$query);
 if(mysqli_num_rows($reslut)==0)
 {
    http_response_code(404);
 }else{
    $post  = mysqli_fetch_assoc($reslut);
 }
 


?>

<div class="container-fluid pt-4">
    <div class="row">
        <?php if(isset($post)): ?>
        <div class="col-md-10 offset-md-1">
            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
                    <h3><?= $post['title'] ;?></h3>
                </div>
                <div>
                    <a href="index.php" class="text-decoration-none">Back</a>
                </div>
            </div>
            <div>
            <?= $post['body'] ;?>
            </div>
        </div>
        <?php else:echo "NOT POSTS FOUND " ; endif ;?>
    </div>
</div>

<?php require('inc/footer.php'); ?>