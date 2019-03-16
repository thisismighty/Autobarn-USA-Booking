<?php
header('X-XSS-Protection:0');

require 'bin/required.php';
require 'etc/steps-conf.php';

$CDV=new ControllerDefaultValues();
$_SESSION=$CDV->step5($_SESSION,$_POST);

$DH=new DataHubspot();
$DH->step4($_COOKIE,$_SERVER,$_SESSION);
if(isset($_GET['debug'])){ echo "<pre>"; print_r($_SESSION); echo "</pre>"; }

// if($_SESSION['car_availability']==2)
	// header('location:step3.php');
if($_SESSION['bookmode']==1)
	header('location:step3.php');

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
		<?php echo ViewCSS::draw('body.css');?>
		<?php echo ViewCSS::draw('nav.css');?>
		<?php echo ViewCSS::draw('step5.css');?>
		<?php echo ViewCSS::draw('style-v7.css');?>
		<?php echo ViewJS::draw('jquery-2.1.3.min.js');?>
		<?php echo ViewJS::draw('bootstrap.min.js');?>
		<?php echo ViewJS::draw('Template.js');?>
		<?php echo ViewJS::draw('Select.js');?>
		<?php echo ViewJS::draw('Log.js');?>
		<?php echo ViewJS::draw('View.js');?>
		<?php echo ViewJS::draw('Controller.js');?>
		<script src="<?php echo ControllerSourceSite::api_url_get()?>" type="text/javascript"></script>
		<?php echo ViewJS::draw('Step5.js');?>
		<script type="text/javascript">
			Step5.data=<?php echo json_encode($_SESSION)?>;
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
		</script>
		<?php echo $CDV->remarketing_code(); ?>
	</head>
	<body>		
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K6FFFT3"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		
		<?php echo Template::header(ViewNav::step5())?>
		<main>
			<div class="container">
				<?php /*
				<article>
					<div class="row">
						<h2>Secure Credit Card Payment</h2>
						<img src="image/visa_mastercard.jpg" alt="visa/mastercard" title="visa/mastercard" width="200"/>
					</div>
					<iframe id="frmAuric" name="frmAuric" src="about:blank" frameborder="0"></iframe>
					<div class="row">
						<div>
							<img src="image/Auric.png" alt="Auric" title="Auric" />
							<div>Secured by www.auricsystems.com</div>
							<div>Auric Systems is a Level 1 PCI DSS Validated Service Provider.</div>
						</div>
						<img src="image/pci_dss.png" alt="PCI DSS" title="PCI DSS" />
					</div>
				</article>
				<aside>
				</aside> */ ?>
				<div class="row">
					
					<div id="content" class="content col-lg-8 col-md-8 col-sm-12 col-xs-12">
					
						<div class="inside">
						
							<form action="step5.php" method="post" id="frmStep5">
								<div id="payment" class="section">
									<h2>Payment</h2>
									<?php /*
									<div class="form-group row">
										<label for="" class="col-sm-4 col-form-label">Card Type:</label>
										<div class="col-sm-8">
											<select id="">
												<option value="">Credit Card: Visa</option>
												<option value="">Credit Card: Mastercard</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-4 col-form-label">Payment Type:</label>
										<div class="col-sm-8">
											<select id="">
												<option value="">Down payment Only</option>
												<option value="">Pickup</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-4 col-form-label">Card Number:</label>
										<div class="col-sm-8">
											<input id="" type="text" />
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-4 col-form-label">Card Expiry:</label>
										<div class="col-sm-8">
											<input id="" type="text" />
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-4 col-form-label">Card Holder Name:</label>
										<div class="col-sm-8">
											<input id="" type="text" />
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-sm-4 col-form-label">CVV:</label>
										<div class="col-sm-8">
											<input id="" type="text" />
										</div>
									</div> */ ?>
									
									<div class="centered">
										
										<img src="image/visa_mastercard.jpg" alt="visa/mastercard" title="visa/mastercard" width="200"/>
										<br /><br />
										<div id="iframewrap">
											<iframe id="frmAuric" name="frmAuric" src="about:blank" frameborder="0"></iframe>
										</div>
										<br /><br />
										<div class="row">
											<div>
												<img src="image/Auric.png" alt="Auric" title="Auric" />
												<div>Secured by www.auricsystems.com</div>
												<div>Auric Systems is a Level 1 PCI DSS Validated Service Provider.</div>
											</div>
											<img src="image/pci_dss.png" alt="PCI DSS" title="PCI DSS" />
										</div>
									</div>
									
									<?php // if($_SESSION['car_availability']!=2): ?>
									<div class="deposit row">
										<div class="col-sm-8 col-xs-6">Pay Down Payment Only:</div>
										<?php
										$deposit=$_SESSION['total_deposit'];
										$deposit=number_format((float)$deposit, 2, '.', '');
										$deposit_arr=explode('.',$deposit);
										?>
										<div class="col-sm-4 col-xs-6"><span class="curr-symbol">$</span><span class="price"><?php echo isset($deposit_arr[0])?$deposit_arr[0]:0; ?></span><span class="small-num"><?php echo isset($deposit_arr[1])?'.'.$deposit_arr[1]:'.00'; ?></span><span class="curr-text">USD</spaN></div>
									</div>
									
									<div class="pickup row">
										<?php
										$price=$_SESSION['total_price'];
										$gst=$_SESSION['total_gst'];
										$rest=$price+$gst-$deposit;
										$rest=number_format((float)$rest, 2, '.', '');
										$rest_arr=explode('.',$rest);
										?>
										<div class="col-sm-8 col-xs-6">Amount Due on Pick Up:</div>
										<div class="col-sm-4 col-xs-6"><span class="curr-symbol">$</span><span class="price"><?php echo isset($rest_arr[0])?$rest_arr[0]:0; ?></span><span class="small-num"><?php echo isset($rest_arr[1])?'.'.$rest_arr[1]:'.00'; ?></span><span class="curr-text">USD</spaN></div>
									</div>
									<?php // endif; ?>
									
									<!-- <p class="text-center"><a class="back" href="step3.php">Back</a><button class="btn btn-default">PAY NOW!</button></p> -->
								</div>
								<div id="guest-details" class="guest-fields section">
									<h2>Your Details</h2>
									<div class="row">
										<?php
										$firstname = !empty($_SESSION['firstname'])?$_SESSION['firstname']:'-';
										$lastname = !empty($_SESSION['lastname'])?$_SESSION['lastname']:'-';
										$email = !empty($_SESSION['email'])?$_SESSION['email']:'-';
										$country_code = !empty($_SESSION['country_code'])?$_SESSION['country_code']:'';
										$phone = !empty($_SESSION['phone'])?$_SESSION['phone']:'';
										$phone_address = !empty($country_code.$phone)?$country_code.'-'.$phone:'-';
										?>
										<span class="field col-xs-5">First Name:</span><span class="value col-xs-7"><?php echo $firstname; ?></span>
										<span class="field col-xs-5">Last Name:</span><span class="value col-xs-7"><?php echo $lastname; ?></span>
										<span class="field col-xs-5">Phone:</span><span class="value col-xs-7"><?php echo $phone_address; ?></span>
										<span class="field col-xs-5">Email:</span><span class="value col-xs-7"><?php echo $email; ?></span>									
									</div>
								</div>
							</form>
						</div>
					</div>
					
					<div id="sidebar" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					
						<?=Template::itinerary()?>
						
						<?=Template::cart(0,0)?>
						
					</div>					
				</div>
			</div>
		</main>
		
		<?php echo Template::footer()?>
		
	</body>
</html>
