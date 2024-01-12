<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

  <div class="container mt-4">
<a class="btn btn-warning" href="<?php echo base_url() . '/Product'; ?>"> <i class="fas fa-angle-left"></i> Back</a>
    <form action="<?= base_url('Product/create') ?>" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Name</label>
        <input class="form-control" type="text" name="name">
    </div>
    <div class="form-group">
        <label>Slug</label>
        <input class="form-control" type="text" name="slug">
    </div>
    <div class="form-group">
        <label>Category</label>
        <input class="form-control" type="text" name="category">
    </div>
    <div class="form-group">
        <label>Image</label>
        <input class="form-control" type="file" name="image">
    </div>
    <div class="form-group">
        <label>Price</label>
        <input class="form-control" type="text" name="price">
    </div>
    <div class="form-group">
        <label>Discount</label>
        <input class="form-control" type="text" name="discount">
    </div>
    <div class="form-group">
        <label>Final Price</label>
        <input class="form-control" type="text" name="final_price">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success"> <i class="fas fa-check"></i> Submit </button>
    </div>
    </form>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
