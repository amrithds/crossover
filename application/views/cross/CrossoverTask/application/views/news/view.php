<div class="col-md-8">
	<!-- First Blog Post -->
	<h2>
                    <?php
																				echo $news_item ['title'];
																				?>
                </h2>
	<p class="lead">
                    by <?php echo $news_item['fname'].' '.$news_item['lname'];?>
                </p>
	<p>
		<span class="glyphicon glyphicon-time"></span> Posted on <?php echo $news_item['created_at'];?></p>
	<hr>
	<img class="img-responsive" src="<?php echo $this->config->base_url();?>/uploads/newsImages/<?php echo $news_item['photo']?>" alt="">
	<hr>
	<p><?php echo $news_item ['content'];?></p>
	<?php if(! isset($isPdfDownload)){?>
	<a class="btn btn-primary" href="<?php echo site_url("home/downloadPdf/".$news_item ['slug'])?>">Download Pdf <span class="glyphicon glyphicon-chevron-right"></span></a>
	<?php }?>
	<hr>
</div>