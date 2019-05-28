<?php echo $this->Html->script('ckeditor/ckeditor'); ?>

<div class="container p-3">

<div class="row">
<div class="col-md-3">
	<nav>
		<?php echo $this->element('sidebar_dashboard');?>
	</nav>
</div>
<div class="col-md-9">
<?php echo $this->Html->script('bootstrap-filestyle.min',false); ?>
<?php echo $this->Html->css('jquery_datetimepicker'); //requried for bdate ?>

<h4 class="">My Profile
		<div class="float-right btn btn-light"><?php echo $this->Html->link("Cancle update", array("controller"=>"users","action"=>"dashboard","admin"=>false));?>
		</div></h4><hr>
	<div class="col-right">
		<fieldset>
		
			<?php echo $this->Form->create('Profile',array("url"=>array("controller"=>"profiles","action"=>"edit"),"type" =>"file")); ?>
				
				<div class="row">
					<div class="col-md-6">
						<label>My gender is</label><br>
						<?php $options = array("M"=>"Male","F"=>"Female","O"=>"Other");
						$attributes = array('label'=>false,'legend'=>false, 'separator'=>'&nbsp;&nbsp;&nbsp;', 'between'=>'&nbsp;&nbsp;');
						echo $this->Form->radio('Profile.gender',$options,$attributes); ?>
					</div>				
					<div class="form-group col-md-6">
						<label>Date of birth (yyyy-mm-dd)</label><small class="float-right">Click to open the calendar</small>
						<?php echo $this->Form->text('Profile.birthdate',array("type"=>"text","class"=>"form-control ie7-margin")); echo $this->Form->input('Profile.id',array("type"=>"hidden","class"=>""))?>
						<?php echo $this->Form->error('Profile.birthdate'); ?>
					</div>
				</div>
				
				<hr/>
				<div class="row">
					<div class="form-group col-md-12"><label>About Yourself</label>
					<span class="pull-right">Abstract about yourself, your skills, interests and passions as short introduction.</span>
					<?php echo $this->Form->input('Profile.aboutme',array("type"=>"textarea","label"=>false, "class"=>"form-control ie7-margin ckeditor"));?>
						<?php echo $this->Form->error('Profile.aboutme'); ?></div>
				</div>
				<hr/>
				<div class="row">
					<div class="form-group col-md-12"><label>Your quote</label>
					<span class="pull-right">Write your favorite quote which you believe or goal to achieve.</span>
					<?php echo $this->Form->input('Agentprofile.quotes',array("type"=>"textarea","label"=>false, "class"=>"form-control ie7-margin ckeditor"));?>
						<?php echo $this->Form->error('Profile.quotes'); ?></div>
				</div>
				<div class="row">
					<div class="form-group col-md-3"><?php echo $this->Form->submit('Update profile',array("class"=>"btn btn-primary")); ?></div>
				</div>
				
			<?php echo $this->Form->end(); ?>
		</fieldset>
	</div>
</div>
</div>

<script type="text/javascript">

CKEDITOR.replace( 'ProfileAboutme', {
toolbar: [[ 'Bold', 'Italic','Underline','Subscript','Superscript'],[ 'NumberedList','BulletedList' ]],

height: '200',
});

</script>

<script>$(":file").filestyle({buttonName: "btn-default",buttonText: "&nbsp;Image"});</script>

<?php echo $this->Html->script('jquery_datetimepicker'); ?>
<script type="text/javascript">
$('#ProfileBirthdate').datetimepicker({
	format:'Y-m-d'
});
</script>