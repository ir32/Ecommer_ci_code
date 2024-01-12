
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <div class="header">
            <h1>Edit</h1>
        </div>
        <div class="content">
            <?php echo anchor(base_url('Product'), 'Back', array('class' => 'btn btn-secondary mb-3')); ?>

            <form action="<?= base_url('Product/update') ?>" method="post" enctype="multipart/form-data">
                <table class="table">
                    <tr>
                        <td>Name</td>
                        <td><input class="form-control" type="text" name="name" value="<?= $upload->name ?>"></td>
                    </tr>
                    <tr>
                        <td>Slug</td>
                        <td><input class="form-control" type="text" name="slug" value="<?= $upload->slug ?>"></td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td><input class="form-control" type="text" name="category" value="<?= $upload->category ?>"></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><input class="form-control" type="text" name="price" value="<?= $upload->price ?>"></td>
                    </tr>
                    <tr>
                        <td>Discount</td>
                        <td><input class="form-control" type="text" name="discount" value="<?= $upload->discount ?>"></td>
                    </tr>
                    <tr>
                        <td>Final Price</td>
                        <td><input class="form-control" type="text" name="final_price" value="<?= $upload->final_price ?>"></td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td>
                            <input class="form-control" type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <img src="<?= base_url() ?>assets/upload/images/<?= $upload->image ?>" width="160px" alt="<?= $upload->image ?>">
                        </td>
                    </tr>
                    <tr>
                        <input type="hidden" name="id" value="<?= $upload->id ?>">
                        <td></td>
                        <td><input class="btn btn-primary" type="submit" value="Submit"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
