<style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>

<div class="body-content outer-top-xs">
	<div class="container">
		<div class="row">
			<div class="contact-page">
				<div class="col-md-12 contact-map outer-bottom-vs">
					
					<div id="map"></div>
					<script>
      function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
    </script>


				</div>
				<div class="col-md-9 contact-form">
					<div class="col-md-12 contact-title">
						<h4>Contact Form</h4>
					</div>
					<?php echo $this->Form->create("Contact",array("url"=>array("controller"=>"pages","action"=>"contactus","admin"=>false),array()));?>
					<div class="col-md-4">		
						<div class="form-group">
						<label class="info-title" for="exampleInputName">Your Name <span>*</span></label>
						<?php echo $this->Form->text('Contact.firstname',array("class"=>"form-control"));?>
						</div>
					</div>
					<div class="col-md-4">		
						<div class="form-group">
						<label class="info-title" for="exampleInputName">Your Email <span>*</span></label>
						<?php echo $this->Form->text('Contact.email',array("class"=>"form-control"));?>
						</div>
					</div>
					<div class="col-md-4">		
						<div class="form-group">
						<label class="info-title" for="exampleInputName">Your Contact number<span>*</span></label>
						<?php echo $this->Form->text('Contact.phone',array("class"=>"form-control"));?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
						<label class="info-title" for="exampleInputName">Your Message<span>*</span></label>
						<?php echo $this->Form->textarea('Contact.message',array("class"=>"form-control"));?>
						</div>
					</div>
					<div class="col-md-12 outer-bottom-small m-t-20">
						<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Send Message</button>
					</div>
					<?php echo $this->Form->end(); ?>
				</div>
			
				<div class="col-md-3 contact-info">
					<div class="contact-title">
						<h4>Information</h4>
					</div>
					<div class="clearfix address">
						<span class="contact-i"><i class="fa fa-map-marker"></i></span>
						<span class="contact-span">ThemesGround, 789 Main rd, Anytown, CA 12345 USA</span>
					</div>
					<div class="clearfix phone-no">
						<span class="contact-i"><i class="fa fa-mobile"></i></span>
						<span class="contact-span">+(888) 123-4567<br>+(888) 456-7890</span>
					</div>
					<div class="clearfix email">
						<span class="contact-i"><i class="fa fa-envelope"></i></span>
						<span class="contact-span"><a href="#">flipmart@themesground.com</a></span>
					</div>
				</div>
			</div><!--contact-page-->
		</div><!--row-->
	</div><!--container -->
</div><!--body-content-->
