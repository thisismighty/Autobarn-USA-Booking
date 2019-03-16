<?php
header('X-XSS-Protection:0');

require 'bin/required.php';
require 'etc/steps-conf.php';

$CDV=new ControllerDefaultValues();
$_SESSION=$CDV->step2($_SESSION,$_POST);

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
		</script> */ ?>
		
		<script>
		  var dataLayer = window.dataLayer || [];
		</script>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-K6FFFT3');</script>

		<?php /*
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-K6FFFT3');</script>
		*/ ?>
		<!-- End Google Tag Manager -->
<?php echo ViewCSS::draw('bootstrap.min.css');?>
		<?php echo ViewCSS::draw('font-awesome.min.css');?>
		<?php echo ViewCSS::draw('body.css');?>
		<?php echo ViewCSS::draw('nav.css');?>
		<?php echo ViewCSS::draw('jquery-ui.css');?>
		<?php echo ViewCSS::draw('step2.css');?>
		<?php echo ViewCSS::draw('style-v7.css');?>
		<?php echo ViewJS::draw('jquery-2.1.3.min.js');?>
		<?php echo ViewJS::draw('jquery-ui.min.js');?>
		<?php echo ViewJS::draw('bootstrap.min.js');?>
		<?php echo ViewJS::draw('jquery-dateformat.min.js');?>
		<?php echo ViewJS::draw('Template.js');?>
		<?php echo ViewJS::draw('Select.js');?>
		<?php echo ViewJS::draw('Log.js');?>
		<?php echo ViewJS::draw('View.js');?>
		<?php echo ViewJS::draw('Controller.js');?>
		<script src="<?php echo ControllerSourceSite::api_url_get()?>" type="text/javascript"></script>
		<?php echo ViewJS::draw('Step2.js');?>
		<?php echo ViewJS::draw('Step2View.js');?>
		<script type="text/javascript">
			Step2.data=<?php echo json_encode($_SESSION)?>;
			Step2.data.usp=<?php echo json_encode($DUSP->get())?>;
			View.media_queries=<?php echo json_encode(ViewCSS::media_queries())?>;			
		</script>
        <?php echo $CDV->remarketing_code(); ?>
	</head>
	<body class="step-1">
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K6FFFT3"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		<?php echo Template::header(ViewNav::step2())?>
		<main>
			<div class="container">
						 
		 
		   
				<article>
					<?php echo Template::searchFrom(); ?>
				</article>
				
				<aside>
					<script type="text/html" id="peoplegraphic_one_html">
						<div class="adult"><img src="image/adult.png"> <span class="multi"><i class="fa fa-remove"></i></span> <span class="num">%no</span></div>
						
					</script>
					
					<script type="text/html" id="peoplegraphic_html">
						<div class="featured adults">
							<img src="image/adult.png">
							<span class="multi1">Adults: %numberofadults</span>
						</div>
						<div class="featured microwave">
							<img src="image/microwafe.png">
							<span class="multi1">Microwave</span>
						</div>
						<div class="featured fridge">
							<img src="image/fridge.png">
							<span class="multi1">Fridge</span>
						</div>
						<div class="featured gas-cooker">
							<img src="image/gascooker-sink.png">
							<span class="multi1">Gas Cooker<br>& Sink</span>
						</div>				
					</script>
					<script type="text/html" id="peoplegraphic_kuga_html">
						<div class="featured adults">
							<img src="image/adult.png">
							<span class="multi1">Adults: %numberofadults</span>
						</div>
						<div class="featured microwave">
							<img src="image/microwafe.png">
							<span class="multi1">Microwave</span>
						</div>
						<div class="featured fridge">
							<img src="image/fridge.png">
							<span class="multi1">Fridge</span>
						</div>
						<div class="featured gas-cooker">
							<img src="image/gascooker-sink.png">
							<span class="multi1">Gas Cooker<br>& Sink</span>
						</div>				
						<div class="featured solar-panel">
							<img src="image/solar-panel.png">
							<span class="multi1">Solar<br>Panel</span>
						</div>				
					</script>
					<script type="text/html" id="peoplegraphic_stationwagon_html">
						<div class="featured adults">
							<img src="image/adult.png">
							<span class="multi1">Adults: %numberofadults</span>
						</div>
						<div class="featured tent">
							<img src="image/tent.png">
							<span class="multi1">Tent<br>Optional</span>
						</div>
						<div class="featured chairs">
							<img src="image/chairs.png">
							<span class="multi1">Chairs<br>Optional</span>
						</div>
						<div class="featured esky">
							<img src="image/esky.png">
							<span class="multi1">Esky<br>Optional</span>
						</div>				
						<div class="featured gas-cooker">
							<img src="image/gascooker.png">
							<span class="multi1">Gas Cooker<br>Optional</span>
						</div>				
					</script>
					<?php /*
					<script type="text/html" id="peoplegraphic_html">
						<div class="adult"><img src="image/adult.png"> <span class="multi"><i class="fa fa-remove"></i></span> <span class="num">%numberofadults</span></div>
						<div class="child"><img src="image/child.png"> <span class="multi"><i class="fa fa-remove"></i></span> <span class="num">%numberofchildren</span></div>
						<div class="big-case"><img src="image/big-case.png"> <span class="multi"><i class="fa fa-remove"></i></span> <span class="num">%numberoflargecases</span></div>
						<div class="small-case"><img src="image/small-case.png"> <span class="multi"><i class="fa fa-remove"></i></span> <span class="num">%numberofsmallcases</span></div>				
					</script> */ ?>
					<script type="text/html" id="nocar_html">
						No result found.
					</script>
					<script type="text/html" id="car_html">
						<div class="vechicle iol">
							<div class="row">
								<div class="vehicle-linfo col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="pic">
										<img src="%imageurl" alt="%categoryfriendlydescription" title="%categoryfriendlydescription"/>
									</div>
									<div class="features">
									%peoplegraphic
									</div>
									<div class="more">
										<a href="javascript:void(0);"
										onclick="window.open('%vehicledescriptionurl','Car','width=600,height=800,menu=no,toolbar=no,scrollbars=yes,status=no');return false;"
										title="Click here for detailed description">Vehicle Information</a>
										%mostpopular
									</div>							
								</div>
								<div class="vehicle-rinfo col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<h3 class="title">%categoryfriendlydescription</h3>
									<span class="rental-days">%numberofdays Rental Days</span><span class="rate">Daily Rate $%avgrate </span>
									%totaldiscount_html
									%freedays_html
									%relocfee_html
									%unattendedfee_html
									%afterhourfee_html
									%mandatoryfee_html									
									%governmentfee_html
									<!-- <div class="space"></div> -->
									<div class="space"></div>
									%mandatoryfee_free_html
									%need_request_html
									%unavailable_html
									<div class="pricing">
										<span class="curr-symbol">$</span><span class="price-num">%price_exclude_tax</span><span class="small">%small</span><span class="curr-text">USD</span>
										<span class="tax">Excludes Sales Tax</span>
									</div>
									%book_html
									<input type="hidden" class="mandatoryfee_value" value='%mandatoryfee_value' />
								</div>
								<?php /*
									<div class="carDetails">
										<div class="tb">
											<div class="tb-row">
												<div class="info">
													<a href="javascript:void(0);"
														onclick="window.open('%vehicledescurl','Car','width=600,height=800,menu=no,toolbar=no,scrollbars=yes,status=no');return false;"
														target="_blank" title="Click here for detailed description">
														<img src="image/info.png" alt="info"/>
													</a>
												</div>
												<div class="cartitle">
													<h2><span class="main">%categoryfriendlydescription</span></h2>
													%peoplegraphic
												</div>
											</div>
										</div>
										<div class='unlimited'>%usp</div>
										<div>
											<table style="display:none;" class="details" cellspacing="0">
												<tr>
													<th>Product</th>
													<th>Rental Days</th>
													<th>Daily Rate</th>
													<th>Total</th>
												</tr>
												<tr>
													<td>Days</td>
													<td>%numofdays</td>
													<td>$%avgrate</td>
													<td>$%total</td>
												</tr>
												%totaldiscount_html
												%freedays_html
												%relocfee_html
												%unattendedfee_html
												%afterhourfee_html
												%mandatoryfee_html
												<tr class="total">
													<td>Total Price</td>
													<td></td>
													<td></td>
													<td>$%price_total</td>
												</tr>
											</table>
										</div>
									</div>
									<div class="carAvaliability">
										<div class="carAvaliabilityText">
											%book_html
										</div>
									</div>
								*/ ?>
							</div>
						</div>
					</script>
					<script type="text/html" id="search_content_html">
						<span class="title">Pickup Location:</span> <span class="val">%pickupLocation</span>
						<span class="title">Pickup Date:</span> <span class="val">%pickupDate</span>
						<span class="title">Return Location:</span> <span class="val">%returnLocation</span>
						<span class="title">Return Date:</span> <span class="val">%returnDate</span>
						<?php /* <span class="title">Driver's Age:</span> <span class="val">%DriverAge</span> */ ?>
					</script>
					<script type="text/html" id="totaldiscount_html">
						<span class="feature totaldiscount"><strong>%totaldiscount</strong><?php /* Discounts -$%totaldiscount */ ?></span>
					</script>
					<script type="text/html" id="freedays_html">
						<span class="feature freedays">You qualify for <span>%freedays</span> Free day(s) special</span>
					</script>
					<script type="text/html" id="relocfee_html">
						<span class="feature relocfee">Relocation Fee $%relocfee</span>
					</script>
					<script type="text/html" id="unattendedfee_html">
						<span class="feature unattendedfee">Unattended Return Fee for <span class="location">%location</span> $%unattendedfee</span>
					</script>
					<script type="text/html" id="afterhourfee_html">
						<span class="feature afterhourfee">Afterhour Fee for <span class="location">%location</span> $%afterhourfee</span>
					</script>
					<script type="text/html" id="mandatoryfee_daily_html">
						<?php /* <span class="feature mandatoryfee_daily">%name @ $%per_day Per Day : $%total </span> */ ?>
						<span class="feature mandatoryfee_daily">%altname</span>
					</script>
					<script type="text/html" id="mandatoryfee_percentage_html">
						<?php /* <span class="feature mandatoryfee_percentage">$%fees FOR %name</span> */ ?>
						<span class="feature mandatoryfee_percentage">%name</span>
					</script>
					<script type="text/html" id="mandatoryfee_unknown_html">
						<?php /* <span class="feature mandatoryfee_unknown %type">$%fees FOR %name</span> */ ?>
						<span class="feature mandatoryfee_unknown %type">%name</span>
					</script>
					<script type="text/html" id="need_request_html">
						<span class="need-request"><strong>AVAILABILITY ON REQUEST</strong> - The booking is only confirmed once you receive a confirmation email and the down payment has been charged.</span>
					</script>
					<script type="text/html" id="unavailable_html">
						<?php /* <span class="not-available">VEHICLE NOT AVAILABLE - Please select another one of our amazing campervans or change your dates.</span> */ ?>
					</script>
					<script type="text/html" id="booked_out_html">
						<div class="booked_out btn btn-default btn-sold">BOOKED OUT</div>
					</script>
					<script type="text/html" id="book_now_html">
						<a class="btn btn-default btn-select"
								href="javascript:void(0)"
								onclick="Step2.controller.book_now(
									%vehiclecategoryid,'%categorytype_name','%categorytype_vehicledescriptionurl','%categorytype_imageurl','%available',this
								)">BOOK NOW</a>

					</script>
					<script type="text/html" id="request_now_html">					
						<?php /* <a class="btn btn-default btn-select"
								href="javascript:void(0)"
								onclick="Step2.controller.book_now(
									%vehiclecategoryid,'%categorytype_name','%categorytype_vehicledescriptionurl','%categorytype_imageurl','%available',this
								)">REQUEST BOOKING</a> */ ?>
						<a class="btn btn-default btn-select"
								href="javascript:void(0)"
								onclick="Step2.controller.book_now(
									%vehiclecategoryid,'%categorytype_name','%categorytype_vehicledescriptionurl','%categorytype_imageurl','%available',this
								)">BOOK NOW</a>
						<?php /* <span class="message">%availablemessage</span> */ ?>
					</script>					
				</aside>
			
													
		
				<div class="row">
					
					<div id="result" class="content col-lg-8 col-md-8 col-sm-12 col-xs-12">
						<?php /* 
						<div class="vechicle">
							<div class="row">
								<div class="vehicle-linfo col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="pic">
										<img src="image/car1.png" />
									</div>
									<div class="features">
										<div class="adult"><img src="image/adult.png"> <span class="multi"><i class="fa fa-remove"></i></span> <span class="num">3</span></div>
										<div class="child"><img src="image/child.png"> <span class="multi"><i class="fa fa-remove"></i></span> <span class="num">3</span></div>
										<div class="big-case"><img src="image/big-case.png"> <span class="multi"><i class="fa fa-remove"></i></span> <span class="num">3</span></div>
										<div class="small-case"><img src="image/small-case.png"> <span class="multi"><i class="fa fa-remove"></i></span> <span class="num">3</span></div>
									</div>
									<div class="more">
										<a href="#">Vehicle Information</a>
									</div>
								</div>
								<div class="vehicle-rinfo col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<h3 class="title">Ventura</h3>
									<span class="rental-days">13 Rental Days</span><span class="rate">Daily Rate $89.62</span>
									<span class="feature">Free Extra Drivers (max. 4) @ $0.00 p/day</span>
									<span class="feature">Free sleeping gear @ $0.00 p/day</span>
									<span class="feature">Free cooking equipment and chairs @ $0.00</span>
									<div class="pricing">
										<span class="curr-symbol">$</span><span class="price-num">846</span><span class="small">.00</span><span class="curr-text">USD</span>
											   
						  
							   
		   
										<span class="tax">Excludes sales tax</span>
									</div>
									<a class="btn btn-default btn-select">Select</a>
								</div>
							</div>
						</div>
						<div class="vechicle">
							<div class="row">
								<div class="vehicle-linfo col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="pic">
										<img src="image/car2.png" />
									</div>
									<div class="features">
										<div class="adult"><img src="image/adult.png"> <span class="multi"><i class="fa fa-remove"></i></span> <span class="num">3</span></div>
										<div class="child"><img src="image/child.png"> <span class="multi"><i class="fa fa-remove"></i></span> <span class="num">3</span></div>
										<div class="big-case"><img src="image/big-case.png"> <span class="multi"><i class="fa fa-remove"></i></span> <span class="num">3</span></div>
										<div class="small-case"><img src="image/small-case.png"> <span class="multi"><i class="fa fa-remove"></i></span> <span class="num">3</span></div>								
									</div>
									<div class="more">
										<a href="#">Vehicle Information</a>
																												   
					
									</div>
								</div>
								<div class="vehicle-rinfo col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<h3 class="title">Maverick</h3>
									<span class="rental-days">13 Rental Days</span><span class="rate">Daily Rate $89.62</span>
									<span class="feature">Free Extra Drivers (max. 4) @ $0.00 p/day</span>
									<span class="feature">Free sleeping gear @ $0.00 p/day</span>
									<span class="feature">Free cooking equipment and chairs @ $0.00</span>
									<div class="pricing">
										<span class="curr-symbol">$</span><span class="price-num">846</span><span class="small">.00</span><span class="curr-text">USD</span>
										<span class="tax">Excludes sales tax</span>
									</div>
									<a class="btn btn-default btn-select">Select</a>
								</div>
							</div>
						</div> */ ?>
					</div>
					
					<div id="sidebar" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div id="itinerary" class="widget">
							<div class="widget-head">
								<h3>Your Itinerary</h3>
								<a href="#" class="modify">Modify Search</a>
							</div>
							<div class="widget-content" id="search_content">
								
							</div>
						</div>
																												   
											  
					</div>					
				</div>
			</div>
						  
		</main>
		
		<?php echo Template::footer()?>
		
	</body>
</html>
