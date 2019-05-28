<style>
.tree {
    min-height:20px;    
    margin-bottom:20px;
    padding:0px;
  /* background-color:#fbfbfb;
    border:1px solid #999;*/
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    border-radius:4px;
    -webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
    -moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
    box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05)
}
.tree li {
    list-style-type:none;
    margin:0;
    padding:10px 5px 0 5px;
    position:relative
}
.tree li::before, .tree li::after {
    content:'';
    left:-20px;
    position:absolute;
    right:auto
}
.tree li::before {
    border-left:1px solid #999;
    bottom:50px;
    height:100%;
    top:0;
    width:1px
}
.tree li::after {
    border-top:1px solid #999;
    height:20px;
    top:25px;
    width:25px
}
.tree li span {
    -moz-border-radius:5px;
    -webkit-border-radius:5px;
    border:1px solid #999;
    border-radius:5px;
    display:inline-block;
    padding:3px 8px;
    text-decoration:none
}
.tree li.parent_li>span {
    cursor:pointer
}
.tree>ul>li::before, .tree>ul>li::after {
    border:0
}
.tree li:last-child::before {
    height:30px
}
.tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
    background:#eee;
    border:1px solid #94a0b4;
    color:#000
}
.tree ul:first-child{padding:0px; margin:0px}
.tree li a{padding-left:7px}
</style>
<div class="">
	<div class="">				
		<h3 class="">Categories</h3>
		<div class=""></div>
		<div class="tree">
		<?php //pr($postcategories);exit;
			$options = array('model'=>'Articlecategory','element' => 'node','type'=>'ul','class'=>"categorylist");
			echo $this->Tree->generate($postcategories,$options);
		?>
		</div> <!--tree -->
	</div><!--sidebaar_box -->
		
	<div class="">
		<h3 class="">Recent Posts</h3>
		<div class=""></div>
		<?php foreach($appnewarticles as $post){ //pr($post);?>
			<div class="">
				<?php echo $this->Html->image($post['Articlecoverimage']['namesmall'],array("class"=>"img-responsive")); ?>
				<?php echo $this->Html->link($post['Article']['title'],array("controller"=>"articles","action"=>"view",'slug' => Inflector::slug($post['Article']['title'],'-'),'id'=>$post['Article']['id']),array("escape"=>false)); ?>
				<p><small><i class="glyphicon glyphicon-calendar"></i> <?php echo $this->Time->niceShort($post['Article']['modified']); ?></small></p>
			</div>
		<?php } ?>		
	</div><!-- End sidebaar_box -->		
		<hr>
		<div class="">
			<h3 class="">The Quote</h3>
			<div class=""></div>
			<p>
				We need business to understand its social responsibility, that the main task and objective for a business is not to generate extra income and to become rich and transfer the money abroad, but to look and evaluate what a businessman has done for the country, for the people, on whose account he or she has become so rich.
			</p>
		</div><!-- End widget -->
		<hr>		
		<div class="">
			<h3 class="">Tags</h3>
			<div class=""></div>
			<div class="">
			<?php //pr($tags);
			
			$for_weight = array('before' => '<li class="fs%size% tag">','after' => '</li>',    'maxSize' => 50,'minSize' => 1);
			$options = array();
			echo $this->TagCloud->display($tags,$options);	 ?>
			</div>
		</div><!-- End widget -->
	</div><!-- end siedebar  -->

<script>
$(function () {
    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).attr('title', 'Expand this branch').find(' > i').addClass('glyphicon-plus').removeClass('glyphicon-minus');
        } else {
            children.show('fast');
            $(this).attr('title', 'Collapse this branch').find(' > i').addClass('glyphicon-minus').removeClass('glyphicon-plus');
        }
        e.stopPropagation();
    });
});
</script>