<h2>Create a news item</h2>

<?php echo validation_errors('<div class="error">', '</div>'); ?>
<?php if($this->session->flashdata('error')){ ?>
<div class='error'><?php echo $this->session->flashdata('error')?></div>
<?php } ?>
<?php echo form_open_multipart('news/create')?>
<table>
	<tr>
		<td><label for="title">Title</label></td>
		<td><input type="input" name="title" /></td>
	</tr>
	<tr>
		<td><label for="text">Text</label></td>
		<td><textarea name="content"></textarea></td>
	</tr>
	<tr>
		<td><label for="text">Image</label></td>
		<td><input type="file" name="photo" /></td>
	</tr>
	<tr>
		<td colspan='2'><input type="submit" name="submit"
			value="Create news item" /></td>
	</tr>
</table>
</form>