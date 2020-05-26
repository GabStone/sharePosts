<?php require APPROOT . '/views/inc/header.php'; ?>

    <a class="btn btn-light" href="<?php echo URLROOT ?>/posts">
        <i class="fa fa-backward"></i>
        Back
    </a>
    <div class="card card-body bg-light mt-5">
        <h2>Add Post</h2>
        <p>Create a new post</p>
        <form action="<?php echo URLROOT; ?>/posts/add" method="post">

            <div class="form-group">
                <label for="title">Title: <sup>*</sup></label>
                <input type="text" name="title" value="<?php echo $data['title'] ?>" class="form-control form-control-lg
                    <?php echo (!empty($data['titleErr'])) ? 'is-invalid' : ''?>">
                <span class="invalid-feedback"><?php echo $data['titleErr'] ?></span>
            </div>

            <div class="form-group">
                <label for="body">Body: <sup>*</sup></label>
                <textarea name="body" class="form-control form-control-lg
                    <?php echo (!empty($data['bodyErr'])) ? 'is-invalid' : ''?>">

                    <?php echo $data['body'] ?>
                </textarea>
                <span class="invalid-feedback"><?php echo $data['bodyErr'] ?></span>
            </div>

            <input type="submit" value="submit" class="btn btn-success">

        </form>
    </div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
