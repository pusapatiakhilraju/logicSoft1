<?PHP

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head id="Head1"><title>
	welcome to capslock
</title><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Styles -->
<link href="welcome%20to%20capslock_files/bootstrap.css" rel="stylesheet"><link href="welcome%20to%20capslock_files/copslock1.css" rel="stylesheet">
<script src="welcome%20to%20capslock_files/jquery-latest.js"></script>
<script src="welcome%20to%20capslock_files/bootstrap.js"></script>
<link href="welcome%20to%20capslock_files/css.css" rel="stylesheet" type="text/css"/></head>
<body>
<header>
  
      
 </header>
    <form method="post" action="publishersignup.aspx" onsubmit="javascript:return WebForm_OnSubmit();" id="form1">
<div class="aspNetHidden">
<input name="__EVENTTARGET" id="__EVENTTARGET" value="" type="hidden">
<input name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" type="hidden">
<input name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwULLTEzNjk0Njc3ODlkZIX32cpxvgONgrHM8eK2zbCPHf1PhySDD3HHuzREiPTa" type="hidden">
</div>

<script type="text/javascript">
//<![CDATA[
var theForm = document.forms['form1'];
if (!theForm) {
    theForm = document.form1;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}
//]]>
</script>


<script src="welcome%20to%20capslock_files/WebResource_002.js" type="text/javascript"></script>


<script src="welcome%20to%20capslock_files/WebResource.js" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
function WebForm_OnSubmit() {
if (typeof(ValidatorOnSubmit) == "function" && ValidatorOnSubmit() == false) return false;
return true;
}
//]]>
</script>

<div class="aspNetHidden">
</div>
  
<div class="container-floud  bgcolor-d">
  
  <div class="container bgcolor-w" style="height:20px;"></div>
  <div class="container bgcolor-w">
    <div class="col-md-2"></div>
    <div class="col-md-8">
     <div class="login-top"><h1 class="hderm">CPM Publisher Registration Form </h1></div>
     <div class="reg-form">
     
     <table style=" font-size:13px;" align="center" border="0" cellpadding="0" cellspacing="3" width="70%">
  <tbody><tr>
    <td height="40" width="200">* Site Name</td>
    <td>:</td>
    <td> 
        <input name="txt_sitename" id="txt_sitename" class="form-control form-desid" placeholder="Site Name" style="width:300px;" type="text">
        
      </td>
      <td> <span id="rfvSiteUrl" style="color:Red;display:none;">*</span></td>
      
  </tr>
   <tr>
    <td height="40" width="200">* Site URL</td>
    <td>:</td>
    <td>  <input name="txt_siteurl" id="txt_siteurl" class="form-control form-desid" placeholder="Site URL" type="text"></td>
          <td> <span id="RequiredFieldValidator1" style="color:Red;display:none;">*</span></td>
  </tr>  
   <tr>
    <td height="40" width="200">&nbsp; Site Description</td>
    <td>:</td>
    <td>  <input name="txt_sitedesc" id="txt_sitedesc" class="form-control form-desid" placeholder="Site Description" type="text"></td>
       <td> <span id="RequiredFieldValidator2" style="color:Red;display:none;">*</span></td>
  </tr>
   <tr>
    <td height="40" width="200">* Unique Site Traffic</td>
    <td>:</td>
    <td>
      <select name="ddlUniqueImpressions" id="ddlUniqueImpressions" class="form-control form-desid">
	<option selected="selected" value="0">Unique Site Traffic</option>
	<option value="1">less than 1000</option>
	<option value="2">1000-100000</option>
	<option value="3">100000-1000000</option>
	<option value="4">Above 1 Million</option>

</select>
     </td>
  </tr>
   <tr>
    <td height="40" width="200">* First Name</td>
    <td>:</td>
    <td> 
    <input name="txt_fname" id="txt_fname" class="form-control form-desid" placeholder="First Name" type="text">
    </td>
       <td> <span id="RequiredFieldValidator3" style="color:Red;display:none;">*</span></td>
  </tr>
   <tr>
    <td height="40" width="200">* Last Name</td>
    <td>:</td>
    <td> 
     <input name="txt_lname" id="txt_lname" class="form-control form-desid" placeholder="Last Name" type="text">
    </td>
       <td> <span id="RequiredFieldValidator4" style="color:Red;display:none;">*</span></td>
  </tr>
   <tr>
    <td height="40" width="200">* Address1</td>
    <td>:</td>
    <td> 
     <input name="txt_add1" id="txt_add1" class="form-control form-desid" placeholder="Address1" type="text">
    </td>
       <td> <span id="RequiredFieldValidator5" style="color:Red;display:none;">*</span></td>
  </tr>
   <tr>
    <td height="40" width="200">&nbsp; Address2</td>
    <td>:</td>
    <td> 
     <input name="txt_add2" id="txt_add2" class="form-control form-desid" placeholder="Address2" type="text"></td>
  </tr>
   <tr>
    <td height="40" width="200">* ZIP</td>
    <td>:</td>
    <td> 
    <input name="txt_zip" id="txt_zip" class="form-control form-desid" placeholder="ZIP" type="text">
    </td>
       <td> <span id="RequiredFieldValidator6" style="color:Red;display:none;">*</span></td>
  </tr>
   <tr>
    <td height="40" width="200">* City </td>
    <td>:</td>
    <td> 
    <input name="txt_city" id="txt_city" class="form-control form-desid" placeholder="City" type="text">
    </td>
       <td> <span id="RequiredFieldValidator7" style="color:Red;display:none;">*</span></td>
  </tr>
   <tr>
    <td height="40" width="200">* Country </td>
    <td>:</td>
    <td>
       <select name="ddlCountry" id="ddlCountry" class="form-control form-desid">
	<option selected="selected" value="0">Select Country</option>
	<option value="AF">Afghanistan</option>
	<option value="AX">ALAND ISLANDS</option>
	<option value="AL">Albania</option>
	<option value="DZ">Algeria</option>
	<option value="AS">American Samoa</option>
	<option value="AD">Andorra</option>
	<option value="AO">Angola</option>
	<option value="AI">Anguilla</option>
	<option value="AQ">ANTARCTICA</option>
	<option value="AG">Antigua and Barbuda</option>
	<option value="AR">Argentina</option>
	<option value="AM">Armenia</option>
	<option value="AW">Aruba</option>
	<option value="AU">Australia</option>
	<option value="AT">Austria</option>
	<option value="AZ">Azerbaijan</option>
	<option value="BS">Bahamas</option>
	<option value="BH">Bahrain</option>
	<option value="BD">Bangladesh</option>
	<option value="BB">Barbados</option>
	<option value="BY">Belarus</option>
	<option value="BE">Belgium</option>
	<option value="BZ">Belize</option>
	<option value="BJ">Benin</option>
	<option value="BM">Bermuda</option>
	<option value="BT">Bhutan</option>
	<option value="BO">Bolivia</option>
	<option value="BA">Bosnia and Herzegovina</option>
	<option value="BW">Botswana</option>
	<option value="BV">BOUVET ISLAND</option>
	<option value="BR">Brazil</option>
	<option value="IO">British Indian Ocean Territory</option>
	<option value="VG">British Virgin Islands</option>
	<option value="BN">Brunei</option>
	<option value="BG">Bulgaria</option>
	<option value="BF">Burkina Faso</option>
	<option value="BI">Burundi</option>
	<option value="KH">Cambodia</option>
	<option value="CM">Cameroon</option>
	<option value="CA">Canada</option>
	<option value="CV">Cape Verde Islands</option>
	<option value="KY">Cayman Islands</option>
	<option value="CF">Central African Republic</option>
	<option value="TD">Chad</option>
	<option value="CL">Chile</option>
	<option value="CN">China</option>
	<option value="CO">Colombia</option>
	<option value="KM">Comoros</option>
	<option value="CG">Congo</option>
	<option value="CK">Cook Islands</option>
	<option value="CR">Costa Rica</option>
	<option value="HR">Croatia</option>
	<option value="CU">Cuba</option>
	<option value="CY">Cyprus</option>
	<option value="CZ">Czech Republic</option>
	<option value="CD">Democratic Republic of the Congo</option>
	<option value="DK">Denmark</option>
	<option value="DJ">Djibouti</option>
	<option value="DM">Dominica</option>
	<option value="DO">Dominican Republic</option>
	<option value="TL">East Timor</option>
	<option value="EC">Ecuador</option>
	<option value="EG">Egypt</option>
	<option value="SV">El Salvador</option>
	<option value="GQ">Equatorial Guinea</option>
	<option value="ER">Eritrea</option>
	<option value="EE">Estonia</option>
	<option value="ET">Ethiopia</option>
	<option value="FK">Falkland Islands</option>
	<option value="FO">FAROE ISLANDS</option>
	<option value="FJ">Fiji</option>
	<option value="FI">Finland</option>
	<option value="FR">France</option>
	<option value="GF">French Guiana</option>
	<option value="PF">French Polynesia</option>
	<option value="TF">FRENCH SOUTHERN TERRITORIES</option>
	<option value="GA">Gabon</option>
	<option value="GM">Gambia</option>
	<option value="GE">Georgia</option>
	<option value="DE">Germany</option>
	<option value="GH">Ghana</option>
	<option value="GI">Gibraltar</option>
	<option value="GR">Greece</option>
	<option value="GL">Greenland</option>
	<option value="GD">Grenada</option>
	<option value="GP">Guadeloupe</option>
	<option value="GU">Guam</option>
	<option value="GT">Guatemala</option>
	<option value="GG">GUERNSEY</option>
	<option value="GN">Guinea</option>
	<option value="GW">Guinea-Bissau</option>
	<option value="GY">Guyana</option>
	<option value="HT">Haiti</option>
	<option value="HM">HEARD ISLAND AND MCDONALD ISLANDS</option>
	<option value="HN">Honduras</option>
	<option value="HK">Hong Kong</option>
	<option value="HU">Hungary</option>
	<option value="IS">Iceland</option>
	<option value="IN">India</option>
	<option value="ID">Indonesia</option>
	<option value="IR">Iran</option>
	<option value="IQ">Iraq</option>
	<option value="IE">Ireland</option>
	<option value="IM">ISLE OF MAN</option>
	<option value="IL">Israel</option>
	<option value="IT">Italy</option>
	<option value="CI">Ivory Coast</option>
	<option value="JM">Jamaica</option>
	<option value="JP">Japan</option>
	<option value="JE">JERSEY</option>
	<option value="JO">Jordan</option>
	<option value="KZ">Kazakhstan</option>
	<option value="KE">Kenya</option>
	<option value="KI">Kiribati</option>
	<option value="KP">Korea, North</option>
	<option value="KR">Korea, South</option>
	<option value="KW">Kuwait</option>
	<option value="KG">Kyrgyzstan</option>
	<option value="LA">Laos</option>
	<option value="LV">Latvia</option>
	<option value="LB">Lebanon</option>
	<option value="LS">Lesotho</option>
	<option value="LR">Liberia</option>
	<option value="LY">Libya</option>
	<option value="LI">Liechtenstein</option>
	<option value="LT">Lithuania</option>
	<option value="LU">Luxembourg</option>
	<option value="MO">MACAO</option>
	<option value="MK">Macedonia</option>
	<option value="MG">Madagascar</option>
	<option value="MW">Malawi</option>
	<option value="MY">Malaysia</option>
	<option value="MV">Maldives</option>
	<option value="ML">Mali</option>
	<option value="MT">Malta</option>
	<option value="MH">Marshall Islands</option>
	<option value="MQ">Martinique</option>
	<option value="MR">Mauritania</option>
	<option value="MU">Mauritius</option>
	<option value="YT">Mayotte</option>
	<option value="MX">Mexico</option>
	<option value="FM">Micronesia</option>
	<option value="MD">Moldova</option>
	<option value="MC">Monaco</option>
	<option value="MN">Mongolia</option>
	<option value="ME">MONTENEGRO</option>
	<option value="MS">Montserrat</option>
	<option value="MA">Morocco</option>
	<option value="MZ">Mozambique</option>
	<option value="MM">Myanmar</option>
	<option value="NA">Namibia</option>
	<option value="NR">Nauru</option>
	<option value="NP">Nepal</option>
	<option value="NL">Netherlands</option>
	<option value="AN">Netherlands Antilles</option>
	<option value="NC">New Caledonia</option>
	<option value="NZ">New Zealand</option>
	<option value="NI">Nicaragua</option>
	<option value="NE">Niger</option>
	<option value="NG">Nigeria</option>
	<option value="NU">Niue</option>
	<option value="NF">Norfolk Island</option>
	<option value="MP">Northern Mariana Islands</option>
	<option value="NO">Norway</option>
	<option value="OM">Oman</option>
	<option value="PK">Pakistan</option>
	<option value="PW">Palau</option>
	<option value="PS">Palestinian West Bank and Gaza</option>
	<option value="PA">Panama</option>
	<option value="PG">Papua New Guinea</option>
	<option value="PY">Paraguay</option>
	<option value="PE">Peru</option>
	<option value="PH">Philippines</option>
	<option value="PN">Pitcairn</option>
	<option value="PL">Poland</option>
	<option value="PT">Portugal</option>
	<option value="PR">Puerto Rico</option>
	<option value="QA">Qatar</option>
	<option value="RE">Réunion</option>
	<option value="RO">Romania</option>
	<option value="RU">Russia</option>
	<option value="RW">Rwanda</option>
	<option value="SH">Saint Helena</option>
	<option value="KN">Saint Kitts and Nevis</option>
	<option value="LC">Saint Lucia</option>
	<option value="PM">Saint Pierre and Miquelon</option>
	<option value="VC">Saint Vincent and the Grenadines</option>
	<option value="WS">Samoa</option>
	<option value="SM">San Marino</option>
	<option value="ST">São Tomé e Príncipe</option>
	<option value="SA">Saudi Arabia</option>
	<option value="SN">Senegal</option>
	<option value="RS">SERBIA</option>
	<option value="CS">Serbia</option>
	<option value="SC">Seychelles</option>
	<option value="SL">Sierra Leone</option>
	<option value="SG">Singapore</option>
	<option value="SK">Slovakia</option>
	<option value="SI">Slovenia</option>
	<option value="SB">Solomon Islands</option>
	<option value="SO">Somalia</option>
	<option value="ZA">South Africa</option>
	<option value="GS">SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS</option>
	<option value="ES">Spain</option>
	<option value="LK">Sri Lanka</option>
	<option value="SD">Sudan</option>
	<option value="SR">Suriname</option>
	<option value="SZ">Swaziland</option>
	<option value="SE">Sweden</option>
	<option value="CH">Switzerland</option>
	<option value="SY">Syria</option>
	<option value="TW">Taiwan</option>
	<option value="TJ">Tajikistan</option>
	<option value="TZ">Tanzania</option>
	<option value="TH">Thailand</option>
	<option value="TG">Togo</option>
	<option value="TK">Tokelau</option>
	<option value="TO">Tonga</option>
	<option value="TT">Trinidad and Tobago</option>
	<option value="TN">Tunisia</option>
	<option value="TR">Turkey</option>
	<option value="TM">Turkmenistan</option>
	<option value="TC">Turks and Caicos Islands</option>
	<option value="TV">Tuvalu</option>
	<option value="VI">U.S. Virgin Islands</option>
	<option value="UG">Uganda</option>
	<option value="UA">Ukraine</option>
	<option value="AE">United Arab Emirates</option>
	<option value="GB">United Kingdom</option>
	<option value="UM">UNITED STATES MINOR OUTLYING ISLANDS</option>
	<option value="UY">Uruguay</option>
	<option value="US">USA</option>
	<option value="UZ">Uzbekistan</option>
	<option value="VU">Vanuatu</option>
	<option value="VA">Vatican State</option>
	<option value="VE">Venezuela</option>
	<option value="VN">Viet Nam</option>
	<option value="WF">Wallis and Futuna</option>
	<option value="YE">Yemen</option>
	<option value="ZM">Zambia</option>
	<option value="ZW">Zimbabwe</option>

</select>    
          
          </td>
          <td>
           <span id="cvCountry" class="error" style="color:Red;display:none;">*</span></td>
          
  </tr>
   <tr>
    <td height="40" width="200">* State </td>
    <td>:</td>
    <td>
     <input name="txt_state" id="txt_state" class="form-control form-desid" placeholder="State" type="text">
         </td>
            <td> <span id="RequiredFieldValidator8" style="color:Red;display:none;">*</span></td>
  </tr>
   <tr>
    <td height="40" width="200">* Email</td>
    <td>:</td>
    <td>
     <input name="txt_email" id="txt_email" class="form-control form-desid" placeholder="Email" type="text">
     
     </td>
        <td> <span id="RequiredFieldValidator9" style="color:Red;display:none;">*</span></td>
  </tr>
   <tr>
    <td height="40" width="200">* Phone</td>
    <td>:</td>
    <td> 
     <input name="txt_phone" id="txt_phone" class="form-control form-desid" placeholder="Phone" type="text">
       
    </td>
       <td> <span id="RequiredFieldValidator10" style="color:Red;display:none;">*</span></td>
  </tr>
  <tr>
    <td height="40" width="200">* Payment Method</td>
    <td>:</td>
     <td>
     <select name="ddlPayment" id="ddlPayment" onchange="return PaymentListOnChanged()" class="form-control form-desid">
	<option selected="selected" value="0">Select Payment</option>
	<option value="1">Paypal</option>
	<option value="2">Cheque</option>

</select>

   </td>
  </tr>
  <tr>
    <td height="40" width="200">* Payee Name</td>
    <td>:</td>
    <td>
     <input name="txt_payee" id="txt_payee" class="form-control form-desid" placeholder="Payee Name" type="text">
    </td>
       <td> <span id="RequiredFieldValidator11" style="color:Red;display:none;">*</span></td>
  </tr>
  <tr>
    <td height="40" width="200">&nbsp;</td>
    <td>&nbsp;</td>
    <td> 
        <input name="submit" value="Submit" onclick='javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions("submit", "", true, "", "", false, false))' id="submit" class="button-md" type="submit">
   
    </td>
  </tr>
</tbody></table>
</div>
  </div>
    <div class="col-md-2"></div>
    
  </div>
</div>
<footer>
  <div class="container-floud bgcolor-f">   
    
   
  </div>
</footer>
    
<script type="text/javascript">
//<![CDATA[
var Page_Validators =  new Array(document.getElementById("rfvSiteUrl"), document.getElementById("RequiredFieldValidator1"), document.getElementById("RequiredFieldValidator2"), document.getElementById("RequiredFieldValidator3"), document.getElementById("RequiredFieldValidator4"), document.getElementById("RequiredFieldValidator5"), document.getElementById("RequiredFieldValidator6"), document.getElementById("RequiredFieldValidator7"), document.getElementById("cvCountry"), document.getElementById("RequiredFieldValidator8"), document.getElementById("RequiredFieldValidator9"), document.getElementById("RequiredFieldValidator10"), document.getElementById("RequiredFieldValidator11"));
//]]>
</script>

<script type="text/javascript">
//<![CDATA[
var rfvSiteUrl = document.all ? document.all["rfvSiteUrl"] : document.getElementById("rfvSiteUrl");
rfvSiteUrl.controltovalidate = "txt_sitename";
rfvSiteUrl.errormessage = "*";
rfvSiteUrl.display = "Dynamic";
rfvSiteUrl.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
rfvSiteUrl.initialvalue = "";
var RequiredFieldValidator1 = document.all ? document.all["RequiredFieldValidator1"] : document.getElementById("RequiredFieldValidator1");
RequiredFieldValidator1.controltovalidate = "txt_siteurl";
RequiredFieldValidator1.errormessage = "*";
RequiredFieldValidator1.display = "Dynamic";
RequiredFieldValidator1.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
RequiredFieldValidator1.initialvalue = "";
var RequiredFieldValidator2 = document.all ? document.all["RequiredFieldValidator2"] : document.getElementById("RequiredFieldValidator2");
RequiredFieldValidator2.controltovalidate = "txt_sitedesc";
RequiredFieldValidator2.errormessage = "*";
RequiredFieldValidator2.display = "Dynamic";
RequiredFieldValidator2.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
RequiredFieldValidator2.initialvalue = "";
var RequiredFieldValidator3 = document.all ? document.all["RequiredFieldValidator3"] : document.getElementById("RequiredFieldValidator3");
RequiredFieldValidator3.controltovalidate = "txt_fname";
RequiredFieldValidator3.errormessage = "*";
RequiredFieldValidator3.display = "Dynamic";
RequiredFieldValidator3.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
RequiredFieldValidator3.initialvalue = "";
var RequiredFieldValidator4 = document.all ? document.all["RequiredFieldValidator4"] : document.getElementById("RequiredFieldValidator4");
RequiredFieldValidator4.controltovalidate = "txt_lname";
RequiredFieldValidator4.errormessage = "*";
RequiredFieldValidator4.display = "Dynamic";
RequiredFieldValidator4.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
RequiredFieldValidator4.initialvalue = "";
var RequiredFieldValidator5 = document.all ? document.all["RequiredFieldValidator5"] : document.getElementById("RequiredFieldValidator5");
RequiredFieldValidator5.controltovalidate = "txt_add1";
RequiredFieldValidator5.errormessage = "*";
RequiredFieldValidator5.display = "Dynamic";
RequiredFieldValidator5.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
RequiredFieldValidator5.initialvalue = "";
var RequiredFieldValidator6 = document.all ? document.all["RequiredFieldValidator6"] : document.getElementById("RequiredFieldValidator6");
RequiredFieldValidator6.controltovalidate = "txt_zip";
RequiredFieldValidator6.errormessage = "*";
RequiredFieldValidator6.display = "Dynamic";
RequiredFieldValidator6.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
RequiredFieldValidator6.initialvalue = "";
var RequiredFieldValidator7 = document.all ? document.all["RequiredFieldValidator7"] : document.getElementById("RequiredFieldValidator7");
RequiredFieldValidator7.controltovalidate = "txt_city";
RequiredFieldValidator7.errormessage = "*";
RequiredFieldValidator7.display = "Dynamic";
RequiredFieldValidator7.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
RequiredFieldValidator7.initialvalue = "";
var cvCountry = document.all ? document.all["cvCountry"] : document.getElementById("cvCountry");
cvCountry.errormessage = "*";
cvCountry.display = "Dynamic";
cvCountry.evaluationfunction = "CustomValidatorEvaluateIsValid";
cvCountry.clientvalidationfunction = "ValidateCountry";
var RequiredFieldValidator8 = document.all ? document.all["RequiredFieldValidator8"] : document.getElementById("RequiredFieldValidator8");
RequiredFieldValidator8.controltovalidate = "txt_state";
RequiredFieldValidator8.errormessage = "*";
RequiredFieldValidator8.display = "Dynamic";
RequiredFieldValidator8.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
RequiredFieldValidator8.initialvalue = "";
var RequiredFieldValidator9 = document.all ? document.all["RequiredFieldValidator9"] : document.getElementById("RequiredFieldValidator9");
RequiredFieldValidator9.controltovalidate = "txt_email";
RequiredFieldValidator9.errormessage = "*";
RequiredFieldValidator9.display = "Dynamic";
RequiredFieldValidator9.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
RequiredFieldValidator9.initialvalue = "";
var RequiredFieldValidator10 = document.all ? document.all["RequiredFieldValidator10"] : document.getElementById("RequiredFieldValidator10");
RequiredFieldValidator10.controltovalidate = "txt_phone";
RequiredFieldValidator10.errormessage = "*";
RequiredFieldValidator10.display = "Dynamic";
RequiredFieldValidator10.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
RequiredFieldValidator10.initialvalue = "";
var RequiredFieldValidator11 = document.all ? document.all["RequiredFieldValidator11"] : document.getElementById("RequiredFieldValidator11");
RequiredFieldValidator11.controltovalidate = "txt_payee";
RequiredFieldValidator11.errormessage = "*";
RequiredFieldValidator11.display = "Dynamic";
RequiredFieldValidator11.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
RequiredFieldValidator11.initialvalue = "";
//]]>
</script>


<script type="text/javascript">
//<![CDATA[

var Page_ValidationActive = false;
if (typeof(ValidatorOnLoad) == "function") {
    ValidatorOnLoad();
}

function ValidatorOnSubmit() {
    if (Page_ValidationActive) {
        return ValidatorCommonOnSubmit();
    }
    else {
        return true;
    }
}
        //]]>
</script>
</form>


</body></html>

