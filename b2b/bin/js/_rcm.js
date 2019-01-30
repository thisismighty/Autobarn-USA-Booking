var rcmVersion = "3.1";
var rcmMode = "";
var rcmAPIUrl = "https://secure.rentalcarmanager.com.au/";
var rcmTaxInclusive = false;
var rcmTaxRate = 0.1;
var rcmStateTax = 0.0;
var rcmErr = "";
var rcmMsg = "";
var rcmDebug = "";
var rcmAlert = "";
var rcmToken = "";
var rcmSession = "";
var rcmURL = "";
var rcmKey = "";
var rcmURLObjID = "";
var rcmCampaignCode = "";
var rcmNewsLetter = 0;
var rcmReservationRef = "";
var rcmReservationNo = "";
var rcmDateFormat = "d/m/Y";
var rcmPaymentSaved = false;
var rcmTransmission = [{"No Preference": 0, "Auto": 1, "Manual": 2}];
var rcmLocationInfo = [];
var rcmOfficeTimes = [];
var rcmCategoryTypeInfo = [];
var rcmDriverAgesInfo = [];
var rcmLocationFees = [];
var rcmAvailableCarDetails = [];
var rcmAvailableCars = [];
var rcmMandatoryFees = [];
var rcmOptionalFees = [];
var rcmInsuranceOptions = [];
var rcmKmCharges = [];
var rcmUserData = [];
var rcmRentalSource = [];
var rcmCountries = [];
var rcmAreaOfUse = [];
var rcmCustomerData = [{"fnm": "", "lnm": "", "eml": "", "phn": "", "mob": "", "dob": "", "lcn": "", "lci": "", "lce": "", "adr": "", "cty": "", "sta": "", "pcd": "", "cnt": "", "fax": "", "fus": "", "rmk": "", "not": "", "fln": "", "flo": "", "flc": "", "flr": "", "aru": ""}];
var rcmCustomerDataOK = false;
var rcmSelOptionalFees = [];
var rcmSelTransmission = 0;
var rcmSelInsurance = 0;
var rcmSelExtraKms = 0;
var rcmAgentInfo = [];
var rcmBookingInfo = [];
var rcmCustomerInfo = [];
var rcmCompanyInfo = [];
var rcmRateInfo = [];
var rcmExtraFees = [];
var rcmPaymentInfo = [];
var fnCallBack;
var fnCallBackStep1;
var fnCallBackStep2;
var fnCallBackStep3;
var fnCallBackWebItems;
var fnCallBookingDone;
var fnCallPaymentDone;
var fnLocationChange;
var fnCallBackGetUser;
var fnCallBackGetURL;
var fnCallBackBookingInfo;
var fnAlerts;
var rcm_email_pat = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*([,;]\s*\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*)*$/i;
var rcm_hasnonumbers = /[^\d]/;
var rcm_number = /^[0-9]+$/;
var rcm_text = /[^\w\s\-\+!?@.\/\#\(\)\u0080-\u0250]/gi;
var rcm_alphanum_pat = /[^\w\s\-\+,\.\u0080-\u0250]/i;
String.prototype.startsWith = function (prefix) {
	return this.indexOf(prefix) === 0;
};
String.prototype.endsWith = function (suffix) {
	return this.match(suffix + "$") == suffix;
};
String.prototype.chkDateFormat = function () {
	var retval = this;
	if (retval != "" && rcmDateFormat == "m/d/Y") {
		var arr = retval.split("/");
		retval = arr[1] + "/" + arr[0] + "/" + arr[2];
	}
	retval = retval.replace(/\//g, "_");
	return retval;
};
function rcmAPI() {
	this.GetStep1 = _rcm_getStep1;
	this.GetStep2 = _rcm_getStep2;
	this.GetStep3 = _rcm_getStep3;
	this.MakeBooking = _rcm_MakeBooking;
	this.MakePayment = _rcm_MakePayment;
	this.ConfirmPayment = _rcm_ConfirmPayment;
	this.GetUser = _rcm_GetUser;
	this.GetURL = _rcm_GetURL;
	this.GetWebItems = _rcm_GetWebItems;
	this.GetBookingInfo = _rcm_GetBookingInfo;
	this.EditBooking = _rcm_EditBooking;
	this.OnReady = _rcm_OnReady;
	this.OnReadyStep1 = _rcm_OnReadyStep1;
	this.OnReadyStep2 = _rcm_OnReadyStep2;
	this.OnReadyStep3 = _rcm_OnReadyStep3;
	this.OnReadyWebItems = _rcm_OnReadyWebItems;
	this.OnBookingDone = _rcm_OnBookingDone;
	this.OnPaymentDone = _rcm_OnPaymentDone;
	this.OnReadyGetUser = _rcm_OnReadyGetUser;
	this.OnLocationChange = _rcm_OnLocationChange;
	this.OnReadyGetURL = _rcm_OnReadyGetURL;
	this.OnReadyGetBookingInfo = _rcm_OnReadyGetBookingInfo;
	this.OnAlerts = _rcm_OnAlerts;
	this.LoadPickupList = _rcm_LoadPickupList;
	this.LoadDropOffList = _rcm_LoadDropOffList;
	this.LoadLocationsList = _rcm_LoadLocationsList;
	this.LoadAgeList = _rcm_LoadAgeList;
	this.LoadRentalSource = _rcm_LoadRentalSource;
	this.LoadAreaOfUse = _rcm_LoadAreaOfUse;
	this.LoadCategoryType = _rcm_LoadCategoryType;
	this.LoadCountries = _rcm_LoadCountries;
	this.GetNoticePeriod = _rcm_GetNoticePeriod;
	this.CheckLocationAvailable = _rcm_CheckLocationAvailable;
	this.CheckCustomerDataOK = _rcm_CheckCustomerDataOK;
	this.CheckPaymentSaved = _rcm_CheckPaymentSaved;
	this.GetAge = _rcm_GetAge;
	this.GetCountry = _rcm_GetCountry;
	this.GetCategoryType = _rcm_GetCategoryType;
	this.GetAgeID = _rcm_GetAgeID;
	this.TaxInclusive = _rcm_TaxInclusive;
	this.ReservationRef = _rcm_ReservationRef;
	this.ReservationNo = _rcm_ReservationNo;
	this.MinTimePickup = _rcm_MinTimePickup;
	this.MinTimeDropOff = _rcm_MinTimeDropOff;
	this.MaxTimePickup = _rcm_MaxTimePickup;
	this.MaxTimeDropOff = _rcm_MaxTimeDropOff;
	this.MinBookingDay = _rcm_MinBookingDay;
	this.OfficeOpen = _rcm_OfficeOpen;
	this.OfficeClose = _rcm_OfficeClose;
	this.SetMode = _rcm_setMode;
	this.APIUrl = _rcm_APIUrl;
	this.AddToOptionalItems = _rcm_AddToOptionalItems;
	this.ClearOptionalItems = _rcm_ClearOptionalItems;
	this.GetOptionalItems = _rcm_GetOptionalItems;
	this.InitOptionalItems = _rcm_InitOptionalItems;
	this.InitCustomerData = _rcm_InitCustomerData;
	this.SetCustomerData = _rcm_SetCustomerData;
	this.GetCustomerData = _rcm_GetCustomerData;
	this.ClearCustomerData = _rcm_ClearCustomerData;
	this.SetTransmission = _rcm_SetTransmission;
	this.SetInsurance = _rcm_SetInsurance;
	this.SetExtraKms = _rcm_SetExtraKms;
	this.SetNewsletter = _rcm_SetNewsletter;
	this.SetFirstName = _rcm_SetFirstName;
	this.SetLastName = _rcm_SetLastName;
	this.SetEmail = _rcm_SetEmail;
	this.SetPhone = _rcm_SetPhone;
	this.SetMobile = _rcm_SetMobile;
	this.SetDOB = _rcm_SetDOB;
	this.SetLicenseNo = _rcm_SetLicenseNo;
	this.SetLicenseIssuedIn = _rcm_SetLicenseIssuedIn;
	this.SetLicenseExpires = _rcm_SetLicenseExpires;
	this.SetAddress = _rcm_SetAddress;
	this.SetCity = _rcm_SetCity;
	this.SetState = _rcm_SetState;
	this.SetPostcode = _rcm_SetPostcode;
	this.SetCountry = _rcm_SetCountry;
	this.SetFax = _rcm_SetFax;
	this.SetFoundus = _rcm_SetFoundus;
	this.SetRemarks = _rcm_SetRemarks;
	this.SetNoTraveling = _rcm_SetNoTraveling;
	this.SetFlightNo = _rcm_SetFlightNo;
	this.SetFlightNoOut = _rcm_SetFlightNoOut;
	this.SetSetCollectionPoint = _rcm_SetCollectionPoint;
	this.SetReturnPoint = _rcm_SetReturnPoint;
	this.SetAreaOfUse = _rcm_SetAreaOfUse;
	this.SetDateFormat = _rcm_SetDateFormat;
	this.GetFirstName = _rcm_GetFirstName;
	this.GetLastName = _rcm_GetLastName;
	this.GetEmail = _rcm_GetEmail;
	this.GetPhone = _rcm_GetPhone;
	this.GetMobile = _rcm_GetMobile;
	this.GetDOB = _rcm_GetDOB;
	this.GetLicenseNo = _rcm_GetLicenseNo;
	this.GetLicenseIssuedIn = _rcm_GetLicenseIssuedIn;
	this.GetLicenseExpires = _rcm_GetLicenseExpires;
	this.GetAddress = _rcm_GetAddress;
	this.GetCity = _rcm_GetCity;
	this.GetState = _rcm_GetState;
	this.GetPostcode = _rcm_GetPostcode;
	this.GetCountryID = _rcm_GetCountryID;
	this.GetFax = _rcm_GetFax;
	this.GetFoundusID = _rcm_GetFoundusID;
	this.GetRemarks = _rcm_GetRemarks;
	this.GetNoTraveling = _rcm_GetNoTraveling;
	this.GetFlightNo = _rcm_GetFlightNo;
	this.GetFlightNoOut = _rcm_GetFlightNoOut;
	this.GetCollectionPoint = _rcm_GetCollectionPoint;
	this.GetReturnPoint = _rcm_GetReturnPoint;
	this.GetAreaOfUse = _rcm_GetAreaOfUse;
	this.GetDateFormat = _rcm_GetDateFormat;
	this.GetInsurance = _rcm_GetInsurance;
	this.GetExtraKms = _rcm_GetExtraKms;
	this.GetTax = _rcm_GetTax;
	this.GetStateTax = _rcm_GetStateTax;
	this.GetSession = _rcm_GetSession;
	this.DebugInfo = _rcm_DisplDebug;
	this.Msg = _rcm_DisplMsg;
	this.Error = _rcm_DisplError;
	this.Version = _rcm_DisplVersion;
	this.DisplayTable = _rcm_DisplayTable;
	function _rcm_setMode(modeval) {
		rcmMode = modeval;
	}
	function _rcm_DisplDebug() {
		return rcmDebug;
	}
	function _rcm_DisplMsg() {
		return rcmMsg;
	}
	function _rcm_DisplError() {
		return rcmErr;
	}
	function _rcm_DisplVersion() {
		return rcmVersion;
	}
	function _rcm_TaxInclusive() {
		return rcmTaxInclusive;
	}
	function _rcm_APIUrl(pUrl) {
		if (pUrl.endsWith('/'))
			rcmAPIUrl = pUrl;
		else
			rcmAPIUrl = pUrl + '/';
	}
	function _rcm_getStep1() {
		var refURL = "";
		if (rcmKey != "")
			refURL = rcmKey;
		else
			refURL = rcmBase64.encode(window.location.host);
		if (rcmAPIUrl != "" && refURL != "") {
			var chkScript = document.getElementById("rcmStep1Script");
			if (chkScript) {
				chkScript.parentNode.removeChild(chkScript);
			}
			var oHead = document.getElementsByTagName('HEAD').item(0);
			var oScript = document.createElement("script");
			oScript.type = "text/javascript";
			oScript.setAttribute("id", "rcmStep1Script");
			oScript.src = rcmAPIUrl + "api/" + rcmVersion + "/" + refURL + "/step1";
			oHead.appendChild(oScript);
		} else {
			alert("No Host URL Info!");
		}
	}
	function _rcm_getStep2(CatTID, PLocID, PDate, PTime, DLocID, DDate, DTime, Age, CampaignCode, Details, AgentCode, Name, Email, Phone) {
		var Data = '';
		if (CatTID === undefined || CatTID == '')
			CatTID = '-';
		if (PLocID === undefined || PLocID == '')
			PLocID = '-';
		if (PDate === undefined || PDate == '')
			PDate = '-';
		if (PTime === undefined || PTime == '')
			PTime = '-';
		if (DLocID === undefined || DLocID == '')
			DLocID = '-';
		if (DDate === undefined || DDate == '')
			DDate = '-';
		if (DTime === undefined || DTime == '')
			DTime = '-';
		if (Age === undefined || Age == '')
			Age = '-';
		if (Details === undefined || Details == '')
			Details = '0';
		PDate = PDate.chkDateFormat();
		DDate = DDate.chkDateFormat();
		PTime = PTime.replace(/\:/g, "_");
		DTime = DTime.replace(/\:/g, "_");
		if (CampaignCode === undefined) {
			CampaignCode = '-';
		} else {
			CampaignCode = String(CampaignCode);
			CampaignCode = CampaignCode.replace(/\#/g, "");
			CampaignCode = rcmStrOut(CampaignCode, 12);
		}
		if (CampaignCode == '')
			CampaignCode = '-';
		rcmCampaignCode = CampaignCode;
		if (AgentCode === undefined || AgentCode === '') {
			AgentCode = '/-';
		} else {
			AgentCode = '/' + AgentCode;
		}
		if (Name === undefined)
			Name = '';
		if (Email === undefined)
			Email = '';
		if (Phone === undefined)
			Phone = '';
		var refURL = "";
		if (rcmKey != "")
			refURL = rcmKey;
		else
			refURL = rcmBase64.encode(window.location.host);
		if (rcmAPIUrl != "" && refURL != "") {
			if (Name + Email + Phone != '') {
				Data = rcmStrOut(Name, 30) + "|" + rcmStrOut(Email, 50) + "|" + rcmStrOut(Phone, 20) + "|" + new Date().getTime();
				Data = rcmBase64.encode(Data);
				Data = "/?" + Data;
			}
			var uri = rcmAPIUrl + "api/" + rcmVersion + "/" + refURL + "/step2/" + CatTID + "/" + PLocID + "/" + PDate + "/" + PTime + "/" + DLocID + "/" + DDate + "/" + DTime + "/" + Age + "/" + Details + "/" + CampaignCode + AgentCode + Data;
			var oHead = document.getElementsByTagName('HEAD').item(0);
			var chkScript = document.getElementById("rcmStep2Script");
			if (chkScript) {
				chkScript.parentNode.removeChild(chkScript);
			}
			var oScript = document.createElement("script");
			oScript.type = "text/javascript";
			oScript.setAttribute("id", "rcmStep2Script");
			oScript.src = uri;
			oHead.appendChild(oScript);
		} else {
			alert("No Host URL Info!");
		}
	}
	function _rcm_getStep3(CatTID, PLocID, PDate, PTime, DLocID, DDate, DTime, Age, CarSizeID, CampaignCode, Details, AgentCode) {
		PDate = PDate.chkDateFormat();
		DDate = DDate.chkDateFormat();
		PTime = PTime.replace(/\:/g, "_");
		DTime = DTime.replace(/\:/g, "_");
		if (CampaignCode === undefined) {
			CampaignCode = '-';
		} else {
			CampaignCode = String(CampaignCode);
			CampaignCode = CampaignCode.replace(/\#/g, "");
			CampaignCode = rcmStrOut(CampaignCode, 12);
		}
		if (CampaignCode == '')
			CampaignCode = '-';
		rcmCampaignCode = CampaignCode;
		if (Details === undefined)
			Details = '0';
		if (AgentCode === undefined) {
			AgentCode = '';
		} else {
			AgentCode = '/' + AgentCode;
		}
		var refURL = "";
		if (rcmKey != "")
			refURL = rcmKey;
		else
			refURL = rcmBase64.encode(window.location.host);
		if (rcmAPIUrl != "" && refURL != "") {
			var uri = rcmAPIUrl + "api/" + rcmVersion + "/" + refURL + "/step3/" + CatTID + "/" + PLocID + "/" + PDate + "/" + PTime + "/" + DLocID + "/" + DDate + "/" + DTime + "/" + Age + "/" + CarSizeID + "/" + Details + "/" + CampaignCode + AgentCode;
			var oHead = document.getElementsByTagName('HEAD').item(0);
			var chkScript = document.getElementById("rcmStep3Script");
			if (chkScript) {
				chkScript.parentNode.removeChild(chkScript);
			}
			var oScript = document.createElement("script");
			oScript.type = "text/javascript";
			oScript.setAttribute("id", "rcmStep3Script");
			oScript.src = uri;
			oHead.appendChild(oScript);
		} else {
			alert("No Host URL Info!");
		}
	}
	function _rcm_GetWebItems() {
		var refURL = "";
		if (rcmKey != "")
			refURL = rcmKey;
		else
			refURL = rcmBase64.encode(window.location.host);
		if (rcmAPIUrl != "" && refURL != "") {
			var chkScript = document.getElementById("rcmWebItemsScript");
			if (chkScript) {
				chkScript.parentNode.removeChild(chkScript);
			}
			var oHead = document.getElementsByTagName('HEAD').item(0);
			var oScript = document.createElement("script");
			oScript.type = "text/javascript";
			oScript.setAttribute("id", "rcmWebItemsScript");
			oScript.src = rcmAPIUrl + "api/" + rcmVersion + "/" + refURL + "/webitems";
			oHead.appendChild(oScript);
		} else {
			alert("No Host URL Info!");
		}
	}
	function _rcm_MakeBooking(CatTID, PLocID, PDate, PTime, DLocID, DDate, DTime, Age, CarSizeID, BookingType, ReferralID, CampaignCode, AgentCode, AgentName, RefNo, sendEmail, AgentEmail) {
		if (rcmCustomerDataOK == true) {
			PDate = PDate.chkDateFormat();
			DDate = DDate.chkDateFormat();
			PTime = PTime.replace(/\:/g, "_");
			DTime = DTime.replace(/\:/g, "_");
			if (ReferralID === undefined)
				ReferralID = "0";
			if (CampaignCode === undefined) {
				CampaignCode = rcmCampaignCode;
			} else {
				CampaignCode = String(CampaignCode);
				CampaignCode = CampaignCode.replace(/\#/g, "");
				CampaignCode = rcmStrOut(CampaignCode, 12);
			}
			if (CampaignCode == '')
				CampaignCode = '-';
			rcmCampaignCode = CampaignCode;
			if (AgentCode === undefined)
				AgentCode = '';
			if (AgentName === undefined)
				AgentName = '';
			if (RefNo === undefined)
				RefNo = '';
			if (AgentEmail === undefined)
				AgentEmail = '';
			var eMailSend = "";
			if (rcm_number.test(sendEmail))
				eMailSend = "/" + sendEmail;
			var refURL = "";
			if (rcmKey != "")
				refURL = rcmKey;
			else
				refURL = rcmBase64.encode(window.location.host);
			var OptionalData = rcmGetOptStr();
			var CustomerData = JSON.stringify(rcmCustomerData);
			if (rcmAPIUrl != "" && refURL != "") {
				var Data = CustomerData + "|" + OptionalData + "|" + ReferralID + "|" + CampaignCode + "|" + AgentCode + "|" + AgentName + "|" + rcmNewsLetter + "|" + RefNo + "|" + AgentEmail + "|" + new Date().getTime();
				Data = Data.replace(/\[\{/g, "");
				Data = Data.replace(/\}\]/g, "");
				Data = Data.replace(/\},\{/g, ";");
				Data = Data.replace(/"/g, "");
				Data = rcmBase64.encode(Data);
				var uri = rcmAPIUrl + "api/" + rcmVersion + "/" + refURL + "/booking/" + CatTID + "/" + PLocID + "/" + PDate + "/" + PTime + "/" + DLocID + "/" + DDate + "/" + DTime + "/" + Age + "/" + CarSizeID + "/" + BookingType + "/" + rcmSelInsurance + "/" + rcmSelExtraKms + "/" + rcmSelTransmission + eMailSend + "/?" + Data;
				var oHead = document.getElementsByTagName('HEAD').item(0);
				var chkScript = document.getElementById("rcmBookingScript");
				if (chkScript) {
					chkScript.parentNode.removeChild(chkScript);
				}
				var oScript = document.createElement("script");
				oScript.type = "text/javascript";
				oScript.setAttribute("id", "rcmBookingScript");
				oScript.src = uri;
				oHead.appendChild(oScript);
			} else {
				alert("No Host URL Info!");
			}
		} else {
			alert("Invalid Customer Data/characters: \n\nMake sure Customer data past to API is in valid format using only alpha numeric characters!\n" + rcmAlert);
		}
	}
	function _rcm_MakePayment(pRefNo, pData) {
		var refURL = "";
		if (rcmKey != "")
			refURL = rcmKey;
		else
			refURL = rcmBase64.encode(window.location.host);
		if (rcmAPIUrl != "" && refURL != "") {
			var Data = pData + "|" + new Date().getTime();
			Data = rcmBase64.encode(Data);
			var uri = rcmAPIUrl + "api/" + rcmVersion + "/" + refURL + "/payment/" + pRefNo + "/" + Data;
			var oHead = document.getElementsByTagName('HEAD').item(0);
			var chkScript = document.getElementById("rcmPaymentScript");
			if (chkScript) {
				chkScript.parentNode.removeChild(chkScript);
			}
			var oScript = document.createElement("script");
			oScript.type = "text/javascript";
			oScript.setAttribute("id", "rcmPaymentScript");
			oScript.src = uri;
			oHead.appendChild(oScript);
		} else {
			alert("No Host URL Info!");
		}
	}
	function _rcm_ConfirmPayment(pRefNo, pAmount, pSuccess, pPaymentType, pPaymentDate, pTokenSupplierID, pTransactionBillingID, pDpsTxnRef, pCardHolderName, pPaymentSource, pCardNumber, pCardExpiry, pTransType) {
		var refURL = "";
		if (rcmKey != "")
			refURL = rcmKey;
		else
			refURL = rcmBase64.encode(window.location.host);
		if (rcmAPIUrl != "" && refURL != "") {
			if (pTokenSupplierID === undefined)
				pTokenSupplierID = '';
			if (pTransactionBillingID === undefined)
				pTransactionBillingID = '';
			if (pDpsTxnRef === undefined)
				pDpsTxnRef = '';
			if (pCardHolderName === undefined)
				pCardHolderName = '';
			if (pPaymentSource === undefined)
				pPaymentSource = '';
			if (pCardNumber === undefined)
				pCardNumber = '';
			if (pCardExpiry === undefined)
				pCardExpiry = '';
			if (pTransType === undefined)
				pTransType = '';
			var pData = rcmBase64.encode(pAmount + ";" + pSuccess + ";" + pPaymentType + ";" + pPaymentDate + ";" + pTokenSupplierID + ";" + pTransactionBillingID + ";" + pDpsTxnRef + ";" + pCardHolderName + ";" + pPaymentSource + ";" + pCardNumber + ";" + pCardExpiry + ";" + pTransType + "|" + new Date().getTime());
			var uri = rcmAPIUrl + "api/" + rcmVersion + "/" + refURL + "/confirmpayment/" + pRefNo + "/" + pData;
			var oHead = document.getElementsByTagName('HEAD').item(0);
			var chkScript = document.getElementById("rcmPaymentScript");
			if (chkScript) {
				chkScript.parentNode.removeChild(chkScript);
			}
			var oScript = document.createElement("script");
			oScript.type = "text/javascript";
			oScript.setAttribute("id", "rcmPaymentScript");
			oScript.src = uri;
			oHead.appendChild(oScript);
		} else {
			alert("No Host URL Info!");
		}
	}
	function _rcm_GetBookingInfo(pRefNo) {
		var refURL = "";
		if (rcmKey != "")
			refURL = rcmKey;
		else
			refURL = rcmBase64.encode(window.location.host);
		if (rcmAPIUrl != "" && refURL != "") {
			var pData = new Date().getTime();
			var uri = rcmAPIUrl + "api/" + rcmVersion + "/" + refURL + "/bookinginfo/" + pRefNo + "/" + pData;
			var oHead = document.getElementsByTagName('HEAD').item(0);
			var chkScript = document.getElementById("rcmBookingScript");
			if (chkScript) {
				chkScript.parentNode.removeChild(chkScript);
			}
			var oScript = document.createElement("script");
			oScript.type = "text/javascript";
			oScript.setAttribute("id", "rcmBookingScript");
			oScript.src = uri;
			oHead.appendChild(oScript);
		} else {
			alert("No Host URL Info!");
		}
	}
	function _rcm_EditBooking(BookRef, PLocID, BookingType, ReferralID, CampaignCode, AgentCode, AgentName, RefNo, sendEmail) {
		if (rcmCustomerDataOK == true) {
			if (ReferralID === undefined)
				ReferralID = "0";
			if (CampaignCode === undefined) {
				CampaignCode = rcmCampaignCode;
			} else {
				CampaignCode = String(CampaignCode);
				CampaignCode = CampaignCode.replace(/\#/g, "");
				CampaignCode = rcmStrOut(CampaignCode, 12);
			}
			if (CampaignCode == '')
				CampaignCode = '-';
			rcmCampaignCode = CampaignCode;
			if (AgentCode === undefined)
				AgentCode = '';
			if (AgentName === undefined)
				AgentName = '';
			if (RefNo === undefined)
				RefNo = '';
			var eMailSend = "";
			if (rcm_number.test(sendEmail))
				eMailSend = sendEmail;
			else
				eMailSend = "-";
			var refURL = "";
			if (rcmKey != "")
				refURL = rcmKey;
			else
				refURL = rcmBase64.encode(window.location.host);
			var OptionalData = rcmGetOptStr();
			var CustomerData = JSON.stringify(rcmCustomerData);
			if (rcmAPIUrl != "" && refURL != "") {
				var Data = CustomerData + "|" + OptionalData + "|" + ReferralID + "|" + CampaignCode + "|" + AgentCode + "|" + AgentName + "|" + rcmNewsLetter + "|" + RefNo + "|" + new Date().getTime();
				Data = Data.replace(/\[\{/g, "");
				Data = Data.replace(/\}\]/g, "");
				Data = Data.replace(/\},\{/g, ";");
				Data = Data.replace(/"/g, "");
				Data = rcmBase64.encode(Data);
				var uri = rcmAPIUrl + "api/" + rcmVersion + "/" + refURL + "/editbooking/" + BookRef + "/" + PLocID + "/" + BookingType + "/" + rcmSelInsurance + "/" + rcmSelExtraKms + "/" + rcmSelTransmission + "/" + eMailSend + "/?" + Data;
				var oHead = document.getElementsByTagName('HEAD').item(0);
				var chkScript = document.getElementById("rcmBookingScript");
				if (chkScript) {
					chkScript.parentNode.removeChild(chkScript);
				}
				var oScript = document.createElement("script");
				oScript.type = "text/javascript";
				oScript.setAttribute("id", "rcmBookingScript");
				oScript.src = uri;
				oHead.appendChild(oScript);
			} else {
				alert("No Host URL Info!");
			}
		} else {
			alert("Invalid Customer Data/characters: \n\nMake sure Customer data past to API is in valid format using only alpha numeric characters!\n" + rcmAlert);
		}
	}
	function _rcm_AddToOptionalItems(id, qty) {
		rcmSelOptionalFees.push({"id": id, "qty": qty});
	}
	function _rcm_ClearOptionalItems() {
		rcmSelOptionalFees = [];
	}
	function _rcm_GetOptionalItems() {
		return JSON.stringify(rcmSelOptionalFees);
	}
	function _rcm_InitOptionalItems(value) {
		if (rcmIsJsonString(value) == true)
			rcmSelOptionalFees = JSON.parse(value);
	}
	function _rcm_InitCustomerData(value) {
		if (rcmIsJsonString(value) == true)
			rcmCustomerData = JSON.parse(value);
	}
	function _rcm_SetCustomerData(fname, lname, email, phone, mobile, dob, licno, licis, licex, address, city, state, postcode, country, fax, foundus, remarks, notraveling, flight, flightout, colpoint, retpoint, areause) {
		rcmCustomerDataOK = _rcm_ValidateCustomerData(fname, lname, email, phone, mobile, dob, licno, licis, licex, address, city, state, postcode, country, fax, foundus, remarks, notraveling, flight, flightout, colpoint, retpoint, areause);
		if (rcmCustomerDataOK == true) {
			rcmCustomerData = [];
			rcmCustomerData.push({"fnm": rcmStrOut(fname), "lnm": rcmStrOut(lname), "eml": rcmStrOut(email), "phn": rcmStrOut(phone), "mob": rcmStrOut(mobile), "dob": rcmStrOut(dob), "lcn": rcmStrOut(licno), "lci": rcmStrOut(licis), "lce": rcmStrOut(licex), "adr": rcmStrOut(address), "cty": rcmStrOut(city), "sta": rcmStrOut(state), "pcd": rcmStrOut(postcode), "cnt": rcmStrOut(country), "fax": rcmStrOut(fax), "fus": rcmStrOut(foundus), "rmk": rcmStrOut(remarks), "not": rcmStrOut(notraveling), "fln": rcmStrOut(flight), "flo": rcmStrOut(flightout), "flc": rcmStrOut(colpoint), "flr": rcmStrOut(retpoint), "aru": rcmStrOut(areause)});
		}
	}
	function _rcm_ValidateCustomerData(fname, lname, email, phone, mobile, dob, licno, licis, licex, address, city, state, postcode, country, fax, foundus, remarks, notraveling, flight, flightout, colpoint, retpoint, areause) {
		rcmAlert = "";
		if (!fname == "" && rcm_alphanum_pat.test(fname) == true)
			rcmAlert += "\nAPI-SetFirstName: Invalid Characters";
		if (!lname == "" && rcm_alphanum_pat.test(lname) == true)
			rcmAlert += "\nAPI-SetLastName: Invalid Characters";
		if (rcm_email_pat.test(email) == false)
			rcmAlert += "\nAPI-SetEmail: Invalid Email";
		if (!phone == "" && rcm_alphanum_pat.test(phone) == true)
			rcmAlert += "\nAPI-SetPhone: Invalid Phone number";
		if (!mobile == "" && rcm_alphanum_pat.test(mobile) == true)
			rcmAlert += "\nAPI-SetMobile: Invalid Mobile Phone number";
		if (!dob == "" && rcmValidatedate(dob) == false)
			rcmAlert += "\nAPI-SetDob: Invalid Date of Birth";
		if (!licno == "" && rcm_text.test(licno) == true)
			rcmAlert += "\nAPI-SetLicenseNo: Invalid License Value";
		if (!licis == "" && rcm_number.test(licis) == false)
			rcmAlert += "\nAPI-SetLicenseIssuedIn: Invalid Country ID";
		if (!licex == "" && rcmValidatedate(licex) == false)
			rcmAlert += "\nAPI-SetLicenseExpires: Invalid Date format";
		if (!address == "" && rcm_text.test(address) == true)
			rcmAlert += "\nAPI-SetAddress: Invalid Characters";
		if (!city == "" && rcm_alphanum_pat.test(city) == true)
			rcmAlert += "\nAPI-SetCity: Invalid Characters";
		if (!state == "" && rcm_alphanum_pat.test(state) == true)
			rcmAlert += "\nAPI-SetState: Invalid Characters";
		if (!postcode == "" && rcm_alphanum_pat.test(postcode) == true)
			rcmAlert += "\nAPI-SetPostcode: Invalid Postal Code";
		if (!country == "" && rcm_number.test(country) == false)
			rcmAlert += "\nAPI-SetCountry: Invalid ID needs to be a number";
		if (!fax == "" && rcm_alphanum_pat.test(fax) == true)
			rcmAlert += "\nAPI-SetFax: Invalid Fax number";
		if (!foundus == "" && rcm_number.test(foundus) == false)
			rcmAlert += "\nAPI-SetFoundus: Invalid ID needs to be a number";
		if (!remarks == "" && rcm_text.test(remarks) == true)
			rcmAlert += "\nAPI-SetRemarks: Invalid Characters";
		if (!notraveling == "" && rcm_number.test(notraveling) == false)
			rcmAlert += "\nAPI-SetNoTraveling: Invalid value needs to be a number";
		if (!flight == "" && rcm_alphanum_pat.test(flight) == true)
			rcmAlert += "\nAPI-SetFlightNo: Invalid Characters";
		if (!flightout == "" && rcm_alphanum_pat.test(flightout) == true)
			rcmAlert += "\nAPI-SetFlightNoOut: Invalid Characters";
		if (!colpoint == "" && rcm_text.test(colpoint) == true)
			rcmAlert += "\nAPI-SetCollectionPoint: Invalid Characters";
		if (!retpoint == "" && rcm_text.test(retpoint) == true)
			rcmAlert += "\nAPI-SetReturnPoint: Invalid Characters";
		if (!areause == "" && rcm_number.test(areause) == false)
			rcmAlert += "\nAPI-SetAreaOfUse: Invalid ID needs to be a number";
		if (rcmAlert != "" && typeof fnAlerts == "function")
			fnAlerts();
		return(rcmAlert == "" ? true : false);
	}
	function _rcm_ClearCustomerData() {
		rcmCustomerData = [{"fnm": "", "lnm": "", "eml": "", "phn": "", "mob": "", "dob": "", "lcn": "", "lci": "", "lce": "", "adr": "", "cty": "", "sta": "", "pcd": "", "cnt": "", "fax": "", "fus": "", "rmk": "", "not": "", "fln": "", "flo": "", "flc": "", "flr": "", "aru": ""}];
	}
	function _rcm_GetCustomerData() {
		return JSON.stringify(rcmCustomerData);
	}
	function _rcm_SetTransmission(setValue) {
		var tstVal = rcm_number.test(setValue) && setValue != "" || setValue == 0;
		if (tstVal == true) {
			rcmSelTransmission = setValue;
		} else
			alert("API-SetTransmission: Invalid Number ID:" + setValue);
	}
	function _rcm_SetNewsletter(setValue) {
		if (setValue == 0 || setValue == 1) {
			rcmNewsLetter = setValue;
		} else
			alert("API-SetNewsletter: Invalid Value (valid values: 0/1):" + setValue);
	}
	function _rcm_SetInsurance(setValue) {
		var tstVal = rcm_number.test(setValue) && setValue != "" || setValue == 0;
		if (tstVal == true) {
			rcmSelInsurance = setValue;
		} else
			alert("API-SetInsurance: Invalid Number ID:" + setValue);
	}
	function _rcm_SetExtraKms(setValue) {
		var tstVal = rcm_number.test(setValue) && setValue != "" || setValue == 0;
		if (tstVal == true) {
			rcmSelExtraKms = setValue;
		} else
			alert("API-SetExtraKms: Invalid Number ID:" + setValue);
	}
	function _rcm_SetFirstName(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["fnm"] = setValue;
		} else {
			rcmAlert += "\nAPI-SetFirstName: Invalid Characters";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetLastName(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["lnm"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetLastName: Invalid Characters";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetEmail(setValue) {
		var tstVal = rcm_email_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["eml"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetEmail: Invalid Email";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetPhone(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["phn"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetPhone: Invalid Phone number";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetMobile(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["mob"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetMobile: Invalid Mobile Phone number";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetDOB(setValue) {
		var tstVal = rcmValidatedate(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["dob"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetDob: Invalid Date of Birth";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetLicenseNo(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["lcn"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetLicenseNo: Invalid License Value";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetLicenseIssuedIn(setValue) {
		var tstVal = rcm_number.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["lci"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetLicenseIssuedIn: Invalid Country ID";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetLicenseExpires(setValue) {
		var tstVal = rcmValidatedate(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["lce"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetLicenseExpires: Invalid Date format";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetAddress(setValue) {
		var tstVal = !rcm_text.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["adr"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetAddress: Invalid Characters";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetCity(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["cty"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetCity: Invalid Characters";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetState(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["sta"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetState: Invalid Characters";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetPostcode(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["pcd"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetPostcode: Invalid Postal Code";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetCountry(setValue) {
		var tstVal = rcm_number.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["cnt"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetCountry: Invalid ID needs to be a number";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetFax(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["fax"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetFax: Invalid Fax number";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetFoundus(setValue) {
		var tstVal = rcm_number.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["fus"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetFoundus: Invalid ID needs to be a number";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetRemarks(setValue) {
		var tstVal = !rcm_text.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["rmk"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetRemarks: Invalid Characters";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetNoTraveling(setValue) {
		var tstVal = rcm_number.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["not"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetNoTraveling: Invalid value needs to be a number";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetFlightNo(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["fln"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetFlightNo: Invalid Characters";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetFlightNoOut(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["flo"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetFlightNoOut: Invalid Characters";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetCollectionPoint(setValue) {
		var tstVal = !rcm_text.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["flc"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetCollectionPoint: Invalid Characters";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetReturnPoint(setValue) {
		var tstVal = !rcm_text.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["flr"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetReturnPoint: Invalid Characters";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetAreaOfUse(setValue) {
		var tstVal = rcm_number.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["aru"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetAreaOfUse: Invalid ID needs to be a number";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_SetDateFormat(setValue) {
		if (setValue == 'd/m/Y' || setValue == 'm/d/Y') {
			rcmDateFormat = setValue;
		} else {
			rcmAlert = "\nAPI-SetDateFormat: Invalid date format (allowed: d/m/Y or m/d/Y)";
			if (typeof fnAlerts == "function")
				fnAlerts();
		}
	}
	function _rcm_GetFirstName() {
		return rcmCustomerData[0]["fnm"];
	}
	function _rcm_GetLastName() {
		return rcmCustomerData[0]["lnm"];
	}
	function _rcm_GetEmail() {
		return rcmCustomerData[0]["eml"];
	}
	function _rcm_GetPhone() {
		return rcmCustomerData[0]["phn"];
	}
	function _rcm_GetMobile() {
		return rcmCustomerData[0]["mob"];
	}
	function _rcm_GetDOB() {
		return rcmCustomerData[0]["dob"];
	}
	function _rcm_GetLicenseNo() {
		return rcmCustomerData[0]["lcn"];
	}
	function _rcm_GetLicenseIssuedIn() {
		return rcmCustomerData[0]["lci"];
	}
	function _rcm_GetLicenseExpires() {
		return rcmCustomerData[0]["lce"];
	}
	function _rcm_GetAddress() {
		return rcmCustomerData[0]["adr"];
	}
	function _rcm_GetCity() {
		return rcmCustomerData[0]["cty"];
	}
	function _rcm_GetState() {
		return rcmCustomerData[0]["sta"];
	}
	function _rcm_GetPostcode() {
		return rcmCustomerData[0]["pcd"];
	}
	function _rcm_GetCountryID() {
		return rcmCustomerData[0]["cnt"];
	}
	function _rcm_GetFax() {
		return rcmCustomerData[0]["fax"];
	}
	function _rcm_GetFoundusID() {
		return rcmCustomerData[0]["fus"];
	}
	function _rcm_GetRemarks() {
		return rcmCustomerData[0]["rmk"];
	}
	function _rcm_GetNoTraveling() {
		return rcmCustomerData[0]["not"];
	}
	function _rcm_GetFlightNo() {
		return rcmCustomerData[0]["fln"];
	}
	function _rcm_GetFlightNoOut() {
		return rcmCustomerData[0]["flo"];
	}
	function _rcm_GetCollectionPoint() {
		return rcmCustomerData[0]["flc"];
	}
	function _rcm_GetReturnPoint() {
		return rcmCustomerData[0]["flr"];
	}
	function _rcm_GetAreaOfUse() {
		return rcmCustomerData[0]["aru"];
	}
	function _rcm_GetTax() {
		return rcmTaxRate;
	}
	function _rcm_GetStateTax() {
		return rcmStateTax;
	}
	function _rcm_GetSession() {
		return rcmSession;
	}
	function _rcm_GetDateFormat() {
		return rcmDateFormat;
	}
	function _rcm_GetInsurance() {
		return rcmSelInsurance;
	}
	function _rcm_GetExtraKms() {
		return rcmSelExtraKms;
	}
	function _rcm_GetUser(dob, email) {
		var refURL = "";
		if (rcmKey != "")
			refURL = rcmKey;
		else
			refURL = rcmBase64.encode(window.location.host);
		var Data = dob + "|" + email + "|" + new Date().getTime();
		if (rcmAPIUrl != "" && refURL != "") {
			Data = rcmBase64.encode(Data);
			var uri = rcmAPIUrl + "api/" + rcmVersion + "/" + refURL + "/user/" + Data;
			var oHead = document.getElementsByTagName('HEAD').item(0);
			var chkScript = document.getElementById("rcmGetUserScript");
			if (chkScript) {
				chkScript.parentNode.removeChild(chkScript);
			}
			var oScript = document.createElement("script");
			oScript.type = "text/javascript";
			oScript.setAttribute("id", "rcmGetUserScript");
			oScript.src = uri;
			oHead.appendChild(oScript);
		} else {
			alert("No Host URL Info!");
		}
	}
	function _rcm_GetURL(refno, objID) {
		rcmURLObjID = objID;
		var refURL = "";
		if (rcmKey != "")
			refURL = rcmKey;
		else
			refURL = rcmBase64.encode(window.location.host);
		var Data = refno + "|" + new Date().getTime();
		if (rcmAPIUrl != "" && refURL != "") {
			Data = rcmBase64.encode(Data);
			var uri = rcmAPIUrl + "api/" + rcmVersion + "/" + refURL + "/geturl/" + Data;
			var oHead = document.getElementsByTagName('HEAD').item(0);
			var chkScript = document.getElementById("rcmGetURLScript");
			if (chkScript) {
				chkScript.parentNode.removeChild(chkScript);
			}
			var oScript = document.createElement("script");
			oScript.type = "text/javascript";
			oScript.setAttribute("id", "rcmGetURLScript");
			oScript.src = uri;
			oHead.appendChild(oScript);
		} else {
			alert("No Host URL Info!");
		}
	}
	function _rcm_LoadLocationsList(objPickUp, objDropOff, objAge, valPickupID, valDropOffID, IntroPickUp, IntroDropOff) {
		var valAge = "9999";
		var selPickUp = objPickUp.value;
		var selDropOff = objDropOff.value;
		var OldPickUpIndex = objPickUp.selectedIndex;
		var OldDropOffIndex = objDropOff.selectedIndex;
		if (objAge.selectedIndex >= 0 && rcm_number.test(objAge.options[objAge.selectedIndex].text))
			valAge = objAge.options[objAge.selectedIndex].text;
		ClearList(objPickUp);
		ClearList(objDropOff);
		if (IntroPickUp !== undefined && IntroPickUp !== "") {
			objPickUp.options[objPickUp.options.length] = new Option(IntroPickUp, "");
			objPickUp.options[objPickUp.options.length - 1].disabled = true;
		}
		if (IntroDropOff !== undefined && IntroDropOff !== "") {
			objDropOff.options[objDropOff.options.length] = new Option(IntroDropOff, "");
			objDropOff.options[objDropOff.options.length - 1].disabled = true;
		}
		for (i in rcmLocationInfo) {
			if (rcmLocationInfo[i]["pickupavailable"] == "True" && rcmLocationInfo[i]["minimunage"] <= valAge) {
				objPickUp.options[objPickUp.options.length] = new Option(rcmLocationInfo[i]["location"], rcmLocationInfo[i]["id"]);
				if ((!valPickupID && rcmLocationInfo[i]["webdefault"] == "True") || (rcmLocationInfo[i]["id"]) == valPickupID)
					objPickUp.options[objPickUp.options.length - 1].selected = true;
			}
			if (rcmLocationInfo[i]["dropoffavailable"] == "True" && rcmLocationInfo[i]["minimunage"] <= valAge) {
				objDropOff.options[objDropOff.options.length] = new Option(rcmLocationInfo[i]["location"], rcmLocationInfo[i]["id"]);
				if ((!valDropOffID && rcmLocationInfo[i]["webdefault"] == "True") || (rcmLocationInfo[i]["id"]) == valDropOffID)
					objDropOff.options[objDropOff.options.length - 1].selected = true;
			}
		}
		if (rcm_number.test(selPickUp) && OldPickUpIndex >= 0)
			objPickUp.value = selPickUp;
		if (rcm_number.test(selDropOff) && OldDropOffIndex >= 0)
			objDropOff.value = selDropOff;
		if (typeof fnLocationChange == "function" && (OldPickUpIndex >= 0 || OldDropOffIndex >= 0)) {
			fnLocationChange();
		}
	}
	function _rcm_LoadPickupList(obj, valPickupID, IntroItem) {
		var selObj;
		var OldIndex = obj.selectedIndex;
		if (OldIndex >= 0)
			selObj = obj.value;
		ClearList(obj);
		if (IntroItem !== undefined && IntroItem !== "") {
			obj.options[obj.options.length] = new Option(IntroItem, "");
			obj.options[obj.options.length - 1].disabled = true;
		}
		for (i in rcmLocationInfo) {
			if (rcmLocationInfo[i]["pickupavailable"] == "True") {
				obj.options[obj.options.length] = new Option(rcmLocationInfo[i]["location"], rcmLocationInfo[i]["id"]);
				if ((!valPickupID && rcmLocationInfo[i]["webdefault"] == "True") || (rcmLocationInfo[i]["id"]) == valPickupID)
					obj.options[obj.options.length - 1].selected = true;
			}
		}
		if (rcm_number.test(selObj) && OldIndex >= 0)
			obj.value = selObj;
	}
	function _rcm_LoadDropOffList(obj, valDropOffID, IntroItem) {
		var selObj;
		var OldIndex = obj.selectedIndex;
		if (OldIndex >= 0)
			selObj = obj.value;
		ClearList(obj);
		if (IntroItem !== undefined && IntroItem !== "") {
			obj.options[obj.options.length] = new Option(IntroItem, "");
			obj.options[obj.options.length - 1].disabled = true;
		}
		for (i in rcmLocationInfo) {
			if (rcmLocationInfo[i]["dropoffavailable"] == "True") {
				obj.options[obj.options.length] = new Option(rcmLocationInfo[i]["location"], rcmLocationInfo[i]["id"]);
				if ((!valDropOffID && rcmLocationInfo[i]["webdefault"] == "True") || (rcmLocationInfo[i]["id"]) == valDropOffID)
					obj.options[obj.options.length - 1].selected = true;
			}
		}
		if (rcm_number.test(selObj) && OldIndex >= 0)
			obj.value = selObj;
	}
	function _rcm_LoadAgeList(obj, valAge, IntroItem, selDefault) {
		var selObj;
		var bFoundDefault = false;
		var OldIndex = obj.selectedIndex;
		if (OldIndex >= 0)
			selObj = obj.value;
		ClearList(obj);
		if (selDefault === undefined)
			selDefault = true;
		if (IntroItem !== undefined && IntroItem !== "") {
			obj.options[obj.options.length] = new Option(IntroItem, "");
			obj.options[obj.options.length - 1].disabled = true;
		}
		for (i in rcmDriverAgesInfo) {
			obj.options[obj.options.length] = new Option(rcmDriverAgesInfo[i]["driverage"], rcmDriverAgesInfo[i]["id"]);
			if (selDefault == true && rcmDriverAgesInfo[i]["defaultage"] == "True") {
				bFoundDefault = true;
				obj.options[obj.options.length - 1].selected = true;
			}
		}
		if (bFoundDefault == false)
			obj.options[obj.options.length - 1].selected = true;
		if (valAge > 0)
			obj.value = valAge;
		else if (rcm_number.test(selObj) && OldIndex >= 0)
			obj.value = selObj;
	}
	function _rcm_LoadRentalSource(obj, valRentalSource, IntroItem, selDefault) {
		var selObj;
		var OldIndex = obj.selectedIndex;
		if (OldIndex >= 0)
			selObj = obj.value;
		ClearList(obj);
		if (selDefault === undefined)
			selDefault = true;
		if (IntroItem !== undefined && IntroItem !== "") {
			obj.options[obj.options.length] = new Option(IntroItem, "");
			obj.options[obj.options.length - 1].disabled = true;
		}
		for (i in rcmRentalSource) {
			obj.options[obj.options.length] = new Option(rcmRentalSource[i]["rentalsource"], rcmRentalSource[i]["id"]);
			if (selDefault == true && rcmRentalSource[i]["default"] == "True")
				obj.options[obj.options.length - 1].selected = true;
		}
		if (valRentalSource > 0)
			obj.value = valRentalSource;
		else if (rcm_number.test(selObj) && OldIndex >= 0)
			obj.value = selObj;
	}
	function _rcm_LoadAreaOfUse(obj, valAreaOfUse, LocID, IntroItem, selDefault) {
		var selObj;
		var OldIndex = obj.selectedIndex;
		if (OldIndex >= 0)
			selObj = obj.value;
		ClearList(obj);
		if (selDefault === undefined)
			selDefault = true;
		if (IntroItem !== undefined && IntroItem !== "") {
			obj.options[obj.options.length] = new Option(IntroItem, "");
			obj.options[obj.options.length - 1].disabled = true;
		}
		for (i in rcmAreaOfUse) {
			if (rcmAreaOfUse[i]["locationid"] == 0 || rcmAreaOfUse[i]["locationid"] == LocID) {
				obj.options[obj.options.length] = new Option(rcmAreaOfUse[i]["areaofused"], rcmAreaOfUse[i]["id"]);
				if (selDefault == true && rcmAreaOfUse[i]["defaulted"] == "True")
					obj.options[obj.options.length - 1].selected = true;
			}
		}
		if (valAreaOfUse > 0)
			obj.value = valAreaOfUse;
		else if (rcm_number.test(selObj) && OldIndex >= 0)
			obj.value = selObj;
	}
	function _rcm_LoadCountries(obj, valCountries, IntroItem, selDefault) {
		var selObj;
		var OldIndex = obj.selectedIndex;
		if (OldIndex >= 0)
			selObj = obj.value;
		ClearList(obj);
		if (selDefault === undefined)
			selDefault = true;
		if (IntroItem !== undefined && IntroItem !== "") {
			obj.options[obj.options.length] = new Option(IntroItem, "");
			obj.options[obj.options.length - 1].disabled = true;
		}
		for (i in rcmCountries) {
			obj.options[obj.options.length] = new Option(rcmCountries[i]["country"], rcmCountries[i]["id"]);
			if (selDefault == true && rcmCountries[i]["default"] == "True")
				obj.options[obj.options.length - 1].selected = true;
		}
		if (valCountries > 0)
			obj.value = valCountries;
		else if (rcm_number.test(selObj) && OldIndex >= 0)
			obj.value = selObj;
	}
	function _rcm_LoadCategoryType(obj, valObj, IntroItem, selAll, txtAll) {
		var selObj;
		var OldIndex = obj.selectedIndex;
		if (OldIndex >= 0)
			selObj = obj.value;
		if (txtAll === undefined)
			txtAll = "*";
		ClearList(obj);
		if (IntroItem !== undefined && IntroItem !== "") {
			obj.options[obj.options.length] = new Option(IntroItem, "");
			obj.options[obj.options.length - 1].disabled = true;
		}
		if (selAll !== undefined && selAll == true) {
			if (txtAll === undefined || txtAll === "")
				txtAll = "All";
			obj.options[obj.options.length] = new Option(txtAll, "0");
			if (valObj == '0')
				obj.options[obj.options.length - 1].selected = true;
		}
		for (i in rcmCategoryTypeInfo) {
			obj.options[obj.options.length] = new Option(rcmCategoryTypeInfo[i]["categorytype"], rcmCategoryTypeInfo[i]["id"]);
			if (rcmCategoryTypeInfo[i]["id"] == valObj)
				obj.options[obj.options.length - 1].selected = true;
		}
		if (!valObj && rcm_number.test(selObj) && OldIndex >= 0)
			obj.value = selObj;
	}
	function _rcm_DisplayTable(obj, arr) {
		var out = "<table class='tblDisplay'><tr>";
		for (var name in arr[0]) {
			out = out + "<td>" + [name] + "</td>";
		}
		out = out + "</tr>";
		for (var i = 0; i < arr.length; ++i) {
			out = out + "<tr>";
			for (var name in arr[i]) {
				out = out + "<td nowrap>" + arr[i][name] + "</td>";
			}
			out = out + "</tr>";
		}
		out = out + "</table>";
		obj.innerHTML = out;
	}
	function _rcm_GetNoticePeriod(LocID) {
		var retval = 0;
		for (i in rcmLocationInfo) {
			if (rcmLocationInfo[i]["id"] == LocID) {
				retval = parseFloat(rcmLocationInfo[i]["noticerequired"]);
			}
		}
		return retval;
	}
	function _rcm_GetAge(AgeID) {
		var retval = 0;
		for (i in rcmDriverAgesInfo) {
			if (rcmDriverAgesInfo[i]["id"] == AgeID) {
				retval = rcmDriverAgesInfo[i]["driverage"];
			}
		}
		return retval;
	}
	function _rcm_GetAgeID(Age) {
		var retval = 0;
		for (i in rcmDriverAgesInfo) {
			if (rcmDriverAgesInfo[i]["driverage"] === Age) {
				retval = rcmDriverAgesInfo[i]["id"];
			}
		}
		return retval;
	}
	function _rcm_GetCountry(CountryID) {
		var retval = "";
		for (i in rcmCountries) {
			if (rcmCountries[i]["id"] == CountryID) {
				retval = rcmCountries[i]["country"];
			}
		}
		return retval;
	}
	function _rcm_GetCategoryType(CategoryTypeID) {
		var retval = "";
		for (i in rcmCategoryTypeInfo) {
			if (rcmCategoryTypeInfo[i]["id"] == CategoryTypeID) {
				retval = rcmCategoryTypeInfo[i]["categorytype"];
			}
		}
		return retval;
	}
	function _rcm_ReservationRef() {
		return rcmReservationRef;
	}
	function _rcm_ReservationNo() {
		return rcmReservationNo;
	}
	function _rcm_CheckLocationAvailable() {
		var retval = "";
		for (i in rcmLocationFees) {
			if (rcmLocationFees[i]["tstavailable"] == '0') {
				retval = retval + " " + rcmLocationFees[i]["availablemsg"];
			}
		}
		return retval;
	}
	function _rcm_CheckCustomerDataOK() {
		return rcmCustomerDataOK;
	}
	function _rcm_CheckPaymentSaved() {
		return rcmPaymentSaved;
	}
	function _rcm_OfficeOpen(LocID, dw) {
		var retval = "99:99";
		for (i in rcmOfficeTimes) {
			if (rcmOfficeTimes[i]["locid"] == LocID) {
				if (rcmOfficeTimes[i]["wd"] == dw) {
					retval = rcmOfficeTimes[i]["openingtime"];
				}
			}
		}
		if (retval == "99:99") {
			for (i in rcmLocationInfo) {
				if (rcmLocationInfo[i]["dropoffavailable"] == "True" || rcmLocationInfo[i]["pickupavailable"] == "True") {
					if (rcmLocationInfo[i]["id"] == LocID) {
						retval = rcmLocationInfo[i]["officeopeningtime"];
					}
				}
			}
		}
		if (retval == "99:99")
			retval = "00:00";
		return retval;
	}
	function _rcm_OfficeClose(LocID, dw) {
		var retval = "99:99";
		for (i in rcmOfficeTimes) {
			if (rcmOfficeTimes[i]["locid"] == LocID) {
				if (rcmOfficeTimes[i]["wd"] == dw) {
					retval = rcmOfficeTimes[i]["closingtime"];
				}
			}
		}
		if (retval == "99:99") {
			for (i in rcmLocationInfo) {
				if (rcmLocationInfo[i]["dropoffavailable"] == "True" || rcmLocationInfo[i]["pickupavailable"] == "True") {
					if (rcmLocationInfo[i]["id"] == LocID) {
						retval = rcmLocationInfo[i]["officeclosingtime"];
					}
				}
			}
		}
		if (retval == "99:99")
			retval = "24:00";
		return retval;
	}
	function _rcm_MinTimePickup(LocID, dw) {
		var retval = "99:99";
		for (i in rcmOfficeTimes) {
			if (rcmOfficeTimes[i]["locid"] == LocID) {
				if (rcmOfficeTimes[i]["wd"] == dw) {
					retval = rcmOfficeTimes[i]["startpickup"];
				}
			}
		}
		if (retval == "99:99") {
			for (i in rcmLocationInfo) {
				if (rcmLocationInfo[i]["pickupavailable"] == "True") {
					if (rcmLocationInfo[i]["id"] == LocID && rcmLocationInfo[i]["afterhourbooking"] == "False") {
						retval = rcmLocationInfo[i]["officeopeningtime"];
					}
				}
			}
		}
		if (retval == "99:99")
			retval = "00:00";
		return retval;
	}
	function _rcm_MinTimeDropOff(LocID, dw) {
		var retval = "99:99";
		for (i in rcmOfficeTimes) {
			if (rcmOfficeTimes[i]["locid"] == LocID) {
				if (rcmOfficeTimes[i]["wd"] == dw) {
					retval = rcmOfficeTimes[i]["startdropoff"];
				}
			}
		}
		if (retval == "99:99") {
			for (i in rcmLocationInfo) {
				if (rcmLocationInfo[i]["dropoffavailable"] == "True") {
					if (rcmLocationInfo[i]["id"] == LocID && rcmLocationInfo[i]["afterhourbooking"] == "False" && rcmLocationInfo[i]["unattendeddropoffs"] == "False") {
						retval = rcmLocationInfo[i]["officeopeningtime"];
					}
				}
			}
		}
		if (retval == "99:99")
			retval = "00:00";
		return retval;
	}
	function _rcm_MaxTimePickup(LocID, dw) {
		var retval = "99:99";
		for (i in rcmOfficeTimes) {
			if (rcmOfficeTimes[i]["locid"] == LocID) {
				if (rcmOfficeTimes[i]["wd"] == dw) {
					if (rcmOfficeTimes[i]["endpickup"] != "00:00")
						retval = rcmOfficeTimes[i]["endpickup"];
				}
			}
		}
		if (retval == "99:99") {
			for (i in rcmLocationInfo) {
				if (rcmLocationInfo[i]["pickupavailable"] == "True") {
					if (rcmLocationInfo[i]["id"] == LocID && rcmLocationInfo[i]["afterhourbooking"] == "False") {
						if (rcmLocationInfo[i]["officeclosingtime"] != "00:00")
							retval = rcmLocationInfo[i]["officeclosingtime"];
					}
				}
			}
		}
		if (retval == "99:99")
			retval = "24:00";
		return retval;
	}
	function _rcm_MaxTimeDropOff(LocID, dw) {
		var retval = "99:99";
		for (i in rcmOfficeTimes) {
			if (rcmOfficeTimes[i]["locid"] == LocID) {
				if (rcmOfficeTimes[i]["wd"] == dw) {
					if (rcmOfficeTimes[i]["enddropoff"] != "00:00")
						retval = rcmOfficeTimes[i]["enddropoff"];
				}
			}
		}
		if (retval == "99:99") {
			for (i in rcmLocationInfo) {
				if (rcmLocationInfo[i]["dropoffavailable"] == "True") {
					if (rcmLocationInfo[i]["id"] == LocID && rcmLocationInfo[i]["afterhourbooking"] == "False" && rcmLocationInfo[i]["unattendeddropoffs"] == "False") {
						if (rcmLocationInfo[i]["officeclosingtime"] != "00:00")
							retval = rcmLocationInfo[i]["officeclosingtime"];
					}
				}
			}
		}
		if (retval == "99:99")
			retval = "24:00";
		return retval;
	}
	function _rcm_MinBookingDay(LocID) {
		var retval = 0;
		for (i in rcmLocationInfo) {
			if (rcmLocationInfo[i]["id"] == LocID) {
				retval = rcmLocationInfo[i]["minbookingday"];
			}
		}
		return retval;
	}
	function _rcm_OnReady(fnCall) {
		if (typeof fnCall == "function" && fnCallBack == null) {
			fnCallBack = fnCall;
		}
	}
	function _rcm_OnReadyStep1(fnCall) {
		if (typeof fnCall == "function" && fnCallBackStep1 == null) {
			fnCallBackStep1 = fnCall;
		}
	}
	function _rcm_OnReadyStep2(fnCall) {
		if (typeof fnCall == "function" && fnCallBackStep2 == null) {
			fnCallBackStep2 = fnCall;
		}
	}
	function _rcm_OnReadyStep3(fnCall) {
		if (typeof fnCall == "function" && fnCallBackStep3 == null) {
			fnCallBackStep3 = fnCall;
		}
	}
	function _rcm_OnReadyWebItems(fnCall) {
		if (typeof fnCall == "function" && fnCallBackWebItems == null) {
			fnCallBackWebItems = fnCall;
		}
	}
	function _rcm_OnBookingDone(fnCall) {
		if (typeof fnCall == "function" && fnCallBookingDone == null) {
			fnCallBookingDone = fnCall;
		}
	}
	function _rcm_OnPaymentDone(fnCall) {
		if (typeof fnCall == "function" && fnCallPaymentDone == null) {
			fnCallPaymentDone = fnCall;
		}
	}
	function _rcm_OnReadyGetUser(fnCall) {
		if (typeof fnCall == "function" && fnCallBackGetUser == null) {
			fnCallBackGetUser = fnCall;
		}
	}
	function _rcm_OnReadyGetURL(fnCall) {
		if (typeof fnCall == "function" && fnCallBackGetURL == null) {
			fnCallBackGetURL = fnCall;
		}
	}
	function _rcm_OnReadyGetBookingInfo(fnCall) {
		if (typeof fnCall == "function" && fnCallBackBookingInfo == null) {
			fnCallBackBookingInfo = fnCall;
		}
	}
	function _rcm_OnLocationChange(fnCall) {
		if (typeof fnCall == "function" && fnLocationChange == null) {
			fnLocationChange = fnCall;
		}
	}
	function _rcm_OnAlerts(fnCall) {
		if (typeof fnCall == "function" && fnAlerts == null) {
			fnAlerts = fnCall;
		}
	}
	function ClearList(obj) {
		while (obj.options.length > 0) {
			obj.remove(0);
		}
	}}
function rcmStep1Ready(pErr, pMsg, pDbg) {
	rcmErr = pErr;
	rcmMsg = pMsg;
	rcmDebug = pDbg;
	if (typeof fnCallBackStep1 == "function") {
		fnCallBackStep1();
	} else if (typeof fnCallBack == "function") {
		fnCallBack();
	}
}
function rcmStep2Ready(pErr, pMsg, pDbg) {
	rcmErr = pErr;
	rcmMsg = pMsg;
	rcmDebug = pDbg;
	if (typeof fnCallBackStep2 == "function") {
		fnCallBackStep2();
	} else if (typeof fnCallBack == "function") {
		fnCallBack();
	}
}
function rcmStep3Ready(pErr, pMsg, pDbg) {
	rcmErr = pErr;
	rcmMsg = pMsg;
	rcmDebug = pDbg;
	if (typeof fnCallBackStep3 == "function") {
		fnCallBackStep3();
	} else if (typeof fnCallBack == "function") {
		fnCallBack();
	}
}
function rcmWebItemsReady(pErr, pMsg, pDbg) {
	rcmErr = pErr;
	rcmMsg = pMsg;
	rcmDebug = pDbg;
	if (typeof fnCallBackWebItems == "function") {
		fnCallBackWebItems();
	} else if (typeof fnCallBack == "function") {
		fnCallBack();
	}
}
function rcmBookingReady(pErr, pMsg, pDbg) {
	rcmErr = pErr;
	rcmMsg = pMsg;
	rcmDebug = pDbg;
	if (typeof fnCallBookingDone == "function") {
		fnCallBookingDone();
	} else if (typeof fnCallBack == "function") {
		fnCallBack();
	}
}
function rcmPaymentReady(pErr, pMsg, pDbg) {
	rcmErr = pErr;
	rcmMsg = pMsg;
	rcmDebug = pDbg;
	if (typeof fnCallPaymentDone == "function") {
		fnCallPaymentDone();
	} else if (typeof fnCallBack == "function") {
		fnCallBack();
	}
}
function rcmGetUserReady(pErr, pMsg, pDbg) {
	rcmErr = pErr;
	rcmMsg = pMsg;
	rcmDebug = pDbg;
	if (typeof fnCallBackGetUser == "function") {
		fnCallBackGetUser();
	} else if (typeof fnCallBack == "function") {
		fnCallBack();
	}
}
function rcmGetURLReady(pErr, pMsg, pDbg) {
	rcmErr = pErr;
	rcmMsg = pMsg;
	rcmDebug = pDbg;
	var surl = rcmBase64.decode(rcmURL);
	if (document.getElementById(rcmURLObjID)) {
		document.getElementById(rcmURLObjID).src = surl;
	}
	if (typeof fnCallBackGetURL == "function") {
		fnCallBackGetURL();
	} else if (typeof fnCallBack == "function") {
		fnCallBack();
	}
}
function rcmBookingInfoReady(pErr, pMsg, pDbg) {
	rcmErr = pErr;
	rcmMsg = pMsg;
	rcmDebug = pDbg;
	if (typeof fnCallBackBookingInfo == "function") {
		fnCallBackBookingInfo();
	} else if (typeof fnCallBack == "function") {
		fnCallBack();
	}
}
function SetDebugInfo(pErr, pMsg, pDbg) {
	rcmErr = pErr;
	rcmMsg = pMsg;
	rcmDebug = pDbg;
	if (typeof fnCallBack == "function") {
		fnCallBack();
	}
}
var rcmBase64 = {_keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=", encode: function (input) {
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0;
		input = rcmBase64._utf8_encode(input);
		while (i < input.length) {
			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);
			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;
			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)) {
				enc4 = 64;
			}
			output = output + this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) + this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
		}
		return output;
	}, decode: function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;
		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
		while (i < input.length) {
			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));
			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;
			output = output + String.fromCharCode(chr1);
			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}
		}
		output = rcmBase64._utf8_decode(output);
		return output;
	}, _utf8_encode: function (string) {
		string = string.replace(/\r\n/g, "\n");
		var utftext = "";
		for (var n = 0; n < string.length; n++) {
			var c = string.charCodeAt(n);
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if ((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
		}
		return utftext;
	}, _utf8_decode: function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
		while (i < utftext.length) {
			c = utftext.charCodeAt(i);
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if ((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i + 1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i + 1);
				c3 = utftext.charCodeAt(i + 2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
		}
		return string;
	}};
function rcmGetdate(offset) {
	if (!offset)
		offset = 0;
	var dd = new Date();
	if (offset > 0)
		dd.setDate(dd.getDate() + offset);
	var yyyy = dd.getFullYear().toString();
	var mm = (dd.getMonth() + 1).toString();
	var dd = dd.getDate().toString();
	return'' + (dd[1] ? dd : "0" + dd[0]) + '/' + (mm[1] ? mm : "0" + mm[0]) + '/' + yyyy;
}
function rcmGetDW(ds, format) {
	var dd = Date.parseDate(ds, format);
	return dd.getDay() + 1;
}
function rcmStrToDate(ds, format) {
	var dd = Date.parseDate(ds, format);
	return dd;
}
function rcmDayDiff(objname1, objname2, format) {
	var dd1 = rcmStrToDate(document.getElementById(objname1).value, format);
	var dd2 = rcmStrToDate(document.getElementById(objname2).value, format);
	var retval = (dd1 - dd2) / (1000 * 60 * 60 * 24);
	return retval;
}
function rcmIsJsonString(str) {
	try {
		JSON.parse(str);
	} catch (e) {
		return false;
	}
	return true;
}
function rcmStrOut(strval, slen) {
	var retval = strval;
	retval = retval.replace(rcm_text, '');
	if (slen !== undefined) {
		if (rcm_number.test(retval) == true && retval.length > slen) {
			retval = retval.substring(0, slen);
		}
	}
	return retval;
}
function rcmValidatedate(chkdate) {
	var retval = false;
	if (chkdate.length != 10) {
		retval = false;
	} else {
		var parts = chkdate.split('/');
		if (parts.length != 3) {
			parts = chkdate.split('-');
		}
		if (parts.length == 3) {
			var month = Number(parts[1]);
			if (month > 12) {
				retval = false;
			} else {
				var tstDate = new Date(parts[2], (month - 1), parts[0]);
				if (tstDate.toString() == "NaN" || tstDate.toString() == "Invalid Date" || tstDate.toString() == "0") {
					retval = false;
				} else {
					retval = true;
				}
			}
		} else {
			retval = false;
		}
	}
	return retval;
}
function rcmGetOptStr() {
	var retVal = "";
	for (j in rcmSelOptionalFees) {
		if (retVal == "")
			retVal = rcmSelOptionalFees[j]["id"] + ":" + rcmSelOptionalFees[j]["qty"];
		else
			retVal = retVal + "," + rcmSelOptionalFees[j]["id"] + ":" + rcmSelOptionalFees[j]["qty"];
	}
	return retVal;
}