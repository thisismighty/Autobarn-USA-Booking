<?php
require 'bin/required.php';
require 'etc/steps-conf.php';

$CDV = new ControllerDefaultValues();
$_SESSION = $CDV->step4($_SESSION, $_POST);
$DS4 = new DataStep4();
$sites = 'https://'.$_SERVER['SERVER_NAME'];
$DUSP=new DataUSP();
if(isset($_GET['debug'])){ echo "<pre>"; print_r($_SESSION); echo "</pre>"; }
?><!DOCTYPE>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=0.8, maximum-scale=0.8, user-scalable=0"/>
		<?php /*
		<script type="text/javascript">
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-2588665-<?php echo $CDV->anal($_SESSION['referrer'])?>', 'auto', {allowLinker: true});
			ga('require', 'linker');
			ga('linker:autoLink', ['travellers-autobarn.com.au', 'travellers-autobarn.fr', 'travellers-autobarn.it', 'travellers-autobarn.de', 'travellers-autobarn.nl'], false, true);
			ga('send', 'pageview');			
		</script>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-K6FFFT3');</script>
		*/ ?>
		
		<script>
		  var dataLayer = window.dataLayer || [];
		</script>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-K6FFFT3');</script>
		
		<?php echo ViewCSS::draw('bootstrap.min.css');?>
		<?php echo ViewCSS::draw('font-awesome.min.css');?>
		<?php echo ViewCSS::draw('body.css'); ?>
		<?php echo ViewCSS::draw('nav.css'); ?>
		<?php echo ViewCSS::draw('jquery-ui.css'); ?>
		<?php echo ViewCSS::draw('step4.css'); ?>
		<?php echo ViewCSS::draw('style-v7.css');?>
		<?php echo ViewCSS::draw('intlTelInput.css');?>
		<?php echo ViewJS::draw('jquery-2.1.3.min.js'); ?>
		<?php //echo ViewJS::draw('intlTelInput.min.js'); ?>
		<?php echo ViewJS::draw('jquery-ui.min.js'); ?>
		<?php echo ViewJS::draw('jquery.validate.min.js'); ?>
		<?php echo ViewJS::draw('intlTelInput-jquery.min.js'); ?>
		<?php echo ViewJS::draw('bootstrap.min.js');?>
		<?php echo ViewJS::draw('Template.js'); ?>
		<?php echo ViewJS::draw('Select.js'); ?>
		<?php echo ViewJS::draw('Date.js'); ?>
		<?php echo ViewJS::draw('Log.js'); ?>
		<?php echo ViewJS::draw('View.js'); ?>
		<?php echo ViewJS::draw('Controller.js'); ?>
		<script src="<?php echo ControllerSourceSite::api_url_get() ?>" type="text/javascript"></script>
		<?php echo ViewJS::draw('Step4.js'); ?>
		<?php echo ViewJS::draw('Step4Controller.js'); ?>
		<?php echo ViewJS::draw('Step4View.js'); ?>
		<script type="text/javascript">
			Step4.data =<?php echo json_encode($_SESSION) ?>;
			Step4.data.deposit_model='<?php echo $DS4->country()?>';
			<?php echo gethostname()=='fulvios-sandbox'?'Log.display=2;':''?>
			$(function(){
				$('a.modify').on('click', function(){
					$('#search-form').slideDown(400);
					$("html, body").animate({ scrollTop: $('#search-form').offset().top }, 1000);
					return false;
				});
				$('#search-form .close').on('click', function(){
					$('#search-form').slideUp(400);
				});
			});
			
			$(function(){
				$('a.modify').on('click', function(){
					$('#search-form').slideDown(400);
					return false;
				});
				$('#search-form .close').on('click', function(){
					$('#search-form').slideUp(400);
				});
			});
		</script>
		<?php echo $CDV->remarketing_code(); ?>
	</head>
	<body>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K6FFFT3"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		
		<?php echo Template::header(ViewNav::step4())?>
		<main>
			<div class="container">
				<?php /*
				<article>
					<div id="car">
						<div class="car">
							<div class="image">
								<img
									class="main"
									src="<?php echo $_SESSION['CategoryType_imagename']?>"
									alt="<?php echo $_SESSION['CategoryType_name']?>"
									title="<?php echo $_SESSION['CategoryType_name']?>"/>
								<img src="/booking/image/most-popular-step2.png" class="most-popular" style="display:none" />
							</div>
							<div class="locationContainer">
								<div class="tb">
									<div class="tb-row">
										<div class="info">
											<a href="javascript:void(0);"
												onclick="window.open('<?php echo $_SESSION['CategoryType_vehicledescurl']?>','Car','width=600,height=800,menu=no,toolbar=no,scrollbars=yes,status=no');return false;"
												target="_blank"
												title="Click here for detailed description">
												<img src="image/info.png" alt="info"/>
											</a>
										</div>
										<div class="cartitle"></div>
									</div>
								</div>
								<div class="peoplegraphic">
									%peoplegraphic_html
									
								</div>
								<div class='unlimited'><?php echo $DUSP->get_one($_SESSION['CarSizeID'])?></div>
								<div id="price_details">
									<table style="display:none;" class="location" cellspacing="0">
										<tbody><tr>
											<th valign="top">Vehicle:</th>
											<td><?php echo $_SESSION['CategoryType_name']?></td>
										</tr>
										<tr>
											<th valign="top">Pickup Location:</th>
											<td><?php echo $_SESSION['PickupLocation_name']?></td>
										</tr>
										<tr>
											<th valign="top">Pickup Date &amp; Time:</th>
											<td><?php echo $_SESSION['PickupDate_formatted']?></td>
										</tr>
										<tr>
											<th valign="top">Return Location:</th>
											<td><?php echo $_SESSION['DropOffLocation_name']?></td>
										</tr>
										<tr>
											<th valign="top">Return Date &amp; Time:</th>
											<td><?php echo $_SESSION['ReturnDate_formatted']?></td>
										</tr>
										<tr>
											<th valign="top">Driver age:</th>
											<td>18 - 75</td>
										</tr>
									</tbody></table>
									<table style="display:none;" class="details" cellspacing="0"> 
									</table>
								</div>
							</div>
							<div>
								<div class="cartotal">
									<div>
										<div>
											<span>TOTAL</span>
											<span id="total-top"></span>
										</div>
									</div>
									<a class="show" href="javascript:void(0)" onclick="Step4.controller.price_details.show(this)">+ show booking details</a>
									<a style="display:none" class="hide" href="javascript:void(0)" onclick="Step4.controller.price_details.hide(this)">- hide booking details</a>
								</div>
							</div>
						</div>
					</div>
					<div id="form-error" style="display:none"></div>
					<form action="step4.php" method="post" id="frmStep4">
						<div class="customerdetails">
							<div id="customer_details">
								<h3>CUSTOMER DETAILS <span>(ALL FIELDS REQUIRED)</span></h3>
								<div class="customerinfo">
									<div>
										<div>
											<label for="firstname">First name:</label>
											<input type="text" name="firstname" id="firstname" value="<?php echo htmlspecialchars($_SESSION['firstname'])?>"/>
										</div>
										<div>
											<label for="lastname">Last name:</label>
											<input type="text" name="lastname" id="lastname" value="<?php echo htmlspecialchars($_SESSION['lastname'])?>"/>
										</div>
									</div>
									<div>
										<div>
											<label for="email">Email:</label>
											<input type="text" name="email" id="email" value="<?php echo htmlspecialchars($_SESSION['email'])?>"/>
										</div>
										<div>
											<label for="phone">Phone (incl. area code):</label>
											<input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($_SESSION['phone'])?>"/>
										</div>
									</div>
									<div>
										<div>
											<label for="notraveling">Number of people travelling:</label>
											<input type="text" name="notraveling" id="notraveling" value="<?php echo htmlspecialchars($_SESSION['notraveling'])?>"/>
										</div>
										<div>
											<label for="foundus">How did you hear about us:</label>
											<select id="foundus" name="foundus"></select>
										</div>
									</div>
								</div>
								<div>
									<h4>YOUR PAYMENT DETAILS</h4>
									<p><strong>IMPORTANT: On submission you will be directed to a secure payment area to enter credit card details.</strong></p>
									<p>A deposit of <strong><span id="deposit_currency"></span> $<span id="deposit"></span></strong> will be taken off your credit card to secure this booking.</p>
									<p><input type="checkbox" name="tc" id="tc" value="yes"/>
										<label for="tc">I have read and agreed to the <a
											href="<?php echo $DS4->tc_url()?>"
											target="_blank">terms and conditions</a> and I am between 18-75 years of age.</label></p>
								</div>
								<div id="form-error-book-now" style="display:none"></div>
								<div class="book-now-button">
									<a href="/booking/step2.php" class="backbutton desktop">BACK</a>
									<input type="button" onclick="Step4.controller.book_now();" id="book_now_button" value="BOOK NOW"/>
									<a href="/booking/step2.php" class="backbutton mobile">BACK</a>
								</div>
							</div>
						</div>
						<input type="hidden" name="CustomerData" id="CustomerData" value="<?php echo htmlspecialchars($_SESSION["CustomerData"]);?>"/>
						<input type="hidden" name="ReservationRef" id="ReservationRef" value="<?php echo htmlspecialchars($_SESSION["ReservationRef"]);?>"/>
						<input type="hidden" name="ReservationNo" id="ReservationNo" value="<?php echo htmlspecialchars($_SESSION["ReservationNo"]);?>"/>
						<input type="hidden" name="total_deposit" value=""/>
					</form>
				</article>
				<aside>
					<script type="text/html" id="price_details_table_header_html">
						<tr>
							<th>Product</th>
							<th>Rental Days</th>
							<th>Daily Rate</th>
							<th>Total</th>
						</tr>
					</script>
					<script type="text/html" id="price_details_table_row_html">
						<tr class="%class">
							<td>%cell1 &nbsp;</td>
							<td>%cell2 &nbsp;</td>
							<td>%cell3 &nbsp;</td>
							<td>%cell4</td>
						</tr>
					</script>
					<script type="text/html" id="peoplegraphic_one_html">
						<div class="num-ppl">
							<img src="image/%no-people.png" alt="Persons" title="Persons"/>
						</div>
					</script>
					<script type="text/html" id="peoplegraphic_html">
						<div class="num-ppl">
							<img src="image/%nochildren-people.png" alt="Persons" title="Persons"/>
							<span>to</span>
							<img src="image/%noadults-people.png" alt="Persons" title="Persons"/>
						</div>
					</script>
					<script type="text/html" id="car_title_html">
						<h2><span class="main">%categoryfriendlydescription0</span></h2>
						<h3>%categoryfriendlydescription1</h3>
					</script>
					<script type="text/html" id="price_row_html">
						<tr>
							<th>%name</th>
							<td>%value</td>
							<td>$%total</td>
						</tr>
					</script>
				</aside> */ ?>
				
				<div class="row">
					
					<div id="content" class="content col-lg-8 col-md-8 col-sm-12 col-xs-12">
						
						<?php if($_SESSION['car_availability']==2): ?>
						<div class="inside vehicle-info">					
							<?php
							switch($_SESSION['CategoryType_name']){
								case "Ventura":
										$car_image='image/campervans/ventura.png';
										$vehicle_url ='https://www.travellers-autobarnrv.com/campervan-hire-usa/ventura-camper/';
									break;
								case "Maverick":
										$car_image='image/campervans/maverick.png';
										$vehicle_url ='https://www.travellers-autobarnrv.com/campervan-hire-usa/maverick-camper/';
									break;
								// case "Hitop Campervan":
										// $car_image='image/campervans/hitop.png';
										// $vehicle_url ='https://www.staging.travellers-autobarnrv.com/campervan-hire-usa/hitop-campervan/';
									// break;
								// case "Kuga Campervan":
										// $car_image='image/campervans/kuga.png';
										// $vehicle_url ='https://www.staging.travellers-autobarnrv.com/campervan-hire-usa/kuga-campervan/';
									// break;
								default:
										$car_image=$_SESSION['CategoryType_imageurl'];
										$vehicle_url =$_SESSION['CategoryType_vehicledescriptionurl'];
									break;
							}

							?>
							<div class="row">
								<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
									<img src="<?php echo $car_image; ?>" />
								</div>
								<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
									<h2>Booking Request Form<br /><?php echo $_SESSION['CategoryType_name'];?></h2>
									<a href="javascript:void(0);" onclick="window.open('<?php echo $vehicle_url; ?>','Car','width=600,height=800,menu=no,toolbar=no,scrollbars=yes,status=no');return false;" title="Click here for detailed description">Vehicle Information</a>
								</div>
							</div>
						</div>
						<?php endif; ?>
						
						<div class="inside">
						
							<?php /* <form action="<?php echo $_SESSION['car_availability']==2 ? 'step5.php' : 'step4.php' ?>" method="post" id="frmStep4"> */ ?>
							<form action="<?php echo $_SESSION['bookmode']==1 ? 'step5.php' : 'step4.php' ?>" method="post" id="frmStep4">
								<div id="guest" class="section">
									<h2>Your Details</h2>
									<div class="form-group row">
										<label for="firstname" class="col-sm-3 col-form-label">First Name:</label>
										<div class="col-sm-9">
											<input type="text" name="firstname" id="firstname" value="<?php echo htmlspecialchars($_SESSION['firstname'])?>" required/>
										</div>
									</div>
									<div class="form-group row">
										<label for="lastname" class="col-sm-3 col-form-label">Last Name:</label>
										<div class="col-sm-9">
											<input type="text" name="lastname" id="lastname" value="<?php echo htmlspecialchars($_SESSION['lastname'])?>" required/>
										</div>
									</div>
									<div class="form-group row">
										<label for="email" class="col-sm-3 col-form-label">Email:</label>
										<div class="col-sm-9">
											<input type="text" name="email" id="email" value="<?php echo htmlspecialchars($_SESSION['email'])?>" required/>
										</div>
									</div>
									<?php /* <div class="form-group row">
										<label for="phone" class="col-sm-3 col-form-label">Phone:</label>
										<div class="col-sm-9">
											<input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($_SESSION['phone'])?>" required/>
										</div>
									</div> */ ?>
									<div class="form-group row">
										<label for="phone" class="col-sm-3 col-form-label">Phone:</label>
										<div class="col-sm-9">
											<div class="row">
												<div class="col-xs-4">
													<input type="text" name="country_code" id="country_code" value="<?php echo htmlspecialchars($_SESSION['country_code'])?>" required />
													<script>
														// jQuery 
														$("#country_code").intlTelInput({
														  // options here
														});
														$("#country_code").on("countrychange", function() {
															var country_code = $('.country-list .active').attr('data-dial-code');
															$('#country_code').val('+'+country_code);
														});
													</script>
												</div>
												<div class="col-xs-8" style="padding-left:0">
													<input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($_SESSION['phone'])?>" required/>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label for="notraveling" class="col-sm-5 col-form-label">Number of people travelling:</label>
										<div class="col-sm-7">
											<select id="notraveling" name="notraveling" required>
												<option <?php echo htmlspecialchars($_SESSION['notraveling'])=='1'?'selected':''; ?> value="1">1</option>
												<option <?php echo htmlspecialchars($_SESSION['notraveling'])=='2'?'selected':''; ?> value="2">2</option>
												<option <?php echo htmlspecialchars($_SESSION['notraveling'])=='3'?'selected':''; ?> value="3">3</option>
												<option <?php echo htmlspecialchars($_SESSION['notraveling'])=='4'?'selected':''; ?> value="4">4</option>
												<option <?php echo htmlspecialchars($_SESSION['notraveling'])=='5'?'selected':''; ?> value="5">5</option>
												<option <?php echo htmlspecialchars($_SESSION['notraveling'])=='6'?'selected':''; ?> value="6">6+</option>
											</select>										
										</div>
									</div>
									<div class="form-group row">
										<label for="foundus" class="col-sm-5 col-form-label">How did you hear about us?</label>
										<div class="col-sm-7">
											<select id="foundus" name="foundus"></select>
										</div>
									</div>
								</div>
								<?php if($_SESSION['bookmode']==1 ): ?>
								<div id="disclaimer" class="section">
									<h2>Disclaimer</h2>
									<p><strong>IMPORTANT</strong></p>
									<p>By clicking EMAIL QUOTE NOW you will receive a quote that is valid for 5 days.</p>
									<p>To book in the quote please contact us on <strong>1 800 469 4790</strong> or press on the BOOKING REQUEST link within the email quote.</p>
									<span class="agreement"><input type="checkbox" name="tc" id="tc" value="yes" required /><label for="tc"> I have read and agreed to the <a href="/campervan-hire-usa/terms-and-conditions/" target="_blank" style="text-decoration: underline;">Terms and Conditions</a> and I am 21 years of age or older.</label></span>
																		
									<div id="form-error-book-now" style="display:none"></div>
									
									<p class="text-center"><a class="back" href="step2.php">Back</a>
									<input type="button" class="btn btn-default" onclick="Step4.controller.book_now();" id="book_now_button" value="EMAIL QUOTE NOW!"/>
									</p>
								</div>
								<?php else: ?>
									<?php if($_SESSION['car_availability']==2): ?>
									<div id="disclaimer" class="section">
										<h2>Request Only - This is Not a Booking</h2>
										<!-- <p><strong>NO PAYMENT REQUIRED</strong></p> -->
										<?php /* <p>This is a booking request. We will be in touch within 24 to 72 hours to confirm your booking based on our camervan availability.</p>
										<p>You can then decide if you would like to go ahead with the booking or not - no obligation.</p> */ ?>
										
										<?php /*
										<p>Thanks for your enquiry.</p>
										<p>A response will be sent within 24 to 72 hours.</p>
										<p>You can then decide if you would like to go ahead with the booking - NO OBLIGATION.</p> */ ?>
										
										<p>Thanks for your enquiry.</p>
										<p>The booking request is only confirmed once you receive a confirmation email and the deposit - <strong>$<?php echo $_SESSION['total_deposit']; ?></strong> - has been charged - a response will be sent to you within 24 to 48 hours.</p>
										
										<p>Once confirmed you may pick-up your campervan/RV at any time between 10 am to 4 pm and return at any time between 9 am to 3 pm.</p>
										
										<span class="agreement"><input type="checkbox" name="tc" id="tc" value="yes" required /><label for="tc"> I have read and agreed to the <a href="/campervan-hire-usa/terms-and-conditions/" target="_blank" style="text-decoration: underline;">Terms and Conditions</a> and I am 21 years of age or older.</label></span>
										<?php //echo $DS4->tc_url() ?>
										<div id="form-error-book-now" style="display:none"></div>
										
										<p class="text-center"><a class="back" href="step2.php">Back</a>
										<?php /* <input type="button" class="btn btn-default" onclick="Step4.controller.book_now();" id="book_now_button" value="SEND BOOKING REQUEST"/> */ ?>
										<input type="button" class="btn btn-default" onclick="Step4.controller.book_now();" id="book_now_button" value="BOOK NOW!"/>
										</p>
									</div>
									<?php else: ?>
									<div id="disclaimer" class="section">
										<h2>Disclaimer</h2>
										<p><strong>IMPORTANT</strong></p>
										<p>By clicking Book Now you will be directed to our secure payment area to enter your credit card details.</p>
										<p>You may pick-up your campervan/RV at any time between 10 am to 4 pm and return at any time between 9 am to 3 pm.</p>

										<p>A deposit of <strong><span id="deposit_currency"></span> $<!--<span id="deposit"></span>--><?php echo $_SESSION['total_deposit']; ?></strong> will be taken off your credit card to secure this booking.</p>
										<span class="agreement"><input type="checkbox" name="tc" id="tc" value="yes" required /><label for="tc"> I have read and agreed to the <a href="/campervan-hire-usa/terms-and-conditions/" target="_blank" style="text-decoration: underline;">Terms and Conditions</a> and I am 21 years of age or older.</label></span>
										
										<div id="form-error-book-now" style="display:none"></div>
										
										<p class="text-center"><a class="back" href="step2.php">Back</a>
										<input type="button" class="btn btn-default" onclick="Step4.controller.book_now();" id="book_now_button" value="BOOK NOW!"/>
										</p>
									</div>
									<?php endif; ?>
								<?php endif; ?>
								
								<input type="hidden" name="CustomerData" id="CustomerData" value="<?php echo htmlspecialchars($_SESSION["CustomerData"]);?>"/>
								<input type="hidden" name="ReservationRef" id="ReservationRef" value="<?php echo htmlspecialchars($_SESSION["ReservationRef"]);?>"/>
								<input type="hidden" name="ReservationNo" id="ReservationNo" value="<?php echo htmlspecialchars($_SESSION["ReservationNo"]);?>"/>
								<input type="hidden" name="total_deposit" value="<?php echo $_SESSION['total_deposit']; ?>"/>
							</form>
							<?php /*
							<script>
								$( "#frmStep4" ).validate({
								  rules: {
									field: {
									  required: true
									}
								  }
								});
							</script> */ ?>
						</div>
					</div>
					
					<div id="sidebar" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					
						<?=Template::itinerary()?>
						
						<?php // if($_SESSION['car_availability']!=2) echo Template::cart(1,0); ?>
						
						<?php echo Template::cart(1,0); ?>
						
					</div>					
				</div>
			</div>
		</main>
		
		<?php echo Template::footer()?>
		
	</body>
</html>
