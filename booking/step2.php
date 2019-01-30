<?php

require 'bin/required.php';
require 'etc/steps-conf.php';

$DS3=new DataStep3();
$pop_content=eval($DS3->to_eval(dirname(__FILE__) . '../../wp-load.php'));

$CDV=new ControllerDefaultValues();
$_SESSION=$CDV->step3($_SESSION,$_POST);

if(isset($_GET['debug'])){ echo "<pre>"; print_r($_SESSION); echo "</pre>"; }
?><!DOCTYPE>
<html>
	<head>
	<style>.box-wrap input[type=checkbox] {
    opacity: 0;
}
</style>
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
		<?php echo ViewCSS::draw('jquery-ui.css');?>
		<?php echo ViewCSS::draw('step3.css');?>
		<?php echo ViewCSS::draw('style-v7.css');?>
		<?php echo ViewCSS::draw('magnific-popup.css');?>
		<?php echo ViewJS::draw('jquery-2.1.3.min.js');?>
		<?php echo ViewJS::draw('jquery-ui.min.js');?>
		<?php echo ViewJS::draw('bootstrap.min.js');?>
		<?php echo ViewJS::draw('Template.js');?>
		<?php echo ViewJS::draw('Select.js');?>
		<?php echo ViewJS::draw('Date.js');?>
		<?php echo ViewJS::draw('Log.js');?>
		<?php echo ViewJS::draw('View.js');?>
		<?php echo ViewJS::draw('Controller.js');?>
		<script src="<?php echo ControllerSourceSite::api_url_get()?>" type="text/javascript"></script>
		<?php echo ViewJS::draw('Step3.js');?>
		<?php echo ViewJS::draw('Step3Controller.js');?>
		<?php echo ViewJS::draw('Step3View.js');?>
		<?php echo ViewJS::draw('magnific-popup.js');?>
		<script type="text/javascript">
Step3.data=<?php echo json_encode($_SESSION)?>;
Step3.data.popups=<?php echo $pop_content?>;
<?php echo gethostname()=='fulvios-sandbox'?'Log.display=2;':''?>
			$(function(){
				/*$('a.modify').on('click', function(){
					$('#search-form').slideDown(400);
					$("html, body").animate({ scrollTop: $('#search-form').offset().top }, 1000);
					return false;
				});*/
				$('#search-form .close').on('click', function(){
					$('#search-form').slideUp(400);
				});
				// $(document).on('change','input[name=ExtraKmOut]',function(e) {
					// var id=$(this).val();
					// var desc=$(this).parents('.option').find('.option-text').html();
					// var price=$(this).parents('.option').find('.total-price').html();
					// add='<div class="items row"><div class="col-xs-8"><span class="item-name">'+ desc +'</span></div><div class="col-xs-4"><span class="item-price">'+ price +'</span></div></div>';
					// $('#cart .mileage .items').remove();
					// $('#cart .mileage').append(add);
					
					// var save={
						// id:  id,
						// desc:  desc,
						// price: price,
					// };
					
					// $('form input[name=km_charges_json]').val(JSON.stringify(save));
				// });
				// $(document).on('change','input[name=Insurance]',function(e) {
					// var id=$(this).val();
					// var name=$(this).parents('.option').find('.option-text').html();
					// var total=$(this).parents('.option').find('.total-price').html();
					// add='<div class="items row"><div class="col-xs-8"><span class="item-name">'+ name +'</span></div><div class="col-xs-4"><span class="item-price">'+ total +'</span></div></div>';
					// $('#cart .insurance .items').remove();
					// $('#cart .insurance').append(add);
				// });
				$(document).on('click','.btn-wrap a.btn',function(e) {
                    var $this = $(this),
                        cb = $this.parents('.box-wrap').find('input[type="checkbox"]'),
                        qty = $this.parents('.box-wrap').find('input[type="number"]');
					
					var add='';
					
					var id=$(this).attr('extraid');		
					var name=$(this).attr('extraname');		
					var price=$(this).attr('extraprice');		
					var total_price=0;		
						
					if($(this).hasClass('qty')) {
                        $(this).toggleClass('added', qty.val() > 0).html(qty.val() > 0 ? 'Update' : 'Add');

                        cb.prop('checked', qty.val() > 0);
						total_price = price * qty.val();
						// add='<div class="items row '+ id +'"><div class="col-xs-8"><span class="item-name">'+ name +' x '+ qty.val() +'</span></div><div class="col-xs-4"><span class="item-price">$'+ total_price +'</span></div></div>';
						add='<div class="items row '+ id +'"><div class="col-xs-8"><span class="item-name">'+ name +'</span></div><div class="col-xs-4"><span class="item-price">$'+ total_price.toFixed(2) +'</span></div></div>';
						
                    }else
					{
					    cb.prop('checked', ! $this.hasClass('selected'));
                        $this.html($this.hasClass('selected') ? 'Select' : 'Selected').toggleClass('selected');
						
						add='<div class="items row '+ id +'"><div class="col-xs-8"><span class="item-name">'+ name +'</span></div><div class="col-xs-4"><span class="item-price">$'+ price +'</span></div></div>';
					}
					
					if(!$(this).hasClass('qty') && $this.hasClass('selected'))
						$('#cart .extras').append(add);
					else if($(this).hasClass('qty') && qty.val() > 0){
						$('#cart .extras .items.' + id).remove();
						$('#cart .extras').append(add);
					}else{
						$('#cart .extras .items.' + id).remove();
					}
					
					Step3.controller.calculate_totals();
                    e.preventDefault();
					return false;
					});

                    $(document).on('click','.btn-wrap a.remove',function(e) {
                        var p = $(this).parents('.box-wrap'),
                            btn = p.find('a.btn.qty');
						
						var id=$(this).attr('extraid');
						
                        if(btn.length){
                            p.find('input[type="number"]').val(0);
                            p.find('input[type="checkbox"]').prop('checked', false);

                            btn.removeClass('added').html('Add');
							
							$('#cart .extras .items.' + id).remove();
							
                            Step3.controller.calculate_totals();
                        }

                        e.preventDefault();
                        return false;
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
	
	
		<?php echo Template::header(ViewNav::step3())?>
		<main>
			<div class="container">
			<article>	
			<script type="text/html" id="peoplegraphic_one_html">
				<div class="num-ppl">
					<img src="image/%no-people.png" alt="Persons" title="Persons"/>
				</div>
			</script>
			<script type="text/html" id="peoplegraphic_html">
				<div class="num-ppl">
					<img src="image/%numberofchildren-people.png" alt="Persons" title="Persons"/>
					<span>to</span>
					<img src="image/%numberofadults-people.png" alt="Persons" title="Persons"/>
				</div>
			</script>
			<script type="text/html" id="car_title_html">
				<h2><span class="main">%categoryfriendlydescription0</span></h2>
				<h3>%categoryfriendlydescription1</h3>
			</script>
			<script type="text/html" id="numberofdays_header_html">
				<div>Daily Rate</div>
				<table><tbody>%content</tbody></table>
			</script>
			<script type="text/html" id="numberofdays_html">
				<tr>
					<td style="font-size:14px;">%numberofdays days @ $%avgrate per day</td>
					<td>$%total</td>
				</tr>
			</script>
			<script type="text/html" id="extrafees_header_html">
				<div>Extra Fees</div>
				<table><tbody>%content</tbody></table>
			</script>
			<script type="text/html" id="extrafee_item_html">
				<tr>
					<td style="font-size:14px;">%name</td>
					<td style="font-size:14px;">$%fee</td>
				</tr>
			</script>
			<script type="text/html" id="discounts_header_html">
				<div>Discounts</div>
				<table><tbody>%content</tbody></table>
			</script>
			<script type="text/html" id="discounts_item_html">
				<tr>
					<td style="font-size:14px;">%name</td>
					<td style="font-size:14px;">$%discount</td>
				</tr>
			</script>
			<script type="text/html" id="optional_extras_header_html">
				<div class="col-xs-12"><h2>Extras</h2></div>
				%content
			</script>
			<script type="text/html" id="insurance_options_header_html">
			<h2>Insurance</h2>
			%content
			
			</script>
			<script type="text/html" id="km_charges_header_html">
			<h2>MILEAGE PACKAGES</h2>
			%content
					
			</script>
			<script type="text/html" id="option_quantity_daily_html">
				
				<div class="extra col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="box-wrap">
						<div class="image-wrap">
							<input
							type="checkbox"
							name="OptionalExtras%id"
							id="OptionalExtras%id"
							value="%id"
							onchange="Step3.controller.calculate_totals()"
							/><img src="image/extras/%filename">
						</div>
						<div class="info-wrap">
							<h3 class="title">%name</h3>
							<?php /* <a %pop>%name</a> */ ?>
							<span class="price"> @ $%fees per day </span><span id="OptionalExtrasTotal%id">$%total</span>
						</div>
						<div class="btn-wrap row">
							<div class="col-xs-6">
								<a href="#" class="remove" extraid="%id"><i class="fa fa-remove"></i></a><input
								type="number"
								min="0"
								maxlength="2"
								name="qtyOptionalExtras%id"
								id="qtyOptionalExtras%id"
								value=""
								onchange="Step3.controller.calculate_totals()"
								placeholder="qty"
								required />
							</div>
							<div class="col-xs-6">
								<a href="#" class="btn btn-default qty" extraid="%id" extraname="%name" extraprice="%total">Add</a>
							</div>
						</div>					
					</div>
				</div>
			</script>
			<script type="text/html" id="option_quantity_percentage_html">
				<div class="extra col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="box-wrap">
						<div class="image-wrap">
							<input
							type="checkbox"
							name="OptionalExtras%id"
							id="OptionalExtras%id"
							value="%id"

							/><img src="image/extras/%filename">
						</div>
						<div class="info-wrap">
							<h3 class="title">%name</h3>
							<span class="price"><div id="OptionalExtrasTotal%id">$%total</div></span>
						</div>
						<div class="btn-wrap row">
							<div class="col-xs-12">
								<a href="#" class="btn btn-default" extraid="%id" extraname="%name" extraprice="%total">Select</a>
								
							</div>
						</div>
					</div>
				</div>
				
			</script>
			<script type="text/html" id="option_quantity_unknown_html">
				<div class="extra col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="box-wrap">
						<div class="image-wrap">
							<input
							type="checkbox"
							name="OptionalExtras%id"
							id="OptionalExtras%id"
							value="%id"
							
							/><img src="image/extras/%filename">
						</div>
						<div class="info-wrap">
							<h3 class="title">%name</h3>
							<span class="price">Cost <span id="OptionalExtrasTotal%id">$%total</span> USD</span>
						</div>
						<div class="btn-wrap row">
							<div class="col-xs-6">
								<a href="#" class="remove" extraid="%id"><i class="fa fa-remove"></i></a><input
								type="number"
								min="0"
								maxlength="2"
								name="qtyOptionalExtras%id"
								id="qtyOptionalExtras%id"
								value=""

								placeholder="qty"
								required />
							</div>
							<div class="col-xs-6">
								<a href="#" class="btn btn-default qty" extraid="%id" extraname="%name" extraprice="%total">Add</a>
							</div>
						</div>
					</div>
				</div>
								
			</script>
			<script type="text/html" id="option_daily_html">
				<div class="extra col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="box-wrap">
						<div class="image-wrap">
							<input
							type="checkbox"
							name="OptionalExtras%id"
							id="OptionalExtras%id"
							value="%id"
							onchange="Step3.controller.calculate_totals()"
							/><img src="image/extras/%filename">
						</div>
						<div class="info-wrap">
							<h3 class="title">%name</h3>
							<span class="price"> @ $%fees per day </span><span id="OptionalExtrasTotal%id">$%total</span>
						</div>
						<div class="btn-wrap row">
							<div class="col-xs-12">
								<a href="#" class="btn btn-default " extraid="%id" extraname="%name" extraprice="%total">Select</a>
								
							</div>
						</div>
					</div>
				</div>
			</script>
			<script type="text/html" id="option_percentage_html">
				<div class="extra col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="box-wrap">
						<div class="image-wrap">
							<input
							type="checkbox"
							name="OptionalExtras%id"
							id="OptionalExtras%id"
							value="%id"
							onchange="Step3.controller.calculate_totals()"
							/><img src="image/extras/%filename">
						</div>
						<div class="info-wrap">
							<h3 class="title">%name</h3>
							<span id="OptionalExtrasTotal%id" class="price">$%total</span>
						</div>
						<div class="btn-wrap row">
							<div class="col-xs-12">
								<a href="#" class="btn btn-default" extraid="%id" extraname="%name" extraprice="%total">Select</a>
								
							</div>
						</div>
					</div>
				</div>
			</script>
			</script>
			<script type="text/html" id="option_unknown_html">
				<div class="extra col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="box-wrap">
						<div class="image-wrap">
							<input
							type="checkbox"
							name="OptionalExtras%id"
							id="OptionalExtras%id"
							value="%id"

							/><img src="image/extras/%filename">
						</div>
						<div class="info-wrap">
							<h3 class="title">%name</h3>
							<span id="OptionalExtrasTotal%id" class="price">$%total</span>
						</div>
						<div class="btn-wrap row">
							<div class="col-xs-12">
								<a href="#" class="btn btn-default" extraid="%id" extraname="%name" extraprice="%total">Select</a>
								
							</div>
						</div>
					</div>
				</div>
			</script>
                <script type="text/html" id="currency_amount">

                </script>
			<script type="text/html" id="insurance_option_daily_html">
				<div class="option">
					<div class="option-desc">
						<span class="check-wrap">
							<input
								%checked
								type="radio"
								name="Insurance"
								insurance_name="%name"
								id="Insurance%id"
								value="%id"
								onchange="Step3.controller.calculate_totals()"
								/>
						</span>
						<span class="option-text"><a %pop>%desc</a></span>						
						<span class="total-price" id="InsuranceTotal%id">$%total</span>
					</div>
					<ul class="sub-option-desc">
						%subdesc1
						%subdesc2
						%subdesc3
					</ul>
				</div>
			</script>
			<script type="text/html" id="insurance_option_percentage_html">
				<div class="option">
					<div class="option-desc">
						<span class="check-wrap">
							<input
								%checked
								type="radio"
								name="Insurance"
								insurance_name="%name"
								id="Insurance%id"
								value="%id"
								onchange="Step3.controller.calculate_totals()"
								/>
						</span>
						<span class="option-text"><a %pop>%desc</a></span>						
						<span class="total-price" id="InsuranceTotal%id">$%total</span>
					</div>
					<ul class="sub-option-desc">
						%subdesc1
						%subdesc2
						%subdesc3
					</ul>
				</div>
			</script>
			<script type="text/html" id="insurance_option_unknown_html">
				<div class="option">
					<div class="option-desc">
						<span class="check-wrap">
							<input
								%checked
								type="radio"
								name="Insurance"
								insurance_name="%name"
								id="Insurance%id"
								value="%id"
								onchange="Step3.controller.calculate_totals()"
								/>
						</span>
						<span class="option-text"><a %pop>%desc</a></span>						
						<span class="total-price" id="InsuranceTotal%id">$%total</span>
					</div>
					<ul class="sub-option-desc">
						%subdesc1
						%subdesc2
						%subdesc3
					</ul>
				</div>
			</script>
		
			<script type="text/html" id="km_charges_html">
				<div class="option">
					<span class="check-wrap"><input
							%checked
							type="radio"
							name="ExtraKmOut"
							mileage_name="%desc"
							id="ExtraKmOut%id"
							value="%id"
							onchange="Step3.controller.calculate_totals()"
							/>
					</span>
					<span class="option-text"><a %pop>%desc</a></span>
					<span class="total-price" id="ExtraKmOutTotal%id">$%total</span>
				</div>				
			</script>
		
				<div id="lightbox" onclick="Step3.controller.pop_close()">
					<div class="outer">
						<div class="frame">
							<a class="close" href="javascript:void(0)" onclick="Step3.controller.pop_close()">x</a>
							<div class="content"></div>
						</div>
					</div>
				</div>
				
				<div id="popup_booking" class="team-popup white-popup-block mfp-hide">
					<div class="row">
						<div class="col-md-12">
							<div class="content"></div>
						</div>
					</div>
				</div>
				
				<script>
					// $('.hover-underline').magnificPopup({
						// type: 'inline',
						// preloader: false,
						// modal: true,
						// closeOnBgClick: true,
						// enableEscapeKey: true,
					// });
					$(document).on('click', '.popup-modal-dismiss', function (e) {
						e.preventDefault();
						$.magnificPopup.close();
					});
				</script>
				
				<div class="row">
					
					<div id="content" class="content col-lg-8 col-md-8 col-sm-12 col-xs-12">
						
						<div class="inside">
							
							<form method="post" action="step3.php" id="frmStep3">
								<div id="insurance-options" class="section">
									<?php /*
									<h2>Insurance Option</h2>
									<div class="option">
										<span class="check-wrap"><input type="radio" name="Insurance" checked="checked"></span>
										<span class="option-text">1. No camper coverage and only minimum liability coverage <span class="break">@ $0.00 Per Day</span></span>
										<span class="total-price">$0.00</span>
									</div>
									<div class="option">
										<span class="check-wrap"><input type="radio" name="Insurance"></span>
										<span class="option-text">2. SLI - Supplemental Liability Insurance (Third Party Coverage)<span class="break">@ $12.25 Per Day</span></span>
										<span class="total-price">$404.25</span>
									</div>
									<div class="option">
										<span class="check-wrap"><input type="radio" name="Insurance"></span>
										<span class="option-text">3. CDW - Collision Damage Waiver (Campervan Coverage)<span class="break">@ $10.00 Per Day</span></span>
										<span class="total-price">$330.35</span>
									</div>
									<div class="option">
										<span class="check-wrap"><input type="radio" name="Insurance"></span>
										<span class="option-text">4. No Worries Cover - Full Camper (CDW) and Liability (SLI)<span class="break">@ $22.25 Per Day</span></span>
										<span class="total-price">$734.25</span>
									</div> */ ?>
								</div>
								<div id="km_charges_options" class="section">
									<?php /* <h2>Pre-Paid Mileage</h2>
									<div class="option">
										<span class="check-wrap"><input type="radio" name="mileage" checked="checked"></span>
										<span class="option-text">100 Miles/Day, Additional $0.25 per mile</span>
										<span class="total-price">$0.00</span>
									</div>
									<div class="option">
										<span class="check-wrap"><input type="radio" name="mileage"></span>
										<span class="option-text">200 Miles/Day, $15.00 Per Day</span>
										<span class="total-price">$495.25</span>
									</div>
									<div class="option">
										<span class="check-wrap"><input type="radio" name="mileage"></span>
										<span class="option-text">Unlimited miles, $25.00 Per Day</span>
										<span class="total-price">$895.00</span>
									</div> */ ?>
								</div>
								<div id="optional-extras" class="section row">
									<?php /* <h2>Extras</h2>
									<div class="extra col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="box-wrap">
											<div class="image-wrap">
												<img src="image/extras/gps.png">
											</div>
											<div class="info-wrap">
												<h3 class="title">GPS</h3>
												<span class="price">Cost @ $5 USD p/day</span>
											</div>
											<div class="btn-wrap row">
												<div class="col-xs-12">
													<a href="#" class="btn btn-default selected">Selected</a>

												</div>
											</div>
										</div>
									</div>
									<div class="extra col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="box-wrap">
											<div class="image-wrap">
												<img src="image/extras/tent.png">
											</div>
											<div class="info-wrap">
												<h3 class="title">2- Person Tent</h3>
												<span class="price">Cost: $50 USD</span>
											</div>
											<div class="btn-wrap row">
												<div class="col-xs-12">
													<a href="#" class="btn btn-default">Select</a>
												</div>
											</div>
										</div>
									</div>
									<div class="extra col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="box-wrap">
											<div class="image-wrap">
												<img src="image/extras/jack.png">
											</div>
											<div class="info-wrap">
												<h3 class="title">Audio Jack Cable</h3>
												<span class="price">Cost $5 USD</span>
											</div>
											<div class="btn-wrap row">
												<div class="col-xs-12">
													<a href="#" class="btn btn-default">Select</a>
												</div>
											</div>
										</div>
									</div>
									<div class="extra col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="box-wrap">
											<div class="image-wrap">
												<img src="image/extras/bike.png">
											</div>
											<div class="info-wrap">
												<h3 class="title">Bike Rack</h3>
												<span class="price">Cost $50 USD</span>
											</div>
											<div class="btn-wrap row">
												<div class="col-xs-6">
													<i class="fa fa-remove"></i><input type="number" />
												</div>
												<div class="col-xs-6">
													<a href="#" class="btn btn-default">Add</a>
												</div>
											</div>
										</div>
									</div>
									<div class="extra col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="box-wrap">
											<div class="image-wrap">
												<img src="image/extras/table.png">
											</div>
											<div class="info-wrap">
												<h3 class="title">Picnic Table</h3>
												<span class="price">Cost $25 USD</span>
											</div>
											<div class="btn-wrap row">
												<div class="col-xs-12">
													<a href="#" class="btn btn-default">Select</a>
												</div>
											</div>
										</div>
									</div>
									<div class="extra col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="box-wrap">
											<div class="image-wrap">
												<img src="image/extras/seat.png">
											</div>
											<div class="info-wrap">
												<h3 class="title">Child Boster Seat</h3>
												<span class="price">Cost $30 USD</span>
											</div>
											<div class="btn-wrap row">
												<div class="col-xs-6">
													<i class="fa fa-remove"></i><input type="number" />
												</div>
												<div class="col-xs-6">
													<a href="#" class="btn btn-default added">Added</a>
												</div>
											</div>
										</div>
									</div>
									<div class="extra col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="box-wrap">
											<div class="image-wrap">
												<img src="image/extras/chains.png">
											</div>
											<div class="info-wrap">
												<h3 class="title">Snow Chains</h3>
												<span class="price">Cost $50 USD</span>
											</div>
											<div class="btn-wrap row">
												<div class="col-xs-12">
													<a href="#" class="btn btn-default">Select</a>
												</div>
											</div>
										</div>
									</div>
									<div class="extra col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="box-wrap">
											<div class="image-wrap">
												<img src="image/extras/shower.png">
											</div>
											<div class="info-wrap">
												<h3 class="title">Solar Shower</h3>
												<span class="price">Cost $10 USD</span>
											</div>
											<div class="btn-wrap row">
												<div class="col-xs-12">
													<a href="#" class="btn btn-default">Select</a>
												</div>
											</div>
										</div>
									</div>
									<div class="extra col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="box-wrap">
											<div class="image-wrap">
												<img src="image/extras/awning.png">
											</div>
											<div class="info-wrap">
												<h3 class="title">Sunshade Awning</h3>
												<span class="price">Cost $50 USD</span>
											</div>
											<div class="btn-wrap row">
												<div class="col-xs-12">
													<a href="#" class="btn btn-default">Select</a>
												</div>
											</div>
										</div>
									</div>
									<div class="extra col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="box-wrap">
											<div class="image-wrap">
												<img src="image/extras/usb.png">
											</div>
											<div class="info-wrap">
												<h3 class="title">USB Charger</h3>
												<span class="price">Cost $5 USD</span>
											</div>
											<div class="btn-wrap row">
												<div class="col-xs-12">
													<a href="#" class="btn btn-default">Select</a>
												</div>
											</div>
										</div>
									</div> */ ?>
								</div>
								
								<input type="hidden" name="total_price" value=""/>
								<input type="hidden" name="total_deposit" value=""/>
								<input type="hidden" name="total_gst" value=""/>
								<input type="hidden" name="daily_rate_json" value=""/>
								<input type="hidden" name="extra_fees_json" value=""/>
								<input type="hidden" name="discount_json" value=""/>
								<input type="hidden" name="discount" value=""/>
								<input type="hidden" name="insurance_json" value=""/>
								<input type="hidden" name="insurance_json_2" value=""/>
								<input type="hidden" name="km_charges_json" value=""/>
								<input type="hidden" name="price_table_html" value=""/>
								<input type="hidden" name="optional_extras_json" value=""/>
								<input type="hidden" name="bookmode" value=""/>
							</form>
						</div>
					</div>
					
					<div id="sidebar" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						
						<?=Template::itinerary()?>
						
						<?=Template::cart(1,1)?>
						
					</div>					
				</div>
            </article>
			</div> 

		</main>
		
		<?php echo Template::footer()?>
		
	</body>
</html>