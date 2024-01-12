<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please do Registration here</h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-danger" role="alert"></div>
                        

                         <form id="ajaxForm" role="form" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Please enter Name" name="user_name" type="text" autofocus>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Please enter E-mail" name="user_email" type="email" autofocus>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter Password (Minimum 8 characters, at least one uppercase letter, one lowercase letter, one number, and one special character)" name="user_password" type="password" value="">
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter Age" name="user_age" type="number" value="">
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter 10-digit Mobile No" name="user_mobile" type="number" value="">
                                </div>

                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Register" name="register">

                            </fieldset>
                        </form>
                        <center><b>You have Already registered ?</b> <br></b><a href="<?php echo base_url('user/login_view'); ?>"> Please Login</a></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        var base_url_data = "<?php echo base_url(); ?>";
        $(document).ready(function () {
            $('#ajaxForm').submit(function (e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: base_url_data + 'user/register_user',
                    data: formData,
                    success: function (response) {
                        console.log(response);
                        var responseData = JSON.parse(response);

                    // Check the status and update the alert div accordingly
                    if (responseData.status === 'success') {
                        $('.alert').removeClass('alert-danger').addClass('alert-success');
                    } else {
                        $('.alert').removeClass('alert-success').addClass('alert-danger');
                    }

                    // Update the content of the alert div with the message
                    $('.alert').html(responseData.message);

                    // Handle any other actions based on the response
                },
                error: function (xhr, status, error) {
                    console.log("AJAX request failed:", status, error);
                }
                });
            });
        });
    </script>
</body>
</html>
