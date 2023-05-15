<?php   
        //MONNIFY OFFLINE PAYMENT   
        $data = json_decode(file_get_contents('php://input'), true);
        if($data)
        {
            $param1=$data['productCode'];
            $param2=$data['paymentRecipientId'];
              
            $theurl="https://bespoque.dev/quickpay-live/processpayment.php"; 
            $data = json_encode(array(
            "productCode" =>  $param1, 
            "paymentRecipientId" =>$param2
            ));
             
           //  print_r($data);
                  
            $headers[] = 'Accept: application/json';
            $headers[] = 'Content-Type: application/json';
            //$headers[] = 'Authorization: '.CREDO_PUBLICKEY;
              
            $ch=curl_init();
            curl_setopt($ch, CURLOPT_URL, $theurl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');   
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
            $results=curl_exec($ch);  
            curl_close($ch); 
            
            header("Content-Type: application/json");
            echo $results;
             
         } 
         else
         {
              $results['responseCode']="02";
              $results['responseMessage']="Reference not sent";           
         }
         
 
?>