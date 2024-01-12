<?php
$user_id= $this->session->userdata('user_id');
// echo '<pre>';print_r($user_id);
// if (isset($user_data) && !empty($user_data)) {
//     echo '<pre>';print_r($user_data);die("hi model adassdasdasdasdasdasdasdasdasdasdasd");

// } else {
//     echo '<p>No user data found</p>';
// }

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>User Profile Dashboard-CodeIgniter Login Registration</title>
    <link rel="stylesheet"  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>

  <body>

<div class="container">
    <?= anchor('Product/', 'Product', ['class' => 'btn btn-primary mb-2']) ?>
  <div class="row">
        <div class="col-md-4">
            <table class="table table-bordered table-striped">
                <tr>
                    <th colspan="2"><h4 class="text-center">User Details</h4></th>
                </tr>
                <tr>
                    <td>User Name</td>
                    <td><?php echo $user_data['user_name']; ?></td>
                </tr>
                <tr>
                    <td>User Email</td>
                    <td><?php echo $user_data['user_email']; ?></td>
                </tr>
                <tr>
                    <td>User Age</td>
                    <td><?php echo $user_data['user_age']; ?></td>
                </tr>
                <tr>
                    <td>User Mobile</td>
                    <td><?php echo $user_data['user_mobile']; ?></td>
                </tr>
            </table>
        </div>
  </div>
    <a href="<?php echo base_url('user/user_logout'); ?>">
        <button type="button" class="btn btn-primary">Logout</button>
    </a>
</div>
  </body>
</html>