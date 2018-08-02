<?php include_once("check-login-status.php");?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php if($user_ok == false){?>
<div class="panel panel-default bgc">
<div class="panel-title">
	<h2 class="center"><strong>Registration</strong></h2>
</div>
<div id="reg" class="well">
	<div class="">
		<form class="form-horizontal" method="POST" action="preregister.php" role="form" id="regform" onclick="return onSubmit();">

			<div class="form-group">
				<div class="form-inline">
					<label for="regusername" class="col-xs-3 col-sm-2 control-label">Username</label>
					<div class="col-xs-9 col-sm-5">
						<input type="text" class="form-control" name="regusername" id="regusername" placeholder="Username" data-toggle="tooltip" data-placement="top" title="unavailable">

					</div>
					<div class="col-xs-offset-4">
						<span id='isvalidusername'></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="form-inline">
					<label for="regemail" class="col-xs-3 col-sm-2 control-label">Email</label>
					<div class="col-xs-9 col-sm-5"> 
						<input type="email" name="regemail" class="form-control" id="regemail" placeholder="Email">
					</div>
					<div class="col-xs-offset-4">
						<span id='isvalidemail'></span>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="form-inline">
					<label for="regpassword" class="col-xs-3 col-sm-2 control-label">Password</label>
					<div class="col-xs-9 col-sm-5">
						<input type="password" class="form-control" id="regpassword" placeholder="New Password">
					</div>
					<div class="col-xs-offset-4">
						<span id='passwordlength'></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="form-inline">
					<label for="regconfpassword" class="col-xs-3 col-sm-2 control-label">Password</label>
					<div class="col-xs-9 col-sm-5">
						<input type="password" class="form-control" id="regconfpassword" placeholder="Confirm Password">
					</div>
					<div class="col-xs-offset-4">
						<span id='confirmpassword'></span>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="form-inline ">
					<label for="regcategory" class="col-xs-3 col-sm-2 control-label">Category</label>
					<div class="col-xs-3 col-sm-3">
						<select id="regcategory" name="regcategory" class="form-control" onchange="getval(this);">
							<option value="doctor">Doctor</option>
							<option value="hospital">Hospital</option>
							<!-- <option value="diagnostic">Diagnostic</option>
							<option value="ambulance">Ambulance</option>
							<option value="medicine">Medicine</option> -->
						</select>
					</div>
				</div>

				<div class="form-group-md">
					<label for="regcountry" class="col-xs-3 col-sm-2 control-label">Country</label>
					<div class="col-xs-3 col-sm-5">
						<select id="regcountry" class="form-control">
							<option value="AF">Afghanistan</option>
							<option value="AX">Åland Islands</option>
							<option value="AL">Albania</option>
							<option value="DZ">Algeria</option>
							<option value="AS">American Samoa</option>
							<option value="AD">Andorra</option>
							<option value="AO">Angola</option>
							<option value="AI">Anguilla</option>
							<option value="AQ">Antarctica</option>
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
							<option value="BQ">Bonaire</option>
							<option value="BA">Bosnia and Herzegovina</option>
							<option value="BW">Botswana</option>
							<option value="BV">Bouvet Island</option>
							<option value="BR">Brazil</option>
							<option value="BN">Brunei Darussalam</option>
							<option value="BG">Bulgaria</option>
							<option value="BF">Burkina Faso</option>
							<option value="BI">Burundi</option>
							<option value="KH">Cambodia</option>
							<option value="CM">Cameroon</option>
							<option value="CA">Canada</option>
							<option value="CV">Cape Verde</option>
							<option value="KY">Cayman Islands</option>
							<option value="CF">Central African Republic</option>
							<option value="TD">Chad</option>
							<option value="CL">Chile</option>
							<option value="CN">China</option>
							<option value="CX">Christmas Island</option>
							<option value="CC">Cocos (Keeling) Islands</option>
							<option value="CO">Colombia</option>
							<option value="KM">Comoros</option>
							<option value="CG">Congo</option>
							<option value="CK">Cook Islands</option>
							<option value="CR">Costa Rica</option>
							<option value="CI">Côte d'Ivoire</option>
							<option value="HR">Croatia</option>
							<option value="CU">Cuba</option>
							<option value="CW">Curaçao</option>
							<option value="CY">Cyprus</option>
							<option value="CZ">Czech Republic</option>
							<option value="DK">Denmark</option>
							<option value="DJ">Djibouti</option>
							<option value="DM">Dominica</option>
							<option value="DO">Dominican Republic</option>
							<option value="EC">Ecuador</option>
							<option value="EG">Egypt</option>
							<option value="SV">El Salvador</option>
							<option value="GQ">Equatorial Guinea</option>
							<option value="ER">Eritrea</option>
							<option value="EE">Estonia</option>
							<option value="ET">Ethiopia</option>
							<option value="FK">Falkland Islands</option>
							<option value="FO">Faroe Islands</option>
							<option value="FJ">Fiji</option>
							<option value="FI">Finland</option>
							<option value="FR">France</option>
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
							<option value="GG">Guernsey</option>
							<option value="GN">Guinea</option>
							<option value="GW">Guinea-Bissau</option>
							<option value="GY">Guyana</option>
							<option value="HT">Haiti</option>
							<option value="HN">Honduras</option>
							<option value="HK">Hong Kong</option>
							<option value="HU">Hungary</option>
							<option value="IS">Iceland</option>
							<option value="IN">India</option>
							<option value="ID">Indonesia</option>
							<option value="IR">Iran</option>
							<option value="IQ">Iraq</option>
							<option value="IE">Ireland</option>
							<option value="IM">Isle of Man</option>
							<option value="IL">Israel</option>
							<option value="IT">Italy</option>
							<option value="JM">Jamaica</option>
							<option value="JP">Japan</option>
							<option value="JE">Jersey</option>
							<option value="JO">Jordan</option>
							<option value="KZ">Kazakhstan</option>
							<option value="KE">Kenya</option>
							<option value="KI">Kiribati</option>
							<option value="KR">Korea</option>
							<option value="KW">Kuwait</option>
							<option value="KG">Kyrgyzstan</option>
							<option value="LV">Latvia</option>
							<option value="LB">Lebanon</option>
							<option value="LS">Lesotho</option>
							<option value="LR">Liberia</option>
							<option value="LY">Libya</option>
							<option value="LI">Liechtenstein</option>
							<option value="LT">Lithuania</option>
							<option value="LU">Luxembourg</option>
							<option value="MO">Macao</option>
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
							<option value="ME">Montenegro</option>
							<option value="MS">Montserrat</option>
							<option value="MA">Morocco</option>
							<option value="MZ">Mozambique</option>
							<option value="MM">Myanmar</option>
							<option value="NA">Namibia</option>
							<option value="NR">Nauru</option>
							<option value="NP">Nepal</option>
							<option value="NL">Netherlands</option>
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
							<option value="PS">Palestinian</option>
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
							<option value="RO">Romania</option>
							<option value="RU">Russian Federation</option>
							<option value="RW">Rwanda</option>
							<option value="BL">Saint Barthélemy</option>
							<option value="KN">Saint Kitts and Nevis</option>
							<option value="LC">Saint Lucia</option>
							<option value="WS">Samoa</option>
							<option value="SM">San Marino</option>
							<option value="SA">Saudi Arabia</option>
							<option value="SN">Senegal</option>
							<option value="RS">Serbia</option>
							<option value="SC">Seychelles</option>
							<option value="SL">Sierra Leone</option>
							<option value="SG">Singapore</option>
							<option value="SK">Slovakia</option>
							<option value="SI">Slovenia</option>
							<option value="SB">Solomon Islands</option>
							<option value="SO">Somalia</option>
							<option value="ZA">South Africa</option>
							<option value="SS">South Sudan</option>
							<option value="ES">Spain</option>
							<option value="LK">Sri Lanka</option>
							<option value="SD">Sudan</option>
							<option value="SR">Suriname</option>
							<option value="SZ">Swaziland</option>
							<option value="SE">Sweden</option>
							<option value="CH">Switzerland</option>
							<option value="SY">Syrian</option>
							<option value="TW">Taiwan</option>
							<option value="TJ">Tajikistan</option>
							<option value="TZ">Tanzania</option>
							<option value="TH">Thailand</option>
							<option value="TL">Timor-Leste</option>
							<option value="TG">Togo</option>
							<option value="TK">Tokelau</option>
							<option value="TO">Tonga</option>
							<option value="TT">Trinidad and Tobago</option>
							<option value="TN">Tunisia</option>
							<option value="TR">Turkey</option>
							<option value="TM">Turkmenistan</option>
							<option value="TV">Tuvalu</option>
							<option value="UG">Uganda</option>
							<option value="UA">Ukraine</option>
							<option value="AE">United Arab Emirates</option>
							<option value="GB">United Kingdom</option>
							<option value="US">United States</option>
							<option value="UY">Uruguay</option>
							<option value="UZ">Uzbekistan</option>
							<option value="VU">Vanuatu</option>
							<option value="VE">Venezuela</option>
							<option value="VN">Viet Nam</option>
							<option value="WF">Wallis and Futuna</option>
							<option value="EH">Western Sahara</option>
							<option value="YE">Yemen</option>
							<option value="ZM">Zambia</option>
							<option value="ZW">Zimbabwe</option>
						</select>
					</div>

				</div>
			</div>


			<div id="selectspecialistdef" class="form-group">
				<div class="form-inline ">
					<label for="selectspecialist" class="col-xs-3 col-sm-2 control-label">Speciality</label>
					<div class="col-xs-9 col-sm-4">
						<select id="selectspecialist" class="form-control"> 
							<option>Select one</option>
							<option>Addiction psychiatrist</option>
							<option>Allergist (immunologist)</option>
							<option>Anesthesiologist</option>
							<option>Cardiac electrophysiologist</option>
							<option>Cardiologist</option>
							<option>Cardiovascular surgeon</option>
							<option>Colon and rectal surgeon</option>
							<option>Critical care medicine specialist</option>
							<option>Dermatologist</option>
							<option>Developmental pediatrician</option>
							<option>Emergency medicine specialist</option>
							<option>Endocrinologist</option>
							<option>Family medicine physician</option>
							<option>Forensic pathologist</option>
							<option>Gastroenterologist</option>
							<option>Geriatric medicine specialist</option>
							<option>Gynecologist</option>
							<option>Gynecologic oncologist</option> 
							<option>Hand surgeon</option>
							<option>Hematologist</option>
							<option>Hepatologist</option>
							<option>Hospitalist</option>
							<option>Hyperbaric physician</option> 
							<option>Infectious disease specialist</option>
							<option>Internist</option>
							<option>Interventional cardiologist</option>
							<option>Medical examiner</option>
							<option>Medical geneticist</option>
							<option>Medicine specialist</option>
							<option>Neonatologist</option>
							<option>Nephrologist</option>
							<option>Neurological surgeon</option>
							<option>Neurologist</option>
							<option>Nuclear medicine specialist</option>
							<option>Obstetrician</option>
							<option>Occupational medicine specialist</option>
							<option>Oncologist</option>
							<option>Ophthalmologist</option>
							<option>Oral surgeon</option>
							<option>Orthopedic surgeon</option>
							<option>Otolaryngologist (ENT specialist)</option>
							<option>Pain management specialist</option>
							<option>Pathologist</option>
							<option>Pediatrician</option>
							<option>Perinatologist</option>
							<option>Physiatrist</option>
							<option>Plastic surgeon</option>
							<option>Psychiatrist</option>
							<option>Pulmonologist</option>
							<option>Radiation oncologist</option>
							<option>Radiologist</option>
							<option>Reproductive endocrinologist</option>
							<option>Rheumatologist</option>
							<option>Sleep disorders specialist</option>
							<option>Spinal cord injury specialist</option>
							<option>Sports medicine specialist</option>
							<option>Surgeon</option>
							<option>Thoracic surgeon</option>
							<option>Urologist</option>
							<option>Vascular surgeon</option>
						</select>
					</div>
					<div class="col-xs-offset-4 col-sm-5">
						<span id='specialistspan'></span>
					</div>
				</div>
			</div>


			<div class="form-group">
				<div class="form-inline">
					<label  id="regbirthday" class="col-xs-3 col-sm-2 control-label">Birthday</label>
					<label  id="regestablish" class="col-xs-3 col-sm-2 control-label">Established</label>

					<div class="col-xs-3 col-sm-2">
						<select id="month" class="form-control" name="month"> 
							<option value="0">Month</option>
							<option value="01">Jan</option>       
							<option value="02">Feb</option>       
							<option value="03">Mar</option>       
							<option value="04">Apr</option>       
							<option value="05">May</option>       
							<option value="06">Jun</option>       
							<option value="07">Jul</option>       
							<option value="08">Aug</option>       
							<option value="09">Sep</option>       
							<option value="10">Oct</option>       
							<option value="11">Nov</option>       
							<option value="12">Dec</option>       
						</select>
					</div>

					<div class="col-xs-3 col-sm-2">
						<select id="day" class="form-control" name="day">
							<option>Day</option> 
							<option>01</option>       
							<option>02</option>       
							<option>03</option>       
							<option>04</option>       
							<option>05</option>       
							<option>06</option>       
							<option>07</option>       
							<option>08</option>       
							<option>09</option>       
							<option>10</option>       
							<option>11</option>       
							<option>12</option>       
							<option>13</option>       
							<option>14</option>       
							<option>15</option>       
							<option>16</option>       
							<option>17</option>       
							<option>18</option>       
							<option>19</option>       
							<option>20</option>       
							<option>21</option>       
							<option>22</option>       
							<option>23</option>       
							<option>24</option>       
							<option>25</option>       
							<option>26</option>       
							<option>27</option>       
							<option>28</option>       
							<option>29</option>       
							<option>30</option>       
							<option>31</option>       
						</select>
					</div>

					<div class="col-xs-3 col-sm-3">
						<select id="year" class="form-control" name="year"> 
							<option>Year</option>
							<option>2000</option>
							<option>1999</option>
							<option>1998</option>
							<option>1997</option>
							<option>1996</option>
							<option>1995</option>
							<option>1994</option>
							<option>1993</option>
							<option>1992</option>
							<option>1991</option>
							<option>1990</option>
							<option>1989</option>
							<option>1988</option>
							<option>1987</option>
							<option>1986</option>
							<option>1985</option>
							<option>1984</option>
							<option>1983</option>
							<option>1982</option>
							<option>1981</option>
							<option>1980</option>
							<option>1979</option>
							<option>1978</option>
							<option>1977</option>
							<option>1976</option>
							<option>1975</option>
							<option>1974</option>
							<option>1973</option>
							<option>1972</option>
							<option>1971</option>
							<option>1970</option>
							<option>1969</option>
							<option>1968</option>
							<option>1967</option>
							<option>1966</option>
							<option>1965</option>
							<option>1964</option>
							<option>1963</option>
							<option>1962</option>
							<option>1961</option>
							<option>1960</option> 
							<option>1959</option>
							<option>1958</option>
							<option>1957</option>
							<option>1956</option>
							<option>1955</option>
							<option>1954</option>
							<option>1953</option>
							<option>1952</option>
							<option>1951</option>
							<option>1950</option>
							<option>1949</option>
							<option>1948</option>
							<option>1947</option>
							<option>1946</option>
							<option>1945</option>
							<option>1944</option>
							<option>1943</option>
							<option>1942</option>
							<option>1941</option>
							<option>1940</option>
							<option>1939</option>
							<option>1938</option>
							<option>1937</option>
							<option>1936</option>
							<option>1935</option>
							<option>1934</option>
							<option>1933</option>
							<option>1932</option>
							<option>1931</option>
							<option>1930</option>
							<option>1929</option>
							<option>1928</option>
							<option>1927</option>
							<option>1926</option>
							<option>1925</option>
							<option>1924</option>
							<option>1923</option>
							<option>1922</option>
							<option>1921</option>
							<option>1920</option>
						</select> 
					</div>

					<div class="col-xs-offset-4">
						<span id='isbirthday'></span>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="form-inline">
					<label for="regtimezone" class="col-xs-3 col-sm-2 control-label">TimeZone</label>
					<div class="col-xs-9 col-sm-3">
<?php 
						function formatOffset($offset) {
							$hours = $offset / 3600;
							$remainder = $offset % 3600;
							$sign = $hours > 0 ? '+' : '-';
							$hour = (int) abs($hours);
							$minutes = (int) abs($remainder / 60);

							if ($hour == 0 AND $minutes == 0) {
								$sign = '+';
							}
							return $sign . str_pad($hour, 2, '0', STR_PAD_LEFT) .':'. str_pad($minutes,2, '0');

						}

						$utc = new DateTimeZone('UTC');
						$dt = new DateTime('now', $utc);

						foreach(DateTimeZone::listIdentifiers() as $tz) {
							$current_tz = new DateTimeZone($tz);
							$offset =  $current_tz->getOffset($dt);
							$valus = formatOffset($offset);
							$array[$tz] = $valus;
							$transition =  $current_tz->getTransitions($dt->getTimestamp(), $dt->getTimestamp());
							$abbr = $transition[0]['abbr'];
						}
						asort($array);
						echo '<select id="regtimezone" class="form-control" name="userTimeZone">';
						foreach ($array as $key => $value) {
							$variable = substr($key, strpos($key, "/")+1, strlen($key));
							echo '<option value="'.$key.'">UTC '.$value. ' ' .$variable.'</option>';
						}
						echo '</select>';
?>
					</div>
					<div class="col-xs-offset-4">
						<span id='issetzone'></span>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="form-inline">
					<label for="regpostcode" class="col-xs-3 col-sm-2 control-label">Postcode</label>
					<div class="col-xs-9 col-sm-5">
						<input type="text" class="form-control" id="regpostcode" placeholder="Postcode/Zipcode">
					</div>
					<div class="col-xs-offset-4">
						<span id='ispostcode'></span>
					</div>
				</div>
			</div>


			<div class="form-group">
				<div id="sex">
					<label class="col-xs-3 col-sm-2 control-label">Gender</label>

					<div class="radio col-xs-2 col-xs-offset-1 col-sm-offset-1 col-sm-2">
						<input id="male" value="Male" name="sexx" type="radio"> Male 
					</div>
					<div class=" radio col-xs-6 col-sm-2">
						<input id="female" value="Female" name="sexx" type="radio"> Female
					</div>
					<div class="col-xs-offset-4">
						<span id="definesex"></span>
					</div>
				</div>
			</div>



			<div class="form-group">
				<div class="checkbox">
					<div class="col-xs-offset-3 col-xs-9 col-sm-offset-2 col-sm-10">
						<label><input name="agree" type="checkbox" id="agreementcheckbox" data-toggle="popover" data-placement="left" title="You must agree."> I have read and agree with all <a href="terms.php"> terms and conditions.</a></label>
					</div>
				</div>

			</div>
			<div class="form-group">
				<div class="col-xs-offset-3 col-xs-3 col-sm-offset-2 col-sm-2">
					<button type="button" id="btnsignup" class="btn btn-success btn-md">Continue</button>
				</div>
				<div class="col-xs-offset-1 col-xs-5 col-sm-offset-1 col-sm-7">
					<span id="waiting"></span>
				</div>
			</div>

		</form>
	</div>
</div>
</div>
<?php } ?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

<script type="text/javascript">

	function validateText(id)
	{
		if($("#"+id).val()==null || $("#"+id).val()=="")
		{
			var div = $("#"+id).closest("div");
			div.addClass("has-error");
			return false;
		}
		else
		{
			var div = $("#"+id).closest("div");
			div.removeClass("has-error");
		}
	}


	function boxShadding(id)
	{
		if($("#"+id).val() != null || $("#"+id).val() != "")
		{
			var div = $("#"+id).closest("div");
			div.removeClass("has-error");
		}
	}
	/*Function End here*/


	$(document).ready(function() {

		$("#btnsignup").click(function() {
			var tz = $("#regtimezone option:selected").val();
			var name = $("#regusername").val();
			var email = $("#regemail").val();
			var password = $("#regpassword").val();
			var cpassword = $("#regconfpassword").val();
			var month = $('#month option:selected').val();
			var day = $('#day option:selected').text();
			var year = $('#year option:selected').text();
			var category = $("#regcategory option:selected").val();
			var country = $("#regcountry option:selected").text();
			var speciality = $("#selectspecialist option:selected").text();
			var postcode = $("#regpostcode").val();
			var sex = $("input[name=sexx]:checked").val();
			var setsex = "";
			var agreebox = $("input[name=agree]:checked").val();
	              //alert(category);
	            if(!validateText("regusername") && name == '')
	            {
	                //return false;
	                $('#isvalidusername').html('required field.').css('color', 'red');
	            }
	            if(!validateText("regemail") && email == '')
	            {
	            	$('#isvalidemail').html('required field.').css('color', 'red');
	                //return false;
	            }
	            if(!validateText("regpassword"))
	            {
	                //return false;
	            }
	            if(!validateText("regconfpassword"))
	            {
	                //return false;
	            }
	            if(speciality == 'Select one'){
	            	$('#specialistspan').html('select your speciality').css('color','red');
	            }else{
	            	$('#specialistspan').html('');
	            }
	            if(month == 'Month' || day == 'Day' || year=='Year'){
	            	$('#isbirthday').html('required field.').css('color', 'red');
	            }else{
	            	$('#isbirthday').html('');
	            }
	            if(!validateText("regpostcode") && postcode == '')
	            {
	            	$('#ispostcode').html('required field.').css('color', 'red');
	                //return false;
	            } 
	            if(sex == null && category == 'doctor'){
	            	$('#definesex').html('required field.').css('color', 'red');
	                  //return false;
	              }else{
	              	setsex = $("input[name=sexx]:checked").val();
	              }
	            if(agreebox == null){
	              	setTimeout(function() {
	              		$('#agreementcheckbox').popover('show');
	              	}, 200);
	            }


	              if((password.length) < 6 || !(password).match(cpassword) || !(cpassword).match(password))
	              {
	              	if ((password.length) < 6) { 
	              		$('#passwordlength').html('at least 6 characters').css('color', 'red');
	              	}if (!(password).match(cpassword) || !(cpassword).match(password)) {
	              		$('#confirmpassword').html('miss-match').css('color', 'red');
	              	} 
	              }else {
	              	$.post("check-user-email.php", {
	              		name: name,
	              		email: email,
	              		category: category,
	              		country: country,
	              		speciality: speciality,
	              		postcode: postcode,
	              		month: month,
	              		day: day,
	              		year: year,
	              		sex: sex,
	              		setsex: setsex,
	              		agree: agreebox,
	              		password: password,
	              		tz:tz
	              	},function(data) {
	              		
	              		success = data.indexOf('You have Successfully Registered.....');
	              		if (success >= 0 ){
	              			$("form#regform").submit();
	                    //$("form#regform")[0].reset();
	                    $("#waiting").html("<strong>Please wait..</strong>")
	                }
	                if(data == "invalid email..."){
	                	$('#isvalidemail').html('invalid email format.').css('color', 'red');
	                }
	                if(data == 'please use lowercase alphabet, number or underscore.'){
	                	$$('#isvalidusername').html(data).css('color', 'red');
	                }
	                if(data == "This email is already registered, Please try another email..."){
	                	$('#isvalidemail').html('Email is already used.').css('color', 'red');
	                }
	                if(data == "This username is already registered, Please try another name..."){
	                	$('#isvalidusername').html('Username not available.').css('color', 'red');
	                }
	                if(data == "invalid post code format."){
	                	$('#ispostcode').html(data).css('color', 'red');
	                }
	                if(data == 'you miss this one!'){
	                	$('#specialistspan').html(data).css('color','red');
	                }
	                if(data == "required field birthday."){
	                	$('#isbirthday').html(data).css('color','red');
	                }
	                if(data == "required field sex."){
	                	$('#definesex').html(data).css('color','red');
	                }
	                if(data == 'username cannot begin with a number.'){
	                	$('#isvalidusername').html(data).css('color','red');
	                }
	                if(data == 'you must agree.'){
	                	setTimeout(function() {
	                		$('#agreementcheckbox').popover('show');
	                	}, 200);

	                }

	                      //alert(data);
	                  });
}

});
/*btnsignup click end here*/

/*Check Regusername Avaiability Start Here...*/

$('#regusername').keyup(function()
{
	var user = $('#regusername').val();
	boxShadding('regusername');
	if(user != '')
	{
		$.post('check-username.php',{username:user},
			function(data)
			{
				if(data == 'unavailable'){
					$('#isvalidusername').html(data).css('color','red');
				}else if(data == 'username cannot begin with a number'){
					$('#isvalidusername').html(data).css('color','red');
				}else if(data == 'please use at least four character'){
					$('#isvalidusername').html(data).css('color','red');
				}else if(data == 'please use lowercase alphabet, number or underscore'){
					$('#isvalidusername').html(data).css('color','red');
				}else if(data=='available'){
					$('#isvalidusername').html(data).css('color','green');
				}
			});
	}else
	{
		$('#isvalidusername').html('');
	}
});
/*Check Regusername Avaiability End Here...*/


/*Check Regemail Avaiability Start Here...*/

$('#regemail').keyup(function()
{
	var mail = $('#regemail').val();
	boxShadding('regemail');
	if(mail != '')
	{
		$.post('check-username.php',{email:mail},
			function(data)
			{
				if(data == 'this email is already used'){
					$('#isvalidemail').html(data).css('color','red');
				}else if(data == "invalid email format"){
					$('#isvalidemail').html(data).css('color','red');
				}else if(data == "valid email format"){
					$('#isvalidemail').html(data).css('color','green');
				}

			});
	}else{

		$('#isvalidemail').html('');
	}
});
/*Check Regemail Avaiability End Here...*/


/*Password Length Define From End */
$('#regpassword').keyup(function ()
{
	var pass=$('#regpassword').val();
	boxShadding('regpassword');
	if(pass !=''){
		if (pass.length < 6)
		{
			$('#passwordlength').html('please use at least six characters').css('color', 'red');
		}else{
			$('#passwordlength').html('');
		} 
	}else{
		$('#passwordlength').html('');
	}
});
/*Password Length Define From End Stackoverflow 06/08/2015*/



/*Password Matching From Start Here Stackoverflow 06/08/2015*/
$('#regconfpassword').keyup(function ()
{
	var conpass=$('#regconfpassword').val();
	boxShadding('regconfpassword');
	if(conpass != ''){

		if ($('#regpassword').val() == conpass)
		{
			$('#confirmpassword').html('match').css('color', 'green');
		} 
		else 
		{
			$('#confirmpassword').html('miss-match').css('color', 'red');
		}
	}else{
		$('#confirmpassword').html('');
	}
});
/*Password Matching From End Stackoverflow 06/08/2015*/

/*Checkbox check start here*/

/*Checkbox check End here*/

/*Radio Button Check Start here*/
$('#male, #female').on('click', function(){
	$('#definesex').html('');
});
/*$("input[name=sexx]:checked").val();*/
/*Radio Button Check End here*/



});
/*Document Ready function End Here here*/

/*Check Post Code Format Start Here...*/

$('#regpostcode').keyup(function()
{
	var postcode = $('#regpostcode').val();
	boxShadding('regpostcode');
	if(postcode != '')
	{
		$.post('check-username.php', {postcode: postcode},
			function(data)
			{
				if(data == 'invalid post code format'){
					$('#ispostcode').html(data).css('color','red');
				}else{
					$('#ispostcode').html('').css('color','green');
				}

			});
	}else{
		$('#ispostcode').html('');
	}
});

$('#searchpostcode').keyup(function()
{
	var postcode = $('#searchpostcode').val();
	boxShadding('searchpostcode');
	if(postcode != '')
	{
		$.post('check-username.php', {postcode: postcode},
			function(data)
			{
				if(data == 'invalid post code format'){
					$('#searchpostcodeisvalid').html(data).css('color','red');
				}else{
					$('#searchpostcodeisvalid').html('').css('color','green');
				}

			});
	}else{
		$('#searchpostcodeisvalid').html('');
	}
});
/*Check Post Code Format End Here...*/


	/*Birthday/Establish Date Start here*/
$('#regcategory').change(function () {
	var month = $('#month option:selected').text();
	var day = $('#day option:selected').text();
	var year = $('#year option:selected').text();

	if(month != 'Month' && day != 'Day' && year != 'Year'){
		$('#isbirthday').html('');
	}
});
/*Birthday/Establish Date End here*/

$('#regcategory').change(function () {
	var optionSelected = $(this).find("option:selected");
	var valueSelected  = optionSelected.val();

	if(valueSelected == 'doctor'){
		$('#sex').show();
		$('#regestablish').hide();
		$('#regbirthday').show();
		$('#selectspecialist').show();
		$('#selectspecialistdef').show();
	}else if(valueSelected == 'hospital' || valueSelected == 'diagnostic' || valueSelected == 'ambulance' || valueSelected == 'medicine'){
		$('#sex').hide();
		$('#regbirthday').hide();
		$('#regestablish').show();
		$('#selectspecialist').hide();
		$('#selectspecialistdef').hide();
	}
});

</script>
</body>
</html>