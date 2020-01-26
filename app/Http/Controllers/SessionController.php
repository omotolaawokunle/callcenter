<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    //
    public static function ussd(Request $request){
    	$data= $request->all();
    	$session_codes = $request->text;
    	$split = explode('*', $session_codes);
    	if ($session_codes == '')
    	{
    		$response = "CON welcome to my app \n";
    		$response .= "1. check balance \n";
    		$response .= "2. transfer \n";
    		$response .= "3. airtime\n";
    	}

    	// $split[0] ==1
    	if (isset($split[0]) && $split[0] == 1 && !isset($split[1]) ){
    			$response = "END your account balance is \n";
	    		$response .= "$50 \n";
    	}elseif (
    		isset($split[0]) && $split[0] == 1 &&
    		 isset($split[1]) && $split[1] == 1 && !isset($split[2]))
    		{
    		$response = 'rer';
    	}elseif (isset($split[0]) && $split[0] == 2 && 
    		!isset($split[1])) {
    		$response = "CON tranfer: select bank \n";
    		$response .= "1. UBA \n";
    		$response .= "2. GTB \n";
    		$response .= "3. Diamond\n";
    		$response .= "3. Sterling\n";
    		$response .= "3. Union bank\n";
    	}
    	elseif (isset($split[0]) && $split[0] == 2 && 
    		isset($split[1]) && $split[1] == 1 && !isset($split[2])) {
    		$response = "CON tranfer: UBA \n";
    		$response .= "enter Acct no \n";
    	}
    	/*switch ($split[0]) {()
    		case 1:
    			$response = 'you chose 1';
    			break;
    		case 2:
    			$response = 'you chose 2';
    			break;
    		case 3:
    			$response = 'you chose 3';
    			break;
    		default:
    			# code...
    			break;
    	}*/
        header('Content-type: text/plain');
    	echo $response;
    }
}
