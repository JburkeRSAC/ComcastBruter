<?php
$username = $argv[1];
$password = $argv[2];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://10.0.0.1/check.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$username&password=$password");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);
$Invalid_str = "Invalid";
function UsernameChecker($server_output, $username){
        $invalid_usrstr = "username!";
        if(strpos($server_output, $invalid_usrstr)){
                echo "Username Invalid\n";
                return 0;
        }else{
                echo "Username Valid\n";
                echo $username."\n";
                return 1;
        }
}
function PasswordChecker($server_output, $password){
        $invalid_passstr = "password!";
        if(strpos($server_output, $invalid_passstr)){
                echo "Password Invalid\n";
        }else{
                echo "Password Valid\n";
                echo $password."\n";
                return $server_output;
        }
}
if(strpos($server_output, $Invalid_str)){
        $checkone = UsernameChecker($server_output, $username);
        if($checkone === 1){
                $checktwo = PasswordChecker($server_output, $password);
                echo $checktwo."\n";
        }else{
                echo "try again\n";
        }
}else{
        print_r($server_output);
}
?>
