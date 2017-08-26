<h1>Welcome to news forum</h1>

<?php if(!isset($this->session->userdata['logged_in'])){?>
<?php echo validation_errors(); ?>

<?php if($this->session->flashdata('error')){ ?>
<div class='error'><?php echo $this->session->flashdata('error')?></div>
<?php } ?>
<?php echo form_open('home/welcome',array('id'=>'registerEmail')); ?>

<table border="0">
	<tr>
		<td>Email id</td>
		<td><input type="text" name="email" id="email" value="" size="50" /></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit"
			value="Submit" /></td>
	</tr>
<?php form_close();?>
<tr>
		<td colspan="2" align="center"><a
			href='<?php echo site_url("login/loginUser");?>' />Registered user?
			</button></td>
	</tr>

</table>
<?php }?>
<h2>Latest news</h2>
<div class='lastest_news'>
	<ul>
<?php if(count($news) > 0){?>
	<?php foreach ($news as $news_item): ?>
    <li><a
			href="<?php echo site_url("home/view/".$news_item['slug']);?>"><?php echo $news_item['title'] ?></a></li>
<?php endforeach ?>
<?php }else{?>
	<li>No news available</li>
<?php }?>
</ul>
</div>
<?php ?>
