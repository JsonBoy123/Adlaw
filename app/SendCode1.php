<?php 
namespace App;
/**
 *  
 */
class SendCode1 
{
	
	public static function sendCode($sendData)
	{

        $ch = curl_init(); 

        curl_setopt($ch, CURLOPT_URL, 'http://login.yourbulksms.com/api/sendhttp.php?authkey=11456AxEiTIeN5ca87c66&mobiles='.$sendData['mobile'].'&message=' . rawurlencode($sendData['message']).'&sender=ADLAWS&route=4&country=91');

        $curl_scraped_page = curl_exec($ch);

        curl_close($ch);


        // $ch = curl_init();
        // curl_setopt_array($ch, array(
        // CURLOPT_URL => $url,
        // CURLOPT_RETURNTRANSFER =>true,        
        // ));

        // curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
        // curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);

        // $output = curl_exec($ch);

        // if(curl_errno($ch)){
        //         echo 'error :'. curl_error($ch);
        // }
        // curl_close($ch);





        return 'success';
	}
}