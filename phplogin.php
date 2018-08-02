<?php

include_once("check-login-status.php");

if($user_ok==true && $log_category=='doctor')
{
	header("location: edit-profile-dr.php");
}
if($user_ok==true && $log_category=='hospital')
{
    header("location: edit-profile-hos.php");
}
    if(isset($_POST['email']) && isset($_POST['password']))
    {
        $email = $_POST['email'];
        $password =md5($_POST['password']);
        $isfailed = 1;
        $ip=preg_replace('#^[0-9.]#', '', getenv('REMOTE_ADDR'));


        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if($email=='' || $password==''){
            echo "you kept empty field/s";
            exit();
        }
        else{

            $checkemail = test_input($email);
            //check Invalid email format"; 
            if (!filter_var($checkemail, FILTER_VALIDATE_EMAIL)) 
            {
                $username = $email;
                if(!empty($username) && !empty($password))
                {
                    $dquery = "SELECT * FROM doctors WHERE doctor_username='$username' AND doctor_password='$password'";
                    $dresult = mysqli_query($db_conx, $dquery);
                    //$dresult_query = mysqli_num_rows($dresult);
                    $drow = mysqli_fetch_assoc($dresult);
                    $dr_id = $drow['doctor_id'];
                    $dr_username = $drow['doctor_username'];
                    $dr_email = $drow['doctor_email'];
                    $dr_pass_str = $drow['doctor_password'];
                    $dr_activated = $drow['activated'];
                    
                    if($password != $dr_pass_str)
                    {
                        $hquery = "SELECT * FROM hospitals WHERE hospital_username='$username' AND hospital_password='$password'";
                        $hresult = mysqli_query($db_conx, $hquery);
                        //$hresult_query = mysqli_num_rows($hresult);
                        $hrow = mysqli_fetch_assoc($hresult);
                        $h_id = $hrow['hospital_id'];
                        $h_username = $hrow['hospital_username'];
                        $h_email = $hrow['hospital_email'];
                        $h_pass_str = $hrow['hospital_password'];
                        $h_activated = $hrow['activated'];

                        if($password != $h_pass_str){
                            $diaquery = "SELECT * FROM diagnostics WHERE diagnostic_username='$username' AND diagnostic_password='$password'";
                            $diaresult = mysqli_query($db_conx, $diaquery);
                            //$diaresult_query = mysql_num_rows($diaresult);
                            $diarow = mysqli_fetch_assoc($diaresult);
                            $dia_id = $diarow['diagnostic_id'];
                            $dia_username = $diarow['diagnostic_username'];
                            $dia_email = $diarow['diagnostic_email'];
                            $dia_pass_str = $diarow['diagnostic_password'];
                            $dia_activated = $diarow['activated'];
                            

                                if($password != $dia_pass_str){
                                $cquery = "SELECT * FROM companies WHERE company_username='$username' AND company_password='$password'";
                                $cresult = mysqli_query($db_conx, $cquery);
                                //$cresult_query = mysql_num_rows($cresult);
                                $crow = mysqli_fetch_assoc($cresult);
                                $c_id = $crow['company_id'];
                                $c_username = $crow['company_username'];
                                $c_email = $crow['company_email'];
                                $c_pass_str = $crow['company_password'];
                                $c_activated = $crow['activated'];
                                

                                if($password != $c_pass_str){
                                    $aquery = "SELECT * FROM ambulances WHERE ambulance_username='$username' AND ambulance_password='$password'";
                                    $aresult = mysqli_query($db_conx, $aquery);
                                    //$aresult_query = mysql_num_rows($aresult);
                                    $arow = mysqli_fetch_assoc($aresult);
                                    $a_id = $arow['ambulance_id'];
                                    $a_username = $arow['ambulance_username'];
                                    $a_email = $arow['ambulance_email'];
                                    $a_pass_str = $arow['ambulance_password'];
                                    $a_activated = $arow['activated'];
                                    
                                    if($password != $a_pass_str){
                                        echo 'wrong details';
                                        exit();

                                    }else if($password == $a_pass_str && $username == $a_username){
                                        $_SESSION['userid'] = $a_id;
                                        $_SESSION['username'] = $a_username;
                                        $_SESSION['email'] = $a_email;
                                        $_SESSION['password'] = $a_pass_str;
                                        $_SESSION['activated'] = $a_activated;
                                        $_SESSION['category'] = "ambulance";
                                        
                                        setcookie('id', $a_id, strtotime('+30 days'),"/","","",TRUE);
                                        setcookie('user', $a_username, strtotime('+30 days'),"/","","",TRUE);
                                        setcookie('mail', $a_email, strtotime('+30 days'),"/","","",TRUE);
                                        setcookie('pass', $a_pass_str, strtotime('+30 days'),"/","","",TRUE);
                                        setcookie('active', $a_activated, strtotime('+30 days'),"/","","",TRUE);
                                        setcookie('cat', "ambulance", strtotime('+30 days'),"/","","",TRUE);

                                        $asql = "UPDATE ambulances SET ip='$ip', lastlogin=NOW() WHERE ambulance_username='$a_username' LIMIT 1";
                                        $query = mysqli_query($db_conx,$asql);
                                        if($_SESSION['activated']==1){
                                            echo "success ambulance";
                                            exit();
                                            //header("Location: edit-profile-dr.php");
                                        }
                                        else{
                                            echo "not activate yet";
                                            exit();
                                            //header("Location: preregister.html");
                                        }
                                    }
                                }else if($password == $c_pass_str && $username == $c_username){
                                    $_SESSION['userid'] = $c_id;
                                    $_SESSION['username'] = $c_username;
                                    $_SESSION['email'] = $c_email;
                                    $_SESSION['password'] = $c_pass_str;
                                    $_SESSION['activated'] = $c_activated;
                                    $_SESSION['category'] = "company";

                                    setcookie('id', $c_id, strtotime('+30 days'),"/","","",TRUE);
                                    setcookie('user', $c_username, strtotime('+30 days'),"/","","",TRUE);
                                    setcookie('mail', $c_email, strtotime('+30 days'),"/","","",TRUE);
                                    setcookie('pass', $c_pass_str, strtotime('+30 days'),"/","","",TRUE);
                                    setcookie('active', $c_activated, strtotime('+30 days'),"/","","",TRUE);
                                    setcookie('cat', "company", strtotime('+30 days'),"/","","",TRUE);

                                    $sql = "UPDATE companies SET ip='$ip', lastlogin=NOW() WHERE company_username='$c_username' LIMIT 1";
                                    $query = mysqli_query($db_conx,$sql);
                                    if($_SESSION['activated']==1){
                                        echo "success company";
                                        exit();
                                        //header("Location: edit-profile-dr.php");
                                    }
                                    else{
                                            echo "not activate yet";
                                            exit();
                                            //header("Location: preregister.html");
                                    }
                                }
                            }else if($password == $dia_pass_str && $username == $dia_username){
                                $_SESSION['userid'] = $dia_id;
                                $_SESSION['username'] = $dia_username;
                                $_SESSION['email'] = $dia_email;
                                $_SESSION['password'] = $dia_pass_str;
                                $_SESSION['activated'] = $dia_activated;
                                $_SESSION['category'] = "diagnostic";

                                setcookie('id', $dia_id, strtotime('+30 days'),"/","","",TRUE);
                                setcookie('user', $dia_username, strtotime('+30 days'),"/","","",TRUE);
                                setcookie('mail', $dia_email, strtotime('+30 days'),"/","","",TRUE);
                                setcookie('pass', $dia_pass_str, strtotime('+30 days'),"/","","",TRUE);
                                setcookie('active', $dia_activated, strtotime('+30 days'),"/","","",TRUE);
                                setcookie('cat', "diagnostic", strtotime('+30 days'),"/","","",TRUE);

                                $sql = "UPDATE diagnostics SET ip='$ip', lastlogin=NOW() WHERE diagnostic_username='$dia_username' LIMIT 1";
                                $query = mysqli_query($db_conx,$sql);
                                if($_SESSION['activated']==1){
                                    echo "success diagnostic";
                                    exit();
                                    //header("Location: edit-profile-dr.php");
                                }
                                else{
                                    echo "not activate yet";
                                    exit();
                                            //header("Location: preregister.html");
                                }
                                //echo $dia_username;
                                //echo "success";
                                //exit();
                            }
                        }else if($password == $h_pass_str && $username == $h_username){
                            $_SESSION['userid'] = $h_id;
                            $_SESSION['username'] = $h_username;
                            $_SESSION['email'] = $h_email;
                            $_SESSION['password'] = $h_pass_str;
                            $_SESSION['activated'] = $h_activated;
                            $_SESSION['category'] = "hospital";

                            setcookie('id', $h_id, strtotime('+30 days'),"/","","",TRUE);
                            setcookie('user', $h_username, strtotime('+30 days'),"/","","",TRUE);
                            setcookie('mail', $h_email, strtotime('+30 days'),"/","","",TRUE);
                            setcookie('pass', $h_pass_str, strtotime('+30 days'),"/","","",TRUE);
                            setcookie('active', $h_activated, strtotime('+30 days'),"/","","",TRUE);
                            setcookie('cat', "hospital", strtotime('+30 days'),"/","","",TRUE);

                            $sql = "UPDATE hospitals SET ip='$ip', lastlogin=NOW() WHERE hospital_username='$h_username' LIMIT 1";
                            $query = mysqli_query($db_conx,$sql);
                            if($_SESSION['activated']){
                                echo "success hospital";
                                //header("Location: edit-profile-hos.php");
                                exit();
                                
                            }
                            else{
                                echo "not activate yet";
                                exit();
                                            //header("Location: preregister.html");
                            }
                            //echo $h_username;
                            //echo "success";
                            //exit();
                        }
                    }else if($password == $dr_pass_str && $username == $dr_username){
                        $_SESSION['userid'] = $dr_id;
                        $_SESSION['username'] = $dr_username;
                        $_SESSION['email'] = $dr_email;
                        $_SESSION['password'] = $dr_pass_str;
                        $_SESSION['activated'] = $dr_activated;
                        $_SESSION['category'] = "doctor";

                        setcookie('id', $dr_id, strtotime('+30 days'),"/","","",TRUE);
                        setcookie('user', $dr_username, strtotime('+30 days'),"/","","",TRUE);
                        setcookie('mail', $dr_email, strtotime('+30 days'),"/","","",TRUE);
                        setcookie('pass', $dr_pass_str, strtotime('+30 days'),"/","","",TRUE);
                        setcookie('active', $dr_activated, strtotime('+30 days'),"/","","",TRUE);
                        setcookie('cat', "doctor", strtotime('+30 days'),"/","","",TRUE);

                        $sql = "UPDATE doctors SET ip='$ip', lastlogin=NOW() WHERE doctor_username='$dr_username' LIMIT 1";
                        $query = mysqli_query($db_conx,$sql);
                        if($_SESSION['activated']==1){
                            echo "success doctor";
                            //header("Location: edit-profile-dr.php");
                            exit();
                            
                        }
                        else if($dr_activated==0){
                            echo "not activate yet";
                            exit();
                            //header("Location: preregister.html");
                        }
                        //$row=mysqli_affected_rows($query);
                        //$last=$row[1];
                        //echo $dr_username;
                        if (mysql_error()) 
                            print 'An Error found';
                        //echo $row;
                        //echo $dr_username;
                        //echo "success";
                        exit();
                    }
                }
            }

            else{
                if(!empty($email) && !empty($password))
                {
                    
                    $dquery = "SELECT * FROM doctors WHERE doctor_email='$email' AND doctor_password='$password'";
                    $dresult = mysqli_query($db_conx, $dquery);
                    //$dresult_query = mysqli_num_rows($dresult);
                    $drow = mysqli_fetch_assoc($dresult);
                    $dr_id = $drow['doctor_id'];
                    $dr_username = $drow['doctor_username'];
                    $dr_email = $drow['doctor_email'];
                    $dr_pass_str = $drow['doctor_password'];
                    $dr_activated = $drow['activated'];
                    
                    if($password != $dr_pass_str)
                    {
                        $hquery = "SELECT * FROM hospitals WHERE hospital_email='$email' AND hospital_password='$password'";
                        $hresult = mysqli_query($db_conx, $hquery);
                        //$hresult_query = mysqli_num_rows($hresult);
                        $hrow = mysqli_fetch_assoc($hresult);
                        $h_id = $hrow['hospital_id'];
                        $h_username = $hrow['hospital_username'];
                        $h_email = $hrow['hospital_email'];
                        $h_pass_str = $hrow['hospital_password'];
                        $h_activated = $hrow['activated'];

                        if($password != $h_pass_str){
                            $diaquery = "SELECT * FROM diagnostics WHERE diagnostic_email='$email' AND diagnostic_password='$password'";
                            $diaresult = mysqli_query($db_conx, $diaquery);
                            //$diaresult_query = mysql_num_rows($diaresult);
                            $diarow = mysqli_fetch_assoc($diaresult);
                            $dia_id = $diarow['diagnostic_id'];
                            $dia_username = $diarow['diagnostic_username'];
                            $dia_email = $diarow['diagnostic_email'];
                            $dia_pass_str = $diarow['diagnostic_password'];
                            $dia_activated = $diarow['activated'];

                                if($password != $dia_pass_str){
                                $cquery = "SELECT * FROM companies WHERE company_email='$email' AND company_password='$password'";
                                $cresult = mysqli_query($db_conx, $cquery);
                                //$cresult_query = mysql_num_rows($cresult);
                                $crow = mysqli_fetch_assoc($cresult);
                                $c_id = $crow['company_id'];
                                $c_username = $crow['company_username'];
                                $c_email = $crow['company_email'];
                                $c_pass_str = $crow['company_password'];
                                $c_activated = $crow['activated'];

                                if($password != $c_pass_str){
                                    $aquery = "SELECT * FROM ambulances WHERE ambulance_email='$email' AND ambulance_password='$password'";
                                    $aresult = mysqli_query($db_conx, $aquery);
                                    //$aresult_query = mysql_num_rows($aresult);
                                    $arow = mysqli_fetch_assoc($aresult);
                                    $a_id = $arow['ambulance_id'];
                                    $a_username = $arow['ambulance_username'];
                                    $a_email = $arow['ambulance_email'];
                                    $a_pass_str = $arow['ambulance_password'];
                                    $a_activated = $arow['activated'];

                                    if($password != $a_pass_str){
                                        echo 'wrong details';
                                        exit();
                                    }

                                    else if($password == $a_pass_str && $email == $a_email){
                                        $_SESSION['userid'] = $a_id;
                                        $_SESSION['username'] = $a_username;
                                        $_SESSION['email'] = $a_email;
                                        $_SESSION['password'] = $a_pass_str;
                                        $_SESSION['activated'] = $a_activated;
                                        $_SESSION['category'] = "ambulance";

                                        setcookie('id', $a_id, strtotime('+30 days'),"/","","",TRUE);
                                        setcookie('user', $a_username, strtotime('+30 days'),"/","","",TRUE);
                                        setcookie('mail', $a_email, strtotime('+30 days'),"/","","",TRUE);
                                        setcookie('pass', $a_pass_str, strtotime('+30 days'),"/","","",TRUE);
                                        setcookie('active', $a_activated, strtotime('+30 days'),"/","","",TRUE);
                                        setcookie('cat', "ambulance", strtotime('+30 days'),"/","","",TRUE);

                                        $sql = "UPDATE ambulances SET ip='$ip', lastlogin=NOW() WHERE ambulance_username='$a_username' LIMIT 1";
                                        $query = mysqli_query($db_conx,$sql);
                                        if($_SESSION['activated']==1){
                                            echo "success ambulance";
                                            exit();
                                            //header("Location: edit-profile-dr.php");
                                        }
                                        else{
                                            echo "not activate yet";
                                            exit();
                                            //header("Location: preregister.html");
                                        }
                                        //echo $a_username;
                                        //echo "success";
                                        exit();
                                    }
                                }else if($password == $c_pass_str && $email == $c_email){
                                    $_SESSION['userid'] = $c_id;
                                    $_SESSION['username'] = $c_username;
                                    $_SESSION['email'] = $c_email;
                                    $_SESSION['password'] = $c_pass_str;
                                    $_SESSION['activated'] = $c_activated;
                                    $_SESSION['category'] = "company";

                                    setcookie('id', $c_id, strtotime('+30 days'),"/","","",TRUE);
                                    setcookie('user', $c_username, strtotime('+30 days'),"/","","",TRUE);
                                    setcookie('mail', $c_email, strtotime('+30 days'),"/","","",TRUE);
                                    setcookie('pass', $c_pass_str, strtotime('+30 days'),"/","","",TRUE);
                                    setcookie('active', $c_activated, strtotime('+30 days'),"/","","",TRUE);
                                    setcookie('cat', "company", strtotime('+30 days'),"/","","",TRUE);

                                    $sql = "UPDATE companies SET ip='$ip', lastlogin=NOW() WHERE company_username='$c_username' LIMIT 1";
                                    $query = mysqli_query($db_conx,$sql);
                                    //echo $c_username;
                                    if($_SESSION['activated']==1){
                                        echo "success company";
                                        exit();
                                        //header("Location: edit-profile-dr.php");
                                    }
                                    else{
                                        echo "not activate yet";
                                        exit();
                                        //header("Location: preregister.html");
                                    }
                                }
                            }else if($password == $dia_pass_str && $email == $dia_email){
                                $_SESSION['userid'] = $dia_id;
                                $_SESSION['username'] = $dia_username;
                                $_SESSION['email'] = $dia_email;
                                $_SESSION['password'] = $dia_pass_str;
                                $_SESSION['activated'] = $dia_activated;
                                $_SESSION['category'] = "diagnostic";

                                setcookie('id', $dia_id, strtotime('+30 days'),"/","","",TRUE);
                                setcookie('user', $dia_username, strtotime('+30 days'),"/","","",TRUE);
                                setcookie('mail', $dia_email, strtotime('+30 days'),"/","","",TRUE);
                                setcookie('pass', $dia_pass_str, strtotime('+30 days'),"/","","",TRUE);
                                setcookie('active', $dia_activated, strtotime('+30 days'),"/","","",TRUE);
                                setcookie('cat', "diagnostic", strtotime('+30 days'),"/","","",TRUE);

                                $sql = "UPDATE diagnostics SET ip='$ip', lastlogin=NOW() WHERE diagnostic_username='$dia_username' LIMIT 1";
                                $query = mysqli_query($db_conx,$sql);
                                //echo $dia_username;
                                if($_SESSION['activated']==1){
                                    echo "success diagnostic";
                                    exit();
                                    //header("Location: edit-profile-dr.php");
                                }else{
                                    echo "not activate yet";
                                    exit();
                                    //header("Location: preregister.html");
                                }
                            }
                        }else if($password == $h_pass_str && $email == $h_email){
                            $_SESSION['userid'] = $h_id;
                            $_SESSION['username'] = $h_username;
                            $_SESSION['email'] = $h_email;
                            $_SESSION['password'] = $h_pass_str;
                            $_SESSION['activated'] = $h_activated;
                            $_SESSION['category'] = "hospital";

                            setcookie('id', $h_id, strtotime('+30 days'),"/","","",TRUE);
                            setcookie('user', $h_username, strtotime('+30 days'),"/","","",TRUE);
                            setcookie('mail', $h_email, strtotime('+30 days'),"/","","",TRUE);
                            setcookie('pass', $h_pass_str, strtotime('+30 days'),"/","","",TRUE);
                            setcookie('active', $h_activated, strtotime('+30 days'),"/","","",TRUE);
                            setcookie('cat', "hospital", strtotime('+30 days'),"/","","",TRUE);

                            $sql = "UPDATE hospitals SET ip='$ip', lastlogin=NOW() WHERE hospital_username='$h_username' LIMIT 1";
                            $query = mysqli_query($db_conx,$sql);
                            //echo $h_username;
                            if($_SESSION['activated']==1){
                                echo "success hospital";
                                exit();
                                //header("Location: edit-profile-dr.php");
                            }
                            else{
                                echo "not activate yet";
                                exit();
                                //header("Location: preregister.html");
                            }
                        }
                    }else if($password == $dr_pass_str && $email == $dr_email){
                        $_SESSION['userid'] = $dr_id;
                        $_SESSION['username'] = $dr_username;
                        $_SESSION['email'] = $dr_email;
                        $_SESSION['password'] = $dr_pass_str;
                        $_SESSION['activated'] = $dr_activated;
                        $_SESSION['category'] = "doctor";

                        setcookie('id', $dr_id, strtotime('+30 days'),"/","","",TRUE);
                        setcookie('user', $dr_username, strtotime('+30 days'),"/","","",TRUE);
                        setcookie('mail', $dr_email, strtotime('+30 days'),"/","","",TRUE);
                        setcookie('pass', $dr_pass_str, strtotime('+30 days'),"/","","",TRUE);
                        setcookie('active', $dr_activated, strtotime('+30 days'),"/","","",TRUE);
                        setcookie('cat', "doctor", strtotime('+30 days'),"/","","",TRUE);

                        $sql = "UPDATE doctors SET ip='$ip', lastlogin=NOW() WHERE doctor_username='$dr_username' LIMIT 1";
                        $query = mysqli_query($db_conx,$sql);
                        if($_SESSION['activated']==1){
                            echo "success doctor";
                            exit();
                            //header("Location: edit-profile-dr.php");
                        }else{
                            echo "not activate yet";
                            exit();
                            //header("Location: preregister.html");
                        }
                    }else{
                        echo "an error found";
                        exit();
                    }
                }
            }
        }

    }

?>
