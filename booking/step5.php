<?php

require 'bin/required.php';
require 'etc/steps-conf.php';

$CDV=new ControllerDefaultValues();
$_SESSION=$CDV->step3($_SESSION,$_POST);

// $_SESSION['car_availability']=2;

$DS6=new DataStep6();

$most_popular='none';
if(isset($_SESSION['CategoryType_vehicledescurl'])&&isset($_SESSION['most_popular'])){
	$url=parse_url($_SESSION['CategoryType_vehicledescurl']);
	if(isset($url['path'])&&trim($url['path'],'/')==$_SESSION['most_popular']){
		$most_popular='block';
	}
}

$DH=new DataHubspot();
$DH->step6($_COOKIE,$_SERVER,$_SESSION);
if(isset($_GET['debug'])){ echo "<pre>"; print_r($_SESSION); echo "</pre>"; }

if(isset($_POST)){ //if booking request form submitted (step 3)
	
	if(isset($_POST['firstname'])) $_SESSION['firstname'] = $_POST['firstname'];
	if(isset($_POST['lastname'])) $_SESSION['lastname'] = $_POST['lastname'];
	if(isset($_POST['email'])) $_SESSION['email'] = $_POST['email'];
	if(isset($_POST['country_code'])) $_SESSION['country_code'] = $_POST['country_code'];
	if(isset($_POST['phone'])) $_SESSION['phone'] = $_POST['phone'];
}

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

		ga('require', 'ecommerce');
		ga('ecommerce:addTransaction', {
			'id': '<?php echo htmlspecialchars($_SESSION['ReservationNo'])?>',
			'revenue': '<?php echo htmlspecialchars($_SESSION['total_price'])?>',
			'currency': '<?php echo $CDV->analytics_currency()?>'
		});
		ga('ecommerce:addItem', {
			'id': '<?php echo htmlspecialchars($_SESSION['ReservationNo'])?>',
			'name': '<?php echo htmlspecialchars($_SESSION['CategoryType_name'])?>',
			'price': '<?php echo htmlspecialchars($_SESSION['total_price'])?>',
			'currency': '<?php echo $CDV->analytics_currency()?>',
			'quantity': 1
		});
		ga('ecommerce:send');
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
		  dataLayer.push({
			'ecommerce': {
			  'currencyCode': 'USD',
			  'purchase': {
				'actionField': {
				  'id': '<?php echo htmlspecialchars($_SESSION['ReservationNo'])?>',
				  'revenue': '<?php echo htmlspecialchars($_SESSION['total_price']+$_SESSION['total_gst'])?>',
				  'tax':'<?php echo htmlspecialchars($_SESSION['total_gst'])?>',
				  'coupon': '<?php echo htmlspecialchars($_SESSION['PromoCode'])?>'
				},
				'products': [{
				  'name': '<?php echo htmlspecialchars($_SESSION['CategoryType_name'])?>',
				  'price': '<?php echo htmlspecialchars($_SESSION['total_price'])?>',
				  'category': '<?php echo htmlspecialchars($_SESSION['CategoryType_name'])?>',
				  'quantity': 1
				 }]
			  }
			}
		  });
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
		<?php echo ViewCSS::draw('step6.css');?>
		<?php echo ViewCSS::draw('style-v7.css');?>
		<?php echo ViewJS::draw('jquery-2.1.3.min.js');?>
		<?php echo ViewJS::draw('bootstrap.min.js');?>
		<?php echo ViewJS::draw('Template.js');?>
		<?php echo ViewJS::draw('Select.js');?>
		<?php echo ViewJS::draw('Log.js');?>
		<?php echo ViewJS::draw('View.js');?>
		<?php echo ViewJS::draw('Controller.js');?>
		<script src="<?php echo ControllerSourceSite::api_url_get()?>" type="text/javascript"></script>
		<script type="text/javascript">
		</script>
		<?php echo $CDV->remarketing_code(); ?>
	</head>
	<body>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K6FFFT3"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->		
		
		<?php echo Template::header(ViewNav::step6())?>
		<main>
			<div class="container layout-center">
				<?php /*
				<article>
					<div class="booking-content">
						
						<div class="contact-column left">
							<h2>Booking Confirmed </h2>
							
							<img
								class="main"
								src="<?php echo $_SESSION['CategoryType_imagename']?>"
								alt="<?php echo htmlspecialchars($_SESSION['CategoryType_name'])?>"
								title="<?php echo htmlspecialchars($_SESSION['CategoryType_name'])?>"/>
							<img src="/booking/image/most-popular-step2.png" class="most-popular" style="display:<?php echo $most_popular?>" />

						</div>
						<div class="content-column top">
							<div class="info">
								<a href="javascript:void(0);"
									onclick="window.open('<?php echo $_SESSION['CategoryType_vehicledescurl']?>','Car','width=600,height=800,menu=no,toolbar=no,scrollbars=yes,status=no');return false;"
									target="_blank"
									title="Click here for detailed description">
									<img src="image/info.png" alt="info">
								</a>
							</div>
							
							<h2><?php echo str_replace(array('(',')'),array('<span>(',')</span>'),htmlspecialchars($_SESSION['CategoryType_name']))?></h2>
							<table class="confirmation-content">
								<tr>
									<th class="tb-group">Reference Number:</th>
									<td class="tb-group"><?php echo htmlspecialchars($_SESSION['ReservationNo'])?></td>
								</tr>
								<tr>
									<th>Name:</th>
									<td><?php echo htmlspecialchars($_SESSION['firstname'])?> <?php echo htmlspecialchars($_SESSION['lastname'])?></td>
								</tr>
								<tr>
									<th>Phone:</th>
									<td><?php echo htmlspecialchars($_SESSION['phone'])?></td>
								</tr>
								
								<tr>
									<th class="tb-group">Email:</th>
									<td class="tb-group"><?php echo htmlspecialchars($_SESSION['email'])?></td>
								</tr>
								
								<tr>
									<th>Pickup Location:</th>
									<td>
										<?php echo htmlspecialchars($_SESSION['PickupLocation_name'])?>
										<br/>
										<?php echo htmlspecialchars($DS6->address($_SESSION['PickupLocation_name']))?>
									</td>
								</tr>
								<tr>
									<th valign="top" class="tb-group">Pickup Date & Time:</th>
									<td class="tb-group"><?php echo htmlspecialchars(DataDate::aus2date($_SESSION['PickupDate'],'l d/m/Y'))?></td>
								</tr>
								
								<tr>
									<th>Return Location:</th>
									<td>
										<?php echo htmlspecialchars($_SESSION['DropOffLocation_name'])?>
										<br/>
										<?php echo htmlspecialchars($DS6->address($_SESSION['DropOffLocation_name']))?>
									</td>
								</tr>
								
								<tr>
									<th valign="top" class="tb-group">Return Date & Time:</th>
									<td class="tb-group"><?php echo htmlspecialchars(DataDate::aus2date($_SESSION['ReturnDate'],'l d/m/Y'))?></td>
								</tr>
								
								<tr>
									<th>TOTAL PRICE:</th>
									<td>$<?php echo htmlspecialchars($_SESSION['total_price'])?>
										(inc $<?php echo htmlspecialchars($_SESSION['total_gst'])?> GST)</td>
								</tr>
							</table>
						</div>
						
						<div class="content-column bottom">
							<p>A copy of this information with all details has been emailed to you.</p>
		<h4>OPENING TIMES FOR PICK-UPS/DROP-OFFS:</h4>
		<p>
			Monday - Friday:<br/>
			&nbsp;&nbsp;Pick-up 9 am - 4:00 pm<br/>
			&nbsp;&nbsp;Drop-off 9 am - 4:00 pm<br/>
			Saturday:<br/>
			&nbsp;&nbsp;Pick-up 9 am - 12:00 pm<br/>
			&nbsp;&nbsp;Drop-off 9 am - 12:00 pm</p>
		<?php echo $CDV->low_season()?>
		<h4>HOW TO GET TO US:</h4>
		<p>Please <a href="<?php echo $CDV->get_to_us_url()?>"  target="_blank">click here</a> for
		directions to our branches from the airport or city center.</p>				
						
						<h4>CONTACT US</h4>
		<table class="contact-table">
			<tbody><?php echo $CDV->phone_numbers()?>
			<tr>
				<td>United Kingdom</td>
				<td>020 3287 8375</td>
			</tr>
			<tr>
				<td>United States</td>
				<td>0213 438 9976</td>
			</tr>
			<tr>
				<td>Germany</td>
				<td>06103 3723 922</td>
			</tr>
			<tr>
				<td>International</td>
				<td>+61 2 9360 1500</td>
			</tr>
			<tr>
				<td><a href="skype:tab_bookings?call" class="skype"><img src="image/skype.png">Skype</a></td>
				<td></td>
			</tr>
		</tbody></table>
		<?php echo $CDV->flags()?>
						
						
						
						
						
						</div>
						<div class="contact-column bottom">
									
						</div>
					</div>
				</article>

				<aside>
				</aside> */ ?>
				
				<div class="row">
					
					<div class="top content col-lg-8 col-md-8 col-sm-12 col-xs-12">
						<div class="row">
							<?php /* <div class="col-sm-5 col-xs-12"><img src="<?php echo $_SESSION['CategoryType_imageurl'] ;?>" /></div> */
							switch($_SESSION['CategoryType_name']){
								case "Ventura":
									$car_image='image/campervans/ventura.png';				
									break;
								case "Maverick":
									$car_image='image/campervans/maverick.png';
									break;
								// case "Hitop Campervan":
									// $car_image='image/campervans/hitop.png';				
									// break;
								// case "Kuga Campervan":
									// $car_image='image/campervans/kuga.png';
									// break;
								default:
									$car_image=$_SESSION['CategoryType_imageurl'];
									break;
							} ?>							
							<div class="col-sm-3 col-xs-12"><img src="<?php echo $car_image; ?>" /></div>
							<div class="col-sm-7 col-xs-12">
								<?php
								$book_text = $_SESSION['car_availability']==2?'On Request:':'Booked:';
								$book_text = $_SESSION['bookmode']==2?$book_text:'Quoted:';
								?>								
								<span class="booked"><?php echo $book_text; ?> <span class="text-light0"><?php echo $_SESSION['CategoryType_name'];?></span></span>
								<span class="confirmed">Confirmed: <span class="text-light0">#<?php echo $_SESSION['ReservationNo'];?></span></span>
							</div>
							<div class="col-sm-2 col-xs-12"><img src="<?php echo $_SESSION['car_availability']==2?'image/on-it.png':'image/lets.png'; ?>" /> </div>
						</div>
					</div>
					
					<div id="content" class="content col-lg-8 col-md-8 col-sm-12 col-xs-12">
						
						<div class="inside">
							<div id="booking-details" class="guest-fields section">
								<?php
								switch($_SESSION['bookmode']){
									case 1:
										$session_title='Quote Details';
										break;
									case 2:
									default:											
										$session_title='Booking Details';
										break;
								}
								?>
								<h2><?php echo $session_title; ?></h2>
								<div class="row">
									<?php
									switch($_SESSION['PickupLocationID']){
										case "13": //Denver												
												$pickupAddress='3538 Peoria St, #504, Aurora 80010 CO';
											break;
										case "10": //Las Vegas												
												$pickupAddress='3347 S. Highland Dr, Ste 309, Las Vegas 89109 NV';
											break;
										case "1": //Los Angeles										
												$pickupAddress='4858 W Century Blvd, Inglewood 90304 CA';
											break;
										case "12": //Miami									
												$pickupAddress='1239 Alton Rd, Suite # 7, Miami Beach 33139 FL';
											break;
										case "11": //New York									
												$pickupAddress='11 Marín Blvd, Jersey City 07302 NJ';
											break;
										case "9": //San Francisco						
												$pickupAddress='22990 Clawiter Rd Hayward 94545 CA';
											break;
										case "14": //Seattle					
												$pickupAddress='22834 Pacific Hwy South, Des Moines 98198 WA';
												// $pickupAddress='478 Barbara Blv Way, Beverly Hills 90210 CA';
											break;
										default:
												$pickupAddress='Please check your email confirmation';
											break;
									}
									switch($_SESSION['DropOffLocationID']){
										case "13": //Denver												
												$returnAddress='3538 Peoria St, #504, Aurora 80010 CO';
											break;
										case "10": //Las Vegas												
												$returnAddress='3347 S. Highland Dr, Ste 309, Las Vegas 89109 NV';
											break;
										case "1": //Los Angeles										
												$returnAddress='4858 W Century Blvd, Inglewood 90304 CA';
											break;
										case "12": //Miami									
												$returnAddress='1239 Alton Rd, Suite # 7, Miami Beach 33139 FL';
											break;
										case "11": //New York									
												$returnAddress='11 Marín Blvd, Jersey City 07302 NJ';
											break;
										case "9": //San Francisco						
												$returnAddress='22990 Clawiter Rd Hayward 94545 CA';
											break;
										case "14": //Seattle											
												$returnAddress='22834 Pacific Hwy South, Des Moines 98198 WA';
												// $returnAddress='876 The Strip, Old Las Vegas NV 76389';
											break;
										default:
												$returnAddress='Please check your email confirmation';
											break;
									}
									?>
									
									<?php if($_SESSION['car_availability']==2): ?>
									
									<span class="field col-sm-5 col-xs-12">Pick Up Location:</span><span class="value col-sm-7 col-xs-12"><?php echo !empty($_SESSION['PickupLocation_name'])?$_SESSION['PickupLocation_name']:'-';?></span>
									<span class="field col-sm-5 col-xs-12">Pick Up Address:</span><span class="value col-sm-7 col-xs-12"><?php echo $pickupAddress; ?></span>
									<?php /* <span class="field col-sm-5 col-xs-12">Pick Up Address:</span><span class="value col-sm-7 col-xs-12">Please visit our <a target="_blank" href="https://www.escapecampervans.com/locations/">website</a></span> */ ?>
									<?php /*<span class="field col-sm-5 col-xs-12">Pick Up Date and Time:</span><span class="value col-sm-7 col-xs-12"><?php echo !empty($_SESSION['PickupDate_formatted'])?$_SESSION['PickupDate_formatted'] . ' - ' . $_SESSION['PickupTime']:'-';?></span>*/ ?>
									<span class="field col-sm-5 col-xs-12">Pick Up Date and Time:</span><span class="value col-sm-7 col-xs-12"><?php echo !empty($_SESSION['PickupDate_formatted'])?$_SESSION['PickupDate_formatted'] . '<span class="second-line">' . 'Once confirmed your pick-up time for your campervan/RV will be at any time between 10 am to 4 pm' . '</span>' :'-';?></span>
									<span class="field col-sm-5 col-xs-12">Return Location:</span><span class="value col-sm-7 col-xs-12"><?php echo !empty($_SESSION['DropOffLocation_name'])?$_SESSION['DropOffLocation_name']:'-';?></span>
									<span class="field col-sm-5 col-xs-12">Return Address:</span><span class="value col-sm-7 col-xs-12"><?php echo $returnAddress; ?></span>
									<?php /* <span class="field col-sm-5 col-xs-12">Return Address:</span><span class="value col-sm-7 col-xs-12">Please visit our <a target="_blank" href="https://www.escapecampervans.com/locations/">website</a></span>	*/ ?>
									<?php /* <span class="field col-sm-5 col-xs-12">Return Date and Time:</span><span class="value col-sm-7 col-xs-12"><?php echo !empty($_SESSION['ReturnDate_formatted'])?$_SESSION['ReturnDate_formatted'] . ' - ' . $_SESSION['ReturnTime']:'-';?></span> */ ?>
									<span class="field col-sm-5 col-xs-12">Return Date and Time:</span><span class="value col-sm-7 col-xs-12"><?php echo !empty($_SESSION['ReturnDate_formatted'])?$_SESSION['ReturnDate_formatted'] . '<span class="second-line">' . 'Please return your vehicle at any time between 9 am to 3 pm – thank you' . '</span>'  :'-';?></span>
									
									<?php else: ?>
									
									<span class="field col-sm-5 col-xs-12">Pick Up Location:</span><span class="value col-sm-7 col-xs-12"><?php echo !empty($_SESSION['PickupLocation_name'])?$_SESSION['PickupLocation_name']:'-';?></span>
									<span class="field col-sm-5 col-xs-12">Pick Up Address:</span><span class="value col-sm-7 col-xs-12"><?php echo $pickupAddress; ?></span>
									<?php /* <span class="field col-sm-5 col-xs-12">Pick Up Address:</span><span class="value col-sm-7 col-xs-12">Please visit our <a target="_blank" href="https://www.escapecampervans.com/locations/">website</a></span> */ ?>
									<?php /*<span class="field col-sm-5 col-xs-12">Pick Up Date and Time:</span><span class="value col-sm-7 col-xs-12"><?php echo !empty($_SESSION['PickupDate_formatted'])?$_SESSION['PickupDate_formatted'] . ' - ' . $_SESSION['PickupTime']:'-';?></span>*/ ?>
									<span class="field col-sm-5 col-xs-12">Pick Up Date and Time:</span><span class="value col-sm-7 col-xs-12"><?php echo !empty($_SESSION['PickupDate_formatted'])?$_SESSION['PickupDate_formatted'] . '<span class="second-line">' . 'You can pick-up your campervan/RV at any time between 10am-4pm' . '</span>' :'-';?></span>
									<span class="field col-sm-5 col-xs-12">Return Location:</span><span class="value col-sm-7 col-xs-12"><?php echo !empty($_SESSION['DropOffLocation_name'])?$_SESSION['DropOffLocation_name']:'-';?></span>
									<span class="field col-sm-5 col-xs-12">Return Address:</span><span class="value col-sm-7 col-xs-12"><?php echo $returnAddress; ?></span>
									<?php /* <span class="field col-sm-5 col-xs-12">Return Address:</span><span class="value col-sm-7 col-xs-12">Please visit our <a target="_blank" href="https://www.escapecampervans.com/locations/">website</a></span>	*/ ?>
									<?php /* <span class="field col-sm-5 col-xs-12">Return Date and Time:</span><span class="value col-sm-7 col-xs-12"><?php echo !empty($_SESSION['ReturnDate_formatted'])?$_SESSION['ReturnDate_formatted'] . ' - ' . $_SESSION['ReturnTime']:'-';?></span> */ ?>
									<span class="field col-sm-5 col-xs-12">Return Date and Time:</span><span class="value col-sm-7 col-xs-12"><?php echo !empty($_SESSION['ReturnDate_formatted'])?$_SESSION['ReturnDate_formatted'] . '<span class="second-line">' . 'Please return your vehicle at any time between 9am-3pm – thank you' . '</span>'  :'-';?></span>
									
									<?php endif; ?>
								</div>
							</div>
							<div id="customer-details" class="guest-fields section">
								<h2>Customer Details</h2>
								<div class="row">
									<?php
									$firstname = !empty($_SESSION['firstname'])?$_SESSION['firstname']:($_POST['firstname']?$_POST['firstname']:'-');
									$lastname = !empty($_SESSION['lastname'])?$_SESSION['lastname']:($_POST['lastname']?$_POST['lastname']:'-');
									$email = !empty($_SESSION['email'])?$_SESSION['email']:($_POST['email']?$_POST['email']:'-');
									$country_code = !empty($_SESSION['country_code'])?$_SESSION['country_code']:($_POST['country_code']?$_POST['country_code']:'');
									$phone = !empty($_SESSION['phone'])?$_SESSION['phone']:($_POST['phone']?$_POST['phone']:'');
									$phone_address = !empty($country_code.$phone)?$country_code.'-'.$phone:'-';
									?>
									<span class="field col-sm-5 col-xs-12">First Name:</span><span class="value col-sm-7 col-xs-12"><?php echo $firstname;?></span>
									<span class="field col-sm-5 col-xs-12">Last Name:</span><span class="value col-sm-7 col-xs-12"><?php echo $lastname;?></span>
									<span class="field col-sm-5 col-xs-12">Phone:</span><span class="value col-sm-7 col-xs-12"><?php echo $phone_address;?></span>
									<span class="field col-sm-5 col-xs-12">Email:</span><span class="value col-sm-7 col-xs-12"><?php echo $email;?></span>
								</div>
								
								<?php if($_SESSION['car_availability']==2): ?>
								<div class="paid-deposit row">
									<?php /*
									<div class="col-xs-12">
										This is only a request availablity check and not a booking.<br />
										We will respond within 24 to 72 hours and advise of availability.<br />
										You can then decide if you would like to ahead with the booking.<br />
									</div> */ ?>
									<div class="col-xs-12">
										<strong>AVAILABILITY ON REQUEST</strong> - The booking is only confirmed once you receive a confirmation email and the deposit – of $<?php echo $_SESSION['total_deposit'];?> - has been charged.
									</div>
								</div>
								
								<div class="pickup-amount row">
									<div class="col-sm-7 col-xs-12">Total Price</div>
									<div class="col-sm-5 col-xs-12">
									<div class="pricing">
										<?php
										$price=$_SESSION['total_price'];
										$gst=$_SESSION['total_gst'];
										$priceInclTax=$price+$gst;
										$priceincltax_arr=explode('.',$priceInclTax);
										?>
										<span class="curr-symbol">$</span><span class="price-num"><?php echo isset($priceincltax_arr[0])?$priceincltax_arr[0]:0; ?></span><span class="small"><?php echo isset($priceincltax_arr[1])?'.'.$priceincltax_arr[1]:'.00'; ?></span><span class="curr-text">USD</span>
										<span class="tax">Incl. Sales Tax: $<?php echo !empty($gst)?$gst:'0.00'; ?></span>
									</div></div>
								</div>
								
								<?php else: ?>
								
								<div class="paid-deposit row">
									<div class="col-xs-12">
										<?php 
										$total_deposit=number_format((float)$_SESSION['total_deposit'], 2, '.', '');
										?>
										<?php
										switch($_SESSION['bookmode']){
											case 1: ?>	
												Your quote has been emailed to you and is valid for 5 days.<br /> 
												To book in the quote please contact us on 1 800 469 4790 or press on the BOOKING REQUEST link within the email quote. A deposit of $<?php echo $total_deposit;?> is required to book in this quote.
											<?php break;
											case 2:
											default: ?>											
												Deposit of <?php echo $total_deposit;?> has been paid.<br />
												An email confirmation has been sent to you.
											<?php break;
										}
										?>
									</div>
								</div>
								
									<?php if($_SESSION['bookmode']==2): ?>
									<div class="pickup-amount row">
										<div class="col-sm-7 col-xs-12">Amount due on pick up</div>
										<div class="col-sm-5 col-xs-12">
										<div class="pricing">
											<?php
											$price=$_SESSION['total_price'];
											$gst=$_SESSION['total_gst'];
											$gst=number_format((float)$gst, 2, '.', '');
											$rest=$price+$gst-$_SESSION['total_deposit'];
											$rest=number_format((float)$rest, 2, '.', '');
											$rest_arr=explode('.',$rest);
											?>
											<span class="curr-symbol">$</span><span class="price-num"><?php echo isset($rest_arr[0])?$rest_arr[0]:0; ?></span><span class="small"><?php echo isset($rest_arr[1])?'.'.$rest_arr[1]:'.00'; ?></span><span class="curr-text">USD</span>
											<span class="tax">Incl. Sales Tax: $<?php echo !empty($gst)?$gst:'0.00'; ?></span>
										</div></div>
									</div>
									<?php endif; ?>
								
								<?php endif; ?>
								
							</div>
						</div>
					</div>
					<div class="print content col-lg-8 col-md-8 col-sm-12 col-xs-12">
						<a href="#" onClick="window.print();"><img src="image/print.png" /><span>Print this page</span></a>
					</div>
				</div>
			</div>
		</main>
		
		<?php echo Template::footer()?>
		
	</body>
</html>
