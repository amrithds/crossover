<h1>Enter new password</h1>
<?php echo validation_errors(); ?>

<?php echo form_open('login/registerUser/'.$token); ?>

<table border="0">
<tr><td>First Name *</td><td><input type="text" name="fname" /></td></tr>
<tr><td>Last Name *</td><td><input type="text" name="lname" /></td></tr>
<tr><td>Password</td><td><input type="password" name="password" value="" size="20" /></td></tr>
<tr><td>Confirm Password</td><td><input type="password" name="confirmpass" value="" size="20" /></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Submit" /></td></tr>
</table>