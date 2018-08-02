 <?php 
function formatOffset($offset) {
        $hours = $offset / 3600;
        $remainder = $offset % 3600;
        $sign = $hours > 0 ? '+' : '-';
        $hour = (int) abs($hours);
        $minutes = (int) abs($remainder / 60);

        if ($hour == 0 AND $minutes == 0) {
            $sign = ' ';
        }
        return $sign . str_pad($hour, 2, '0', STR_PAD_LEFT) .':'. str_pad($minutes,2, '0');

}
  
$utc = new DateTimeZone('UTC');
$dt = new DateTime('now', $utc);

//echo '<select name="userTimeZone">';
foreach(DateTimeZone::listIdentifiers() as $tz) {
    $current_tz = new DateTimeZone($tz);
    $offset =  $current_tz->getOffset($dt);
 	$valus = formatOffset($offset);
 	$array[$tz] = $valus;
    $transition =  $current_tz->getTransitions($dt->getTimestamp(), $dt->getTimestamp());
    $abbr = $transition[0]['abbr'];

    //echo '<option value="' .$tz. '">' .$tz. ' [' .$abbr. ' '. formatOffset($offset). ']</option>';
    //echo '<option value="' .$tz. '">' .$tz. '</option>';
}
asort($array);
echo '<select name="userTimeZone">';
foreach ($array as $key => $value) {
	//$variable = substr($key, strpos($key, "/")+1, strlen($key));
	echo '<option value="'.$key.'">UTC '.$value. ' ' .$key.'</option>';
}
echo '</select>';
 ?>

<!--  <select>
	<option value="-12">(GMT-12:00) International Date Line West</option>
	<option value="-11">(GMT-11:00) Midway Island, Samoa</option>
	<option value="-10">(GMT-10:00) Hawaii</option>
	<option value="-9">(GMT-09:00) Alaska</option>
	<option value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
	<option value="-8">(GMT-08:00) Tijuana, Baja California</option>
	<option value="-7">(GMT-07:00) Arizona</option>
	<option value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
	<option value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
	<option value="-6">(GMT-06:00) Central America</option>
	<option value="-6">(GMT-06:00) Central Time (US & Canada)</option>
	<option value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
	<option value="-6">(GMT-06:00) Saskatchewan</option>
	<option value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
	<option value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
	<option value="-5">(GMT-05:00) Indiana (East)</option>
	<option value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
	<option value="-4">(GMT-04:00) Caracas, La Paz</option>
	<option value="-4">(GMT-04:00) Manaus</option>
	<option value="-4">(GMT-04:00) Santiago</option>
	<option value="-3.5">(GMT-03:30) Newfoundland</option>
	<option value="-3">(GMT-03:00) Brasilia</option>
	<option value="-3">(GMT-03:00) Buenos Aires, Georgetown</option>
	<option value="-3">(GMT-03:00) Greenland</option>
	<option value="-3">(GMT-03:00) Montevideo</option>
	<option value="-2">(GMT-02:00) Mid-Atlantic</option>
	<option value="-1">(GMT-01:00) Cape Verde Is.</option>
	<option value="-1">(GMT-01:00) Azores</option>
	<option value="Africa/Abidjan">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
	<option value="0">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
	<option value="1">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
	<option value="1">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
	<option value="1">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
	<option value="Africa/Algiers">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
	<option value="1">(GMT+01:00) West Central Africa</option>
	<option value="2">(GMT+02:00) Amman</option>
	<option value="2">(GMT+02:00) Athens, Bucharest, Istanbul</option>
	<option value="2">(GMT+02:00) Beirut</option>
	<option value="2">(GMT+02:00) Cairo</option>
	<option value="2">(GMT+02:00) Harare, Pretoria</option>
	<option value="2">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
	<option value="2">(GMT+02:00) Jerusalem</option>
	<option value="2">(GMT+02:00) Minsk</option>
	<option value="2">(GMT+02:00) Windhoek</option>
	<option value="3">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
	<option value="3">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
	<option value="3">(GMT+03:00) Nairobi</option>
	<option value="Africa/Addis_Ababa">(GMT+03:00) Tbilisi</option>
	<option value="3.5">(GMT+03:30) Tehran</option>
	<option value="4">(GMT+04:00) Abu Dhabi, Muscat</option>
	<option value="4">(GMT+04:00) Baku</option>
	<option value="4">(GMT+04:00) Yerevan</option>
	<option value="4.5">(GMT+04:30) Kabul</option>
	<option value="5">(GMT+05:00) Yekaterinburg</option>
	<option value="5">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
	<option value="5.5">(GMT+05:30) Sri Jayawardenapura</option>
	<option value="5.5">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
	<option value="5.75">(GMT+05:45) Kathmandu</option>
	<option value="6">(GMT+06:00) Almaty, Novosibirsk</option>
	<option value="6">(GMT+06:00) Astana, Dhaka</option>
	<option value="6.5">(GMT+06:30) Yangon (Rangoon)</option>
	<option value="7">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
	<option value="7">(GMT+07:00) Krasnoyarsk</option>
	<option value="8">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
	<option value="8">(GMT+08:00) Kuala Lumpur, Singapore</option>
	<option value="8">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
	<option value="8">(GMT+08:00) Perth</option>
	<option value="8">(GMT+08:00) Taipei</option>
	<option value="9">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
	<option value="9">(GMT+09:00) Seoul</option>
	<option value="9">(GMT+09:00) Yakutsk</option>
	<option value="9.5">(GMT+09:30) Adelaide</option>
	<option value="9.5">(GMT+09:30) Darwin</option>
	<option value="10">(GMT+10:00) Brisbane</option>
	<option value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option>
	<option value="10">(GMT+10:00) Hobart</option>
	<option value="10">(GMT+10:00) Guam, Port Moresby</option>
	<option value="10">(GMT+10:00) Vladivostok</option>
	<option value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
	<option value="12">(GMT+12:00) Auckland, Wellington</option>
	<option value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
	<option value="13">(GMT+13:00) Nuku'alofa</option>
</select> -->


 <?php
 
// function get_timezones()
// {
//     $o = array();
     
//     $t_zones = timezone_identifiers_list();
     
//     foreach($t_zones as $a)
//     {
//         $t = '';
         
//         try
//         {
//             //this throws exception for 'US/Pacific-New'
//             $zone = new DateTimeZone($a);
             
//             $seconds = $zone->getOffset( new DateTime("now" , $zone) );
//             $hours = sprintf( "%+02d" , intval($seconds/3600));
//             $minutes = sprintf( "%02d" , ($seconds%3600)/60 );
     
//             $t = $a ."  [ $hours:$minutes ]" ;
             
//             $o[$a] = $t;
//         }
         
//         //exceptions must be catched, else a blank page
//         catch(Exception $e)
//         {
//             //die("Exception : " . $e->getMessage() . '<br />');
//             //what to do in catch ? , nothing just relax
//         }
//     }
     
//     ksort($o);
     
//     return $o;
// } 
 
// $o = get_timezones();
// ?>
 
 <html>
 <body>

 <?php
//     foreach($o as $tz => $label)
//     {
//         echo '<p value="'.$tz.'">'.$label.'</p>';
//     }
 ?>

 </body>
 </html>