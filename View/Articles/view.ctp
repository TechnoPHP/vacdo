<?php echo $this->Html->meta('canonical', Router::url('/', true).'Article/'.Inflector::slug(strtolower($post['Article']['title']),'-'),array('rel'=>'canonical', 'type'=>null, 'title'=>null, 'inline' => false)); ?>
<?php $this->assign('title',$post['Article']['title']);?>
<div class="container">
<div class="row">
	<div class="col-md-3">
		<aside>
			<?php echo $this->element('blog_sidebar'); ?>
		</aside>
	</div>
	
	<div class="col-md-9">
		<div class="content_box">
			<div class="articles-details-header">
				<div class="articles-details-header-img"> 
					<?php if(!empty($post['Articlecoverimage']['name'])){	
					echo $this->Html->image($post['Articlecoverimage']['name'], array('class'=>'img-responsive'));
					echo $this->Html->meta(array('property'=>'og:image','type'=>'meta', 'content'=>substr(Router::url('/', true), 0, -1).'article/'.$post['Articlecoverimage']['name'], 'rel' => null),NULL, array('inline'=>false));
					
					}else{
					echo $this->Html->image('php_default.jpg', array('class'=>'img-responsive'));
					}
					echo $this->Html->meta(array('property'=>'og:type','type'=>'meta', 'content'=>'website', 'rel' => null),NULL, array('inline'=>false));
					echo $this->Html->meta(array('property'=>'og:url','type'=>'meta', 'content'=>Router::url('/', true).$post['Article']['title'], 'rel' => null),NULL, array('inline'=>false));
					?> 
				</div>
				<?php $services = array(
							'facebook' => __('Facebook'),
							'gplus' => __('Google+'),
							'linkedin' => __('LinkedIn'),
							'twitter' => __('Twitter'),
							'pinterest' => __('Pinterest')
						); 
						$options = array('text'=>'Catch a blog post', 'title'=>'share it');
				?>			
					<?php
						echo '<div class="articles-details-header-social">';
							foreach ($services as $service => $linkText) {
								echo '<div class="articles-details-'.$service.'">' . $this->SocialShare->fa(
									$service,$linkText,
									$pageurl,$options
								) . '</div>';
							} ?>
							<div class="articles-details-tofriend toggleModal">
								<a title="Send to friend" data-toggle="" data-target="#squarespaceModal" href="#" class="">
								<i class="fa fa-paper-plane-o"></i>Send to friend</a>
							</div>		
					<?php echo '</div>'; ?>
					
			</div>
			
			<h4 class="articles-details-title">
				<?php echo h($post['Article']['title']); ?>
			</h4>
			<div class="star"><?php echo $this->Ratings->display_for($post); ?></div>
			<div class="breadcrumblist">
				<?php $total = count($treePath);
				echo '<ul id="" class="breadcrumb">';
				echo '<li>';
				echo $this->Html->link('All', array('controller'=>'articles','action'=>'filter','admin'=>false));
				echo '</li>';
				foreach ($treePath as $key => $treeCategory) {
					if (!$treeCategory['Articlecategory']['active']) {
						continue;
					}
					echo '<li>';
					if ($total === $key + 1) {
						echo h($treeCategory['Articlecategory']['name']);
					} else {
						echo $this->Html->link($treeCategory['Articlecategory']['name'], array('controller'=>'articles','action'=>'filter','category' =>Inflector::slug($treeCategory['Articlecategory']['name'],'-'), 'articlecategoryid' => $treeCategory['Articlecategory']['id'],'admin'=>false));
					}
					echo '</li>';
				}
				echo '</ul>';
				?>
				</div>
				<div class="gray_strip">
					<div class="col-md-12">
						<div class="white_strip">
						<i class="fa fa-calendar"></i> <?php echo $this->Time->niceShort($post['Article']['modified']); ?> 
						</div>
					
						<div class="white_strip">
						<i class="fa fa-tags"></i> Tags  <?php $string = '';
								foreach($post['Tag'] as $tags){
									$string .= $this->Html->link($tags['name'], array("controller"=>"articles","action"=>"search","by"=>$tags['keyname'],"tid"=>$tags['id']),array("escape"=>false)).", ";
								} echo substr($string,0,-2); ?>
						</div>
						<div class="white_strip">
							<i class="fa fa-eye"></i> 
							<?php echo (count($post['Article']['articleview_count'])>1)?$post['Article']['comment_count']." Comments":$post['Article']['articleview_count']." Postviews" ;?>
						</div>
						<div class="white_strip">
							<i class="fa fa-comments"></i> 
							<?php echo $post['Article']['comment_count'];echo (count($post['Article']['comment_count'])>1)?" Comments":" Comment" ;?>
						</div>
					</div>
				</div>
				<p><?php echo preg_replace("/<img /","<img class='img-responsive' ",$post['Article']['body']);?></p>
			
			
			<div class="panel-group" id="accordion">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
							  Leave Comment
							<i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i></a>
						</h4>
						<small>The date and time of submission and your device`s IP address will be recorded when you click Save comment.</small>
					</div>
					<script>$(document).ready(function() {$('#collapseOne').collapse('show');});</script>
					<div id="collapseOne" class="panel-collapse collapse">
						<div class="panel-body">
							<?php echo $this->Form->create('Comment',array("url"=>array("controller"=>"comments","action"=>"create"))); ?>					
							<div class="row">
								<?php if($this->Session->check("Auth.User")){?>
								<div class="col-md-9">
									<?php
									echo $this->Form->input('Comment.user_id', array("value"=>$this->Session->read('Auth.User.id'), "type"=>"hidden","class"=>""));
									echo $this->Form->input('Comment.firstname', array("value"=>$this->Session->read('Auth.User.firstname'), "type"=>"hidden","class"=>"")); ?>
									
								</div>
									<?php } else {?>
								<div class="col-md-6 form-group">
									<label>Full name <span class="error-message">*</span></label>
									<?php
									echo $this->Form->input('Comment.firstname', array( "label"=>false,"type"=>"text","class"=>"form-control ie7-margin"));?>
									
								</div>
								<div class="col-md-6 form-group">
									<label>Email Id<span class="error-message">*</span></label>
									<?php
									echo $this->Form->input('Comment.email_address', array("label"=>false,"type"=>"text","class"=>"form-control ie7-margin")); ?>
								</div>
								<?php } ?>
								<div class="col-md-1">
									<?php echo $this->Form->input('Comment.article_id',array("value"=>$article_id,"type"=>"hidden","class"=>"form-control ie7-margin")); echo $this->Form->error('Comment.article_id');?>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
								<label>Website / Social Profile link</label>
								<?php echo $this->Form->text('Comment.website',array("class"=>"form-control ie7-margin")); ?>
								<small>You can enter your social network profile link here</small>
								</div>
								<div class="form-group col-md-6">
									<?php $this->Captcha->render(array('model'=>'Comment','field'=>'scode','type'=>'math','class'=>'form-control'));?>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12"><?php echo $this->Form->input('Comment.message',array("type"=>"textarea","class"=>"form-control ie7-margin")); ?>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<?php echo $this->Form->submit('Save comment',array("class"=>"btn btn-primary")); ?>
								</div>
							</div>
						<?php echo $this->Form->end(); ?>
						</div><!-- end of panel-body -->
					</div><!-- end of panel-collapse collapse -->
				</div>
			</div>
			
			<hr>
			
			<div id="comments" class="comments_section">
			<h4><?php echo $post['Article']['comment_count'];echo ($post['Article']['comment_count']>1)?" Comments":" Comment" ;?></h4>
				<?php 
					$options = array('model'=>'Comment','alias'=>'message','element' => 'nodecomment','class'=>"media-list");
					echo $this->Tree->generate($comments,$options);
				?>        
			</div><!-- End Comments -->
			
		</div><!-- end content_box-->
	</div><!-- end div col-md-9-->
	</div><!-- end of row -->
</div><!-- end of container -->

<!-- line modal -->
<style>
 .modal {
  display: none;
  position: absolute;
  top: 30%;
  bottom: auto;
  left: 50%;
  width: 500px;
  height: auto;
  margin-left: -200px;
  margin-top: -150px;
  background-color: #ffffff;
  padding: 25px;25px;0px;25px;
  border-radius: 5px;
  z-index: 10;
  box-shadow: 0 0 0 9999px rgba(0, 0, 0, 0.5);
}
.modal.active {display: block;}
.modal header {position: relative;}
.modal h2 {text-align: center;}
.modal .close {position: absolute;top: 10px;right: 20px;margin: 0px;}
.creload{margin-left:5px;}
</style>
<div class="modal">
<?php echo $this->Html->script('validate',FALSE); ?>		
			<button type="button" class="close toggleModal" data-dismiss="modal"> <i class="fa fa-times-circle-o" aria-hidden="true"></i></button>
			<h3 class="modal-title" id="lineModalLabel">Send to friend</h3><hr />
		
			<div id="success"></div><div id="sending" style="display:none">sending..</div>
            <!-- content goes here -->
			<?php echo $this->Form->create('', array("url"=>array("controller"=>"articles","action"=>"sendtofriend","admin"=>false)));?>
              <div class="row">					
					<div class="form-group col-md-6">
						<label>Friend's Full Name* </label>
						<?php echo $this->Form->text('Tofriend.receiver',array("class"=>"form-control","id"=>"receiver")); echo $this->Form->error('Tofriend.receiver');?>
					</div>
					<div class="form-group col-md-6">
						<label>Friend's Email Address*</label>
						<?php echo $this->Form->text('Tofriend.recemail',array("class"=>"form-control","id"=>"recemail"));  echo $this->Form->error('Tofriend.recemail');?>
					</div>
				</div>
				<div class="row">					
					<div class="form-group col-md-6">
						<label>Your Full Name* </label>
						<?php echo $this->Form->text('Tofriend.sender',array("class"=>"form-control","id"=>"sender")); echo $this->Form->error('Tofriend.sender');?>
					</div>
					<div class="form-group col-md-6">
						<label>Your Email Address*</label>
						<?php echo $this->Form->text('Tofriend.senderemail',array("class"=>"form-control","id"=>"senderemail")); echo $this->Form->error('Tofriend.senderemail');?>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						<label>Link of post To Your Friend* </label>
						<?php echo $this->Form->text('Tofriend.link',array("readonly" => "readonly","class"=>"form-control","value"=>$pageurl,"id"=>"link")); echo $this->Form->error('Tofriend.link');?>
					</div>
				</div>
				<div class="row">					
					<?php echo $this->Form->text('Tofriend.userip',array("type"=>"hidden","class"=>"form-control","value"=>$_SERVER['REMOTE_ADDR'],"id"=>"userip")); ?>
					
					<?php echo $this->Form->text('Tofriend.article_id',array("type"=>"hidden","class"=>"form-control","value"=>$post['Post']['id'],"id"=>"post_id")); echo $this->Form->error('Tofriend.post_id');echo $this->Form->error('Tofriend.userip');?>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						<label>Message To Your Friend* </label>
						<?php echo $this->Form->textarea('Tofriend.message',array("class"=>"form-control","id"=>"message")); ?>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
					<?php $this->Captcha->render(array('model'=>'Tofriend','field'=>'captcha','type'=>'image','class'=>'form-control'));echo $this->Form->error('Tofriend.captcha','Error occured');?>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						<?php echo $this->Js->submit('Send',array(
						"class"=>"btn btn-default",
						"url"=>"sendtofriend",
						"before"=>$this->Js->get('#sending')->effect('fadeIn'),
						"success"=>$this->Js->get('#sending')->effect('fadeOut'),
						"update"=>'#success',
						)); ?>
					</div>
				</div>
            <?php echo $this->Form->end(); ?>
</div>

<?php echo $this->Js->writeBuffer(array('cache'=>false)); ?>
<script type="text/javascript">
	$('.toggleModal').on('click', function (e) { 
  $('.modal').toggleClass('active');  
});
</script>
<script>
jQuery('.creload').on('click', function() {
    var mySrc = $(this).prev().attr('src');
    var glue = '?';
    if(mySrc.indexOf('?')!=-1)  {
        glue = '&';
    }
    $(this).prev().attr('src', mySrc + glue + new Date().getTime());
    return false;
});
</script>
<?php echo $this->fetch('script_execute'); //rating script ?>