<div>
<a class="btn btn-primary" href="<?php echo site_url("news/create");?>">Create news <span class="glyphicon glyphicon-chevron-right"></span></a>
</div>
<div>
<?php foreach ($news as $news_item): ?>
    <h2><?php echo $news_item['title'] ?></h2>
    <div class="main">
        <?php echo $news_item['content'] ?>
    </div>
    <p><a href="<?php echo site_url("home/view/".$news_item['slug']);?>">View article</a></p>
	<p><a href="<?php echo site_url("news/delete/".$news_item['id']);?>">Delete</a></p>
<?php endforeach ?>
</div>
<div class='paginate'>
<?php
   echo $this->pagination->create_links();
?>
</div>