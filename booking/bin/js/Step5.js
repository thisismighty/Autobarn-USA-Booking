var oAPI=new rcmAPI();
var signScript='bin/signedRequest.php';

var Step5={
	data:{},
	controller:{
		ready:function(){
			oAPI.GetURL(Step5.data.ReservationRef,'frmAuric');
		},
		confirmation:function(){
			window.location.href='step5.php';
		}
	}
};
$(document).ready(function(){
	Step5.controller.ready();
});

var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
var eventer = window[eventMethod];
var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

eventer(messageEvent, function (e) {
	var key = e.message ? "message" : "data";
	var data = e[key];
	var split = data.split(',');
	if (split[5] == "ADD") {
		document.getElementById('frmAuric').src = "about:blank";
		oAPI.OnPaymentDone(Step5.controller.confirmation);
		oAPI.MakePayment(
		Step5.data.ReservationRef,
			data
		);
	}
},false);
