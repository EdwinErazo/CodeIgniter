<!DOCTYPE HTML>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Your Website</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>

<body>

	<div class="container">
        <br>
        <h3 align="center" >
            Complete User Registration an login system in codeiniter
        </h3>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body" >
                <?php
                if($this->session->flashdata('message')){

                    echo'
                    <div class="alert alert-success">
                        '.$this->session->flashdata("message").'
                    </div>
                    
                    ';
                }
                ?>
           <form method="post" action="<?php echo base_url();?>index.php/login/vadilation">

            <div class="form-group" >
                <label for="">Enter Email </label>
                <input type="text" name="user_email" class="form-control" value="<?php echo set_value('user_email'); ?>" />
                <span class="text-danger"><?php echo form_error('user_email'); ?></span>
            </div>
            <div class="form-group" >
                    <label for="">Enter Password </label>
                    <input type="password" name="user_password" class="form-control" value="<?php echo set_value('user_password'); ?>" />
                    <span class="text-danger"><?php echo form_error('user_password'); ?></span>
                </div>
                <div class="form-group" >
                    <input type="submit" name="login" value="Login" class="btn btn-info" />
                    <br><br>
                    <a href="<?php echo base_url(); ?>register">Register</a>

                </div>
           </form>
            </div>
        </div>

    </div>

</body>

</html>