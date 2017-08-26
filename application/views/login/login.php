<h1>Login page</h1>
<?php echo validation_errors(); ?>
<!-- show falsh message -->
<?php if($this->session->flashdata('error')){ ?>
<div class='error'><?php echo $this->session->flashdata('error')?></div>
<?php } ?>

<?php echo form_open('login/loginUser'); ?>

<table border="0">
<tr><td>Email</td><td><input type="text" name="email" /></td></tr>
<tr><td>Password</td><td><input type="password" name="password" size="20" /></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Submit" /></td></tr>
</table>