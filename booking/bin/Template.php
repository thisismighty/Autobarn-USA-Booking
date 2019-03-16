<?php

class Template
{
	
	public static function header($nav){
		
		ob_start();
		
		?>
		<header>			
			<div class="logo-wrap">
				<div class="container">
					<div class="row">
						<div class="logo col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<a href="/"><img src="image/logo.png" title="Travellers Autobarn Logo" alt="Travellers Autobarn Logo"/></a>
						</div>
						<div class="header-text col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<h2>Campervan Hire</h2>
						</div>
					</div>
				</div>
			</div>
			<div class="nav-wrap">
				<div class="container">
					<nav class="<?php if(isset($_GET['modify'])) echo 'unrounded' ?>">
						<?php echo $nav?>
					</nav>
				</div>
			</div>
		</header>
		
		<?php
		return ob_get_clean();
	}
	
	public static function cart($showDeposit=1, $showButton=1){
		ob_start();
		?>
		<div id="cart" class="widget">
			<div class="widget-head row">
				<div class="col-xs-3">
					<span>Total:</span>
				</div>
				<div class="col-xs-9">
					<?php /* <div class="pricing">
						<?php //echo stripslashes($_SESSION['price_table_html'])?>
					</div> */ ?>
					<?php
					$price=$_SESSION['total_price'];
					$gst=$_SESSION['total_gst'];
					$gst=number_format((float)$gst, 2, '.', '');
					$price_included=$price+$gst;
					$price_included=number_format((float)$price_included, 2, '.', '');
					$price_included_arr=explode('.',$price_included);
					?>
					<div class="pricing">		
						<span class="curr-symbol">$</span><span class="price-num"><?php echo isset($price_included_arr[0])?$price_included_arr[0]:'0'; ?></span><span class="small"><?php echo isset($price_included_arr[1])?'.'.$price_included_arr[1]:'.00'; ?></span><span class="curr-text">USD</span>
						<span class="tax">Incl. Sales Tax <span class="dynamic">$<?php echo $gst; ?></span></span>
					</div>
				</div>
			</div>
			<div class="widget-content">
				<div class="vehicle-img">
					<!-- <img src="<?php echo $_SESSION['CategoryType_imageurl']?>" /> -->
					<?php
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
					}
					
					?>
					<img src="<?php echo $car_image; ?>" /> 
				</div>
				<div class="cart-content">
					<a href="step1.php?modify=1" class="modify">Modify Search</a>
					<div class="section-wrap vehicle">
						<span class="section-title">Vehicle:</span>
						<div class="items row">
							<div class="col-xs-8"><span class="item-name"><?php echo $_SESSION['CategoryType_name'] ?></span></div>
						</div>
					</div>
					<div class="section-wrap daily-rate">
						<span class="item-title">Daily Rate:</span>
						<div class="items row">
						<?php
						$daily_rate = isset($_SESSION['daily_rate_json'])?json_decode($_SESSION['daily_rate_json'], true):array();
						?>
							<div class="col-xs-8"><span class="item-name"><?php echo $daily_rate['numberofdays'] ?> days @ $<?php echo number_format((float)$daily_rate['avgrate'], 2, '.', ''); ?></span></div>
							<div class="col-xs-4"><span class="item-price">$<?php echo number_format((float)$daily_rate['total'], 2, '.', ''); ?></span></div>
						</div>
					</div>
					<?php 
					$discount = isset($_SESSION['discount_json'])?json_decode($_SESSION['discount_json'], true):array();
					?>					
					<div class="section-wrap discount">
						<span class="item-title red"><?php if(!empty($discount[0]['discount'])) echo '**PROMOTIONAL RATE APPLIED**'; ?></span>
					</div>
					<div class="section-wrap mileage">
						<span class="item-title">Mileage:</span>
						<div class="items row">
						<?php
						$km_charges = isset($_SESSION['km_charges_json'])?json_decode($_SESSION['km_charges_json'], true):array();
						
						if(is_array($km_charges)): ?>
							<?php /* <div class="col-xs-8"><span class="item-name"><?php echo $km_charges['desc']; ?></span></div> */ ?>
							<div class="col-xs-8"><span class="item-name"><?php echo $km_charges['name']; ?></span></div>
							<div class="col-xs-4"><span class="item-price"><?php echo $km_charges['price']; ?></span></div>
						<?php endif; ?>
						</div>										
					</div>
					<div class="section-wrap extra-fees">
						<span class="item-title">Extra Fees:</span>
						<?php
						$extra_fees = isset($_SESSION['mandatory_fees_json'])?json_decode(str_replace('\"','"',$_SESSION['mandatory_fees_json']),true):array();
						
						// echo "<pre>"; print_r($extra_fees); echo "</pre>";
						if(is_array($extra_fees)){
							foreach($extra_fees as $extra_fee){
								switch($extra_fee['type']){ 
								case "Daily": ?>
									<div class="items row <?php echo $extra_fee['id'] ?>">
										<div class="col-xs-8"><span class="item-name"><?php echo $extra_fee['name'] ?> @ $<?php echo number_format((float)$extra_fee['fees'], 2, '.', ''); ?> Per Day</span></div>
										<div class="col-xs-4"><span class="item-price">$<?php echo number_format((float)$extra_fee['total'], 2, '.', ''); ?></span></div>
									</div>
									<?php 
									break;
								default: ?>
									<div class="items row <?php echo $extra_fee['id'] ?>">
										<div class="col-xs-8"><span class="item-name"><?php echo $extra_fee['name'] ?></span></div>
										<div class="col-xs-4"><span class="item-price">$<?php echo number_format((float)$extra_fee['total'], 2, '.', ''); ?></span></div>
									</div>
									<?php
									break; 
								}
							}
						}
						?>			
					</div>
					<div class="section-wrap insurance">
						<span class="item-title">Insurance:</span>
						<div class="items row">
							<?php
							$insurance = isset($_SESSION['insurance_json_2'])?json_decode($_SESSION['insurance_json_2'], true):array();
							if(is_array($insurance)): ?>
							<div class="col-xs-8"><span class="item-name"><?php echo $insurance['name'] ?></span></div>
							<?php /* <div class="col-xs-4"><span class="item-price">$<?php echo number_format((float)$insurance['total'], 2, '.', ''); ?></span></div> */ ?>
							<div class="col-xs-4"><span class="item-price"><?php echo $insurance['total']; ?></span></div>
							<?php endif; ?>
						</div>										
					</div> 
					<div class="section-wrap extras">
						<span class="item-title">Extras:</span>
						<?php
						$optional_extras = isset($_SESSION['optional_extras_json'])?json_decode($_SESSION['optional_extras_json'], true):array();
						if(is_array($optional_extras)){
							foreach($optional_extras as $extra){
								?>
								<div class="items row <?php echo $extra['id'] ?>">
									<div class="col-xs-8"><span class="item-name"><?php echo $extra['name'] ?></span></div>
									<div class="col-xs-4"><span class="item-price">$<?php echo number_format((float)$extra['total'], 2, '.', ''); ?></span></div>
								</div>							
								<?php
							}
						}
						?>										
					</div>
					<div class="section-wrap tax">
						<span class="item-title">Sales Tax:</span>
						<div class="items row">
							<div class="col-xs-8"><span class="item-name">$<?php echo $_SESSION['total_gst']; ?></span></div>
							<div class="col-xs-4"><span class="item-price">$<?php echo $_SESSION['total_gst']; ?></span></div>
						</div>										
					</div>
				</div>
			</div>
			<?php if($showDeposit): ?>
			<div class="deposit">
				<span class="deposit-title">Down Payment Payable Now</span>
				<div class="pricing">
					<?php
					$deposit=$_SESSION['total_deposit'];
					$deposit_arr=explode('.',$deposit);
					?>
					<span class="curr-symbol">$</span><span class="price-num"><?php echo isset($deposit_arr[0])?$deposit_arr[0]:0; ?></span><span class="small"><?php echo isset($deposit_arr[1])?'.'.$deposit_arr[1]:'.00'; ?></span><span class="curr-text">USD</span>
				</div>
			</div>
			<?php endif; ?>
			<?php if($showButton): ?>
			<div class="book">
				<?php
					// $book_text=$_SESSION['car_availability']==2?'REQUEST BOOKING':'BOOK NOW';
					$book_text='BOOK NOW';
				?>
				<a class="btn btn-default book" href="#" id="make_a_booking" onclick="Step3.controller.make_a_booking(); return false;"><?php echo $book_text ?></a>
				<a class="btn btn-default btn-grey" href="#" id="email_a_quote" onclick="Step3.controller.email_a_quote(); return false;">Email a quote</a>
			</div>
			<?php endif; ?>
		</div>
		<?php
		return ob_get_clean();
	}
	
	public static function itinerary(){
		ob_start();
		?>
		<div id="itinerary" class="widget">
			<div class="widget-head">
				<h3>Your Itinerary</h3>
				<a href="step1.php?modify=1" class="modify">Modify Search</a>
			</div>
			<div class="widget-content">
				<span class="title">Pickup Location:</span> <span class="val"><?php echo $_SESSION['PickupLocation_name']?></span>
				<?php /* <span class="title">Pickup Date & Time:</span> <span class="val"><?php echo $_SESSION['PickupDate_formatted']?> - <?php echo $_SESSION['PickupTime']?></span> */ ?>
				<span class="title">Pickup Date:</span> <span class="val"><?php echo $_SESSION['PickupDate_formatted']?></span>
				<span class="title">Return Location:</span> <span class="val"><?php echo $_SESSION['DropOffLocation_name']?> </span>
				<?php /* <span class="title">Return Date & Time:</span> <span class="val"><?php echo $_SESSION['ReturnDate_formatted']?> - <?php echo $_SESSION['ReturnTime']?></span> */ ?>
				<span class="title">Return Date:</span> <span class="val"><?php echo $_SESSION['ReturnDate_formatted']?></span>
				<?php /* <span class="title">Driver's Age:</span> <span class="val"><?php echo $_SESSION['DriverAge']?$_SESSION['DriverAge'].' Years':'Not defined'; ?> </span> */ ?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
	
	public static function footer()
	{
		ob_start();
		
		$domain=$_SERVER['SERVER_NAME'];
		// $generate_footer = '//'.$domain . '/generate-footer/';
		if(strpos($domain,'staging')!==false){
			$generate_footer = '//staging.travellers-autobarnrv.com/generate-footer/?token=booking';
		}else{
			$generate_footer = '//travellers-autobarnrv.com/generate-footer/?token=booking';
		}
		
		?>
		<footer>
			<style>/* International Sites */
				.international { position: relative; overflow: hidden;  }
				.international h5 {font-family: 'Montserrat Regular' , Arial, Verdana, Helvetica; font-size: 34px; font-weight: bold; margin-bottom: 25px; }
				.international ul li { width: 20%; float: left; padding: 0px 3% 0px 0px !important; text-align: center; font-weight: bold !important; font-style: normal; -webkit-font-smoothing: antialiased; text-transform: uppercase; font-size: 11px;}
				.international ul li a { color: #fff; }
				.international ul li a:hover { color: #d64600; text-decoration: none; }
				.international ul li img { border: 1px solid #fff; margin-bottom: 5px; }
				.international ul li .coming-soon { position: absolute; left: 0; background-color: rgba(255, 255, 255, 0.6);}

				.international ul li.blog { padding: 0; }
				.international ul li .blog-box { position: relative; overflow: hidden; background: #f89828; }
				.international ul li .blog-box .text { float: right; text-align: right; color: #fff;  }
				.international ul li .blog-box .text a { color: #fff; }
				.international ul li .blog-box .text a:hover { color: #e76f14; }
				.international ul li .blog-box .icon-chat { float: left; text-align: left; color: #e76f14; }
				
				.footer-menus{
					display:inline; 
					width:50%; 
					float:left;
					padding-right:20px;
					padding-top:20px;
				}
				
				.social.mobile{
					margin:auto; 
					width:360px;
				}
				
				.coming-soon{
					color:#000; 
					font-size:11px; 
					top:28%; 
					width:84% !important;
				}
				
				.footer .contact{
					margin-top:5px;
					border-radius:15px;
				}
				
				.footer .contact .btn{
					padding:7px !important;
					width:100%;
				}
				
				.footer .contact .social{
					text-align: center;
				}
				.footer .contact ul {
					padding:13px 20px;
				}
				
				
				.footer .contact .social li{
					width:33%!important;
				}
				
				.youtube-icon{
					background-image:url('https://travellers-autobarnrv.com/wp-content/themes/travellers-autobarn/assets/images/icons/youtube.png');
				}
				.instagram-icon{
					background-image:url('https://travellers-autobarnrv.com/wp-content/themes/travellers-autobarn/assets/images/icons/instagram.png');
				}
				
				
				
				@media (max-width: 1199px) {
					.footer-menus{
						width:50%;
					}
					
					.contact .btn.btn-default{
						padding:5px 10px;
					}
					
					
				}
			</style>
			<div class="section footer visible-xs hamburger-social dark">
				<a href="http://www.facebook.com/pages/Travellers-Auto-Barn/33791102601" target="_blank" rel="nofollow">
					<img style="width:56px;" src="/wp-content/themes/travellers-autobarn/assets/images/icons/facebook.png">
				</a> 
				<a href="http://twitter.com/AutoBarn" target="_blank" rel="nofollow">
					<img style="width:56px;" src="/wp-content/themes/travellers-autobarn/assets/images/icons/twitter.png">
				</a> 
				<a href="" target="_blank" rel="nofollow">
					<img src="/wp-content/themes/travellers-autobarn/assets/images/icons/youtube.png">
				</a> 
				<a href="https://instagram.com/travellersautobarn/" target="_blank" rel="nofollow">
					<img src="/wp-content/themes/travellers-autobarn/assets/images/icons/instagram.png">
				</a>
			</div>
			<div class="section footer hidden-xs">
				<ul class="social mobile mobile-flags hidden-lg hidden-md hidden-sm visible-xs"></ul>
				<?php /*
				<ul class="social mobile hidden-lg hidden-md hidden-sm visible-xs">
					<li>
						<a href="http://www.facebook.com/pages/Travellers-Auto-Barn/33791102601" target="_blank" rel="nofollow"> <i class="icon-facebook"></i> 
						</a>
					</li>
					<li>
						<a href="http://twitter.com/AutoBarn" target="_blank" rel="nofollow"> <i class="icon-twitter"></i> 
						</a>
					</li>
					<li>
						<a href="https://plus.google.com/113816047557033790517" target="_blank" rel="nofollow"> <i class="icon-googleplus"></i> 
						</a>
					</li>
					<li>
						<a href="" target="_blank" rel="nofollow">
							<img src="https://travellers-autobarnrv.com/wp-content/themes/travellers-autobarn/assets/images/icons/youtube.png" style="padding: 0 15px 0 7px;">
						</a>
					</li>
					<li>
						<a href="https://instagram.com/travellersautobarn/" target="_blank" rel="nofollow">
							<img src="https://travellers-autobarnrv.com/wp-content/themes/travellers-autobarn/assets/images/icons/instagram.png">
						</a>
					</li>
				</ul>
				*/ ?>
				<div class="container bg-black hidden-xs">
					<div class="row">
						<div class="col-lg-7 col-md-7 col-sm-12 hidden-xs">
							<div class="footer-menus">
								<div class="heading"><a href="#">Our Campervans</a>
								</div>
								<ul>
									<li><a href="/campervan-rv-rentals/">Campervan Rentals</a>
									</li>
									<li><a href="/campervan-rv-rentals/hitop-campervan/">Hitop Campervan</a>
									</li>
									<li><a href="/campervan-rv-rentals/kuga-campervan/">Kuga Campervan</a>
									</li>
								</ul>
							</div>
							<div class="footer-menus second-last">
								<div class="heading"><a href="#">Travellers Autobarn</a>
								</div>
								<ul>
									<li><a href="/contact-us/">Contact Us</a>
									</li>
									<li><a href="/quick-quote/">Quick Quote</a>
									</li>
									<li><a href="/our-customer-feedback/">Customer Feedback</a>
									</li>
									<li><a href="/cheap-campervan-rental/">Why Travellers Autobarn?</a>
									</li>
									<li><a href="/about-us/">About Us</a>
									</li>
									<li><a href="/campervan-rv-rentals/terms-and-conditions/">Terms &amp; Conditions</a>
									</li>
									<li><a href="/campervan-rv-rentals/privacy-policy/">Privacy Policy</a>
									</li>
									<li><a href="/campervan-rv-rentals/terms-of-use/">Terms of Use</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-5 col-md-5 col-sm-12 links">
							<div class="contact row">
								<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
									<div class="heading"> <a href="/contact-us/">Contact Us</a>
									</div>
									<ul class="social">
										<li>
											<a href="http://www.facebook.com/pages/Travellers-Auto-Barn/33791102601" target="_blank" rel="nofollow">
												<img style="width:45px;" src="/wp-content/themes/travellers-autobarn/assets/images/icons/facebook.png">
											</a>
										</li>
										<li>
											<a href="http://twitter.com/AutoBarn" target="_blank" rel="nofollow">
												<img style="width:45px;" src="/wp-content/themes/travellers-autobarn/assets/images/icons/twitter.png">
											</a>
										</li>
										<li>
											<a href="https://instagram.com/travellersautobarn/" target="_blank" rel="nofollow">
												<img style="width:45px;" src="/wp-content/themes/travellers-autobarn/assets/images/icons/instagram.png">
											</a>
										</li>
									</ul><a href="/campervan-road-trip-itineraries/" rel="nofollow" target="_blank" class="btn btn-default"> Road Trips						</a>
								</div>
							</div>
						</div>
					</div>
					<div class="row terms">
						<div class="col-lg-12 col-md-12 col-sm-12 text-center">Copyright 2018 Travellers Autobarn. All rights reserved | <a href="/sitemap/">Sitemap </a> | <a href="/privacy-policy/" rel="nofollow">Privacy Policy</a> | <a href="/terms-of-use/" rel="nofollow">Terms of use</a>
						</div>
					</div>
				</div>
			</div>
		<?php /*
			<iframe src="<?php echo $generate_footer; ?>" frameborder="0" scrolling="no" height="100%" width="100%" onload="resizeIframe(this)"></iframe>
			<script>
			  function resizeIframe(obj) {
				obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
			  }
			</script>
		*/ ?>
		</footer>
		<?php
		return ob_get_clean();
	}
	
	public static function searchFrom(){
		
		ob_start();
		?>
		<script>
			$(function(){
				/* $("#PickupDate").datepicker({dateFormat:'dd/mm/yy',changeYear:true}); */
				/* $("#ReturnDate").datepicker({dateFormat:'dd/mm/yy',changeYear:true}); */
				
				if($(window).width() < 768){
					var j = 1;
				}else{
					var j = 3;
				}
				
				var dateToday = new Date(); 
				$("input[name=PickupDateAlt]").datepicker({
					numberOfMonths: j,
					inline: true,
					minDate: dateToday,
					dateFormat: "M d yy",
					// dateFormat: "dd/mm/yy",
					// dateFormat: "yy-mm-dd",
					onSelect: function(selected, obj) {
						var selectedDate = new Date(obj.selectedYear, obj.selectedMonth, obj.selectedDay);//Date one month after selected date
						var formattedDate = $.datepicker.formatDate('dd/mm/yy', selectedDate);
						$("input[name=ReturnDateAlt]").datepicker("option","minDate", selected);
						$("input[name=PickupDate]").val(formattedDate);
					}
				});
				$("input[name=ReturnDateAlt]").datepicker({ 
					numberOfMonths: j,
					inline: true,
					minDate: dateToday,
					dateFormat: "M d yy",
					// dateFormat: "dd/mm/yy",
					// dateFormat: "yy-mm-dd",
					onSelect: function(selected, obj) {
						var selectedDate = new Date(obj.selectedYear, obj.selectedMonth, obj.selectedDay);//Date one month after selected date
						var formattedDate = $.datepicker.formatDate('dd/mm/yy', selectedDate);
					    $("input[name=PickupDateAlt]").datepicker("option","maxDate", selected);
					    $("input[name=ReturnDate]").val(formattedDate);
					}
				});
			});
			$(function(){
				$('a.modify').on('click', function(){
					$('.nav-wrap nav').addClass('unrounded', function(){
						$('#search-form').slideDown(400, function(){
							$("html, body").animate({ scrollTop: $('#search-form').offset().top }, 1000);							
						});					
					});
					// $('#search-form-margin').hide();
					return false;
				});
				$('#search-form .close').on('click', function(){
					$('#search-form').slideUp(400,function() {					   
						$('.nav-wrap nav').removeClass('unrounded');
					});
					// $('#search-form-margin').show();
				});
				
			});

		</script>
		<form id="search-form" class="<?php if(isset($_GET['modify'])) echo 'load-show' ?>" method="post" action="step2.php" style="<?php if(!isset($_GET['modify'])) echo 'display:none;' ?>">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h2>Modify Your Search
					<a class="close">Close <i class="fa fa-remove"></i></a>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 nopaddingtop nopaddingbottom">
					
					
					
				</div>
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopaddingtop nopaddingbottom">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group row">
								<label for="PickupLocationID" class="col-sm-4 col-form-label">Pick up location*</label>

								<div class="col-sm-8">
									<select name="PickupLocationID" id="PickupLocationID">
										<option value="<?php echo htmlspecialchars($_SESSION['PickupLocationID'])?>">Loading...</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group row">
								<label for="PickupDateAlt" class="col-sm-6 col-form-label">Pick up date*</label>
								<div class="col-sm-6">
									<input type="text" name="PickupDateAlt" id="PickupDateAlt" value="<?php echo htmlspecialchars($_SESSION['PickupDateAlt'])?>" readonly />
									<input type="hidden" name="PickupDate" id="PickupDate" value="<?php echo htmlspecialchars($_SESSION['PickupDate'])?>" readonly />
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group row">
								<label for="DropOffLocationID" class="col-sm-4 col-form-label">Return location*</label>
								<div class="col-sm-8">
									<select name="DropOffLocationID" id="DropOffLocationID">
										<option value="<?php echo htmlspecialchars($_SESSION['DropOffLocationID'])?>">Loading...</option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group row">
								<label for="ReturnDateAlt" class="col-sm-6 col-form-label">Return date*</label>

								<div class="col-sm-6">
									<input type="text" name="ReturnDateAlt" id="ReturnDateAlt" value="<?php echo htmlspecialchars($_SESSION['ReturnDateAlt'])?>" readonly />
									<input type="hidden" name="ReturnDate" id="ReturnDate" value="<?php echo htmlspecialchars($_SESSION['ReturnDate'])?>" readonly />
								</div>
							</div>
						</div>	
						
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">							
							<?php /*
							<div class="form-group row">
								<div class="col-sm-12">
									<select id="ReturnTime" name="ReturnTime">
										<option value="">Time</option>
										<option <?php echo htmlspecialchars($_SESSION['ReturnTime'])=='09:00'?'selected':''; ?> value="09:00">09:00</option>
										<option <?php echo htmlspecialchars($_SESSION['ReturnTime'])=='09:30'?'selected':''; ?> value="09:30">09:30</option>
										<option <?php echo htmlspecialchars($_SESSION['ReturnTime'])=='10:00'?'selected':''; ?> value="10:00">10:00</option>
									</select>
								</div>
							</div>
							*/ ?>
						</div>								
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<?php /*
							<div class="form-group row">
								<div class="col-sm-12">
									<select id="PickupTime" name="PickupTime">
										<option value="">Time</option>
										<option <?php echo htmlspecialchars($_SESSION['PickupTime'])=='13:00'?'selected':''; ?> value="13:00">13:00</option>
										<option <?php echo htmlspecialchars($_SESSION['PickupTime'])=='13:30'?'selected':''; ?> value="13:30">13:30</option>
										<option <?php echo htmlspecialchars($_SESSION['PickupTime'])=='14:00'?'selected':''; ?> value="14:00">14:00</option>
										<option <?php echo htmlspecialchars($_SESSION['PickupTime'])=='14:30'?'selected':''; ?> value="14:30">14:30</option>
										<option <?php echo htmlspecialchars($_SESSION['PickupTime'])=='15:00'?'selected':''; ?> value="15:00">15:00</option>
										<option <?php echo htmlspecialchars($_SESSION['PickupTime'])=='15:30'?'selected':''; ?> value="15:30">15:30</option>
										<option <?php echo htmlspecialchars($_SESSION['PickupTime'])=='16:00'?'selected':''; ?> value="16:00">16:00</option>
									</select>
								</div>
							</div> */ ?>
						</div>								
					</div>
				</div>
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopaddingtop">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group row">
								<label for="DriversLicence" class="col-sm-7 col-form-label">Driver Licence Country of Issue*:</label>
								<div class="col-sm-5">
									<select name="DriversLicence" id="DriversLicence">
										<option value="0">Select</option>
										<option value="1" <?php echo htmlspecialchars($_SESSION['DriversLicence'])=='1'?'selected':''; ?>>USA</option>
										<option value="2" <?php echo htmlspecialchars($_SESSION['DriversLicence'])=='2'?'selected':''; ?>>Canada</option>
										<option value="3" <?php echo htmlspecialchars($_SESSION['DriversLicence'])=='3'?'selected':''; ?>>Mexico</option>
										<option value="4" <?php echo htmlspecialchars($_SESSION['DriversLicence'])=='4'?'selected':''; ?>>Germany</option>
										<option value="5" <?php echo htmlspecialchars($_SESSION['DriversLicence'])=='5'?'selected':''; ?>>France</option>
										<option value="6" <?php echo htmlspecialchars($_SESSION['DriversLicence'])=='6'?'selected':''; ?>>Austria</option>
										<option value="7" <?php echo htmlspecialchars($_SESSION['DriversLicence'])=='7'?'selected':''; ?>>Switzerland</option>
										<option value="8" <?php echo htmlspecialchars($_SESSION['DriversLicence'])=='8'?'selected':''; ?>>Australia</option>
										<option value="9" <?php echo htmlspecialchars($_SESSION['DriversLicence'])=='9'?'selected':''; ?>>New Zealand</option>
										<option value="10" <?php echo htmlspecialchars($_SESSION['DriversLicence'])=='10'?'selected':''; ?>>France</option>
										<option value="11" <?php echo htmlspecialchars($_SESSION['DriversLicence'])=='11'?'selected':''; ?>>UK</option>
										<option value="12" <?php echo htmlspecialchars($_SESSION['DriversLicence'])=='12'?'selected':''; ?>>Netherlands</option>
										<option value="13" <?php echo htmlspecialchars($_SESSION['DriversLicence'])=='13'?'selected':''; ?>>Norway</option>
										<option value="14" <?php echo htmlspecialchars($_SESSION['DriversLicence'])=='14'?'selected':''; ?>>Denmark</option>
										<option value="15" <?php echo htmlspecialchars($_SESSION['DriversLicence'])=='15'?'selected':''; ?>>Other</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group row">
								<label for="PromoCode" class="col-sm-6 col-form-label">Promotional Code:</label>
								<div class="col-sm-6">
									<input type="text" name="PromoCode" id="PromoCode" value="<?php echo $_SESSION['PromoCode'];?>"/>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group row">
								<?php /*
								<label for="DriverAge" class="col-sm-7 col-form-label">Driver's age</label>
								<div class="col-sm-5">
									<select name="DriverAge" id="DriverAge">
										<option value="">Select</option>
										<option value="21" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='21'?'selected':''; ?>>21</option>
										<option value="22" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='22'?'selected':''; ?>>22</option>
										<option value="23" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='23'?'selected':''; ?>>23</option>
										<option value="24" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='24'?'selected':''; ?>>24</option>
										<option value="25" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='25'?'selected':''; ?>>25</option>
										<option value="26" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='26'?'selected':''; ?>>26</option>
										<option value="27" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='27'?'selected':''; ?>>27</option>
										<option value="28" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='28'?'selected':''; ?>>28</option>
										<option value="29" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='29'?'selected':''; ?>>29</option>
										<option value="30" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='30'?'selected':''; ?>>30</option>
										<option value="31" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='31'?'selected':''; ?>>31</option>
										<option value="32" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='32'?'selected':''; ?>>32</option>
										<option value="33" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='33'?'selected':''; ?>>33</option>
										<option value="34" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='34'?'selected':''; ?>>34</option>
										<option value="35" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='35'?'selected':''; ?>>35</option>
										<option value="36" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='36'?'selected':''; ?>>36</option>
										<option value="37" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='37'?'selected':''; ?>>37</option>
										<option value="38" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='38'?'selected':''; ?>>38</option>
										<option value="39" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='39'?'selected':''; ?>>39</option>
										<option value="40" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='40'?'selected':''; ?>>40</option>
										<option value="41" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='41'?'selected':''; ?>>41</option>
										<option value="42" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='42'?'selected':''; ?>>42</option>
										<option value="43" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='43'?'selected':''; ?>>43</option>
										<option value="44" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='44'?'selected':''; ?>>44</option>
										<option value="45" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='45'?'selected':''; ?>>45</option>
										<option value="46" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='46'?'selected':''; ?>>46</option>
										<option value="47" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='47'?'selected':''; ?>>47</option>
										<option value="48" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='48'?'selected':''; ?>>48</option>
										<option value="49" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='49'?'selected':''; ?>>49</option>
										<option value="50" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='50'?'selected':''; ?>>50</option>
										<option value="51" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='51'?'selected':''; ?>>51</option>
										<option value="52" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='52'?'selected':''; ?>>52</option>
										<option value="53" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='53'?'selected':''; ?>>53</option>
										<option value="54" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='54'?'selected':''; ?>>54</option>
										<option value="55" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='55'?'selected':''; ?>>55</option>
										<option value="56" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='56'?'selected':''; ?>>56</option>
										<option value="57" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='57'?'selected':''; ?>>57</option>
										<option value="58" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='58'?'selected':''; ?>>58</option>
										<option value="59" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='59'?'selected':''; ?>>59</option>
										<option value="60" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='60'?'selected':''; ?>>60</option>
										<option value="61" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='61'?'selected':''; ?>>61</option>
										<option value="62" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='62'?'selected':''; ?>>62</option>
										<option value="63" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='63'?'selected':''; ?>>63</option>
										<option value="64" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='64'?'selected':''; ?>>64</option>
										<option value="65" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='65'?'selected':''; ?>>65</option>
										<option value="66" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='66'?'selected':''; ?>>66</option>
										<option value="67" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='67'?'selected':''; ?>>67</option>
										<option value="68" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='68'?'selected':''; ?>>68</option>
										<option value="69" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='69'?'selected':''; ?>>69</option>
										<option value="70" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='70'?'selected':''; ?>>70</option>
										<option value="71" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='71'?'selected':''; ?>>71</option>
										<option value="72" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='72'?'selected':''; ?>>72</option>
										<option value="73" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='73'?'selected':''; ?>>73</option>
										<option value="74" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='74'?'selected':''; ?>>74</option>
										<option value="75" <?php echo htmlspecialchars($_SESSION['DriverAge'])=='75'?'selected':''; ?>>75</option>
										<!-- <option value="21">21 + min</option> -->
										<!-- <option value="21+">21+</option> -->
										<!-- <option value="25+">25+</option> -->
										<!-- <option value="30+">30+</option> -->
										<!-- <option value="25+">35+</option> -->
									</select>
								</div>
								*/ ?>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						</div>
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<div class="row">
								<div class="col-lg-12 col-md-12s col-sm-12 col-xs-12">
									<div id="update-search" class="btn btn-default" onclick="Step2.controller.start_live()">
										<img src="image/preview-full-loading.gif" style="visibility:hidden;" />
										<span class="">UPDATE SEARCH</span>
										<img src="image/preview-full-loading.gif" />
									</div>
									<div id="change-search" class="btn btn-default" onclick="Step2.controller.change_search()" style="display:none;">
										CHANGE SEARCH
									</div>
								</div>
							</div>
						</div>									
					</div>
				</div>
				<input type="hidden" name="PickupTime" value="<?php echo htmlspecialchars($_SESSION['PickupTime']); ?>" id="PickupTime" />
				<input type="hidden" name="ReturnTime" value="<?php echo htmlspecialchars($_SESSION['ReturnTime']); ?>" id="ReturnTime" />
				<input type="hidden" name="Vehiclecategoryid" value=""/>
				<input type="hidden" name="PickupLocation_name" value=""/>
				<input type="hidden" name="DropOffLocation_name" value=""/>
				<input type="hidden" name="CategoryType_name" value=""/>
				<input type="hidden" name="CategoryType_vehicledescriptionurl" value=""/>
				<input type="hidden" name="CategoryType_imageurl" value=""/>
				<input type="hidden" name="price_table_html" value=""/>							
				<input type="hidden" name="car_availability" value=""/>						
				<input type="hidden" name="mandatory_fees_json" value=''/>						
			</div>
		</form>
		<div id="search-form-margin"></div>
		<div id="form-error" style="display:none"></div>
		<?php
		return ob_get_clean();
	}

}
