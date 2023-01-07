<?php 
	$url = $_SERVER['REQUEST_URI'];
		 
	// Use parse_url() function to parse the URL
	// and return an associative array which
	// contains its various components
	$url_components = parse_url($url);
	 
	// Use parse_str() function to parse the
	// string passed via URL
	parse_str($url_components['query'], $params);
	
	//Provide your firebase realtime db url, make sure you add your collection name 
	// with '.json' at the end for using Firebase API
    $URL = "https://cs-306-project-9b844-default-rtdb.firebaseio.com/chats.json";

	
	function send_msg($msg, $name) { 
        global $URL;
        $ch = curl_init();
        $msg_json = new stdClass();
        $msg_json->msg = $msg;
        $msg_json->name = $name;
        $msg_json->time = date('H:i');
        $encoded_json_obj = json_encode($msg_json); 
        curl_setopt_array($ch, array(CURLOPT_URL => $URL,
                                    CURLOPT_POST => TRUE,
                                    CURLOPT_RETURNTRANSFER => TRUE,
                                    CURLOPT_HTTPHEADER => array('Content-Type: application/json' ),
                                    CURLOPT_POSTFIELDS => $encoded_json_obj ));
        $response = curl_exec($ch); 
        return $response;
    }


    if (isset($_POST['usermsg'])) {
        $user_msg = $_POST['usermsg'];
        send_msg($user_msg, $params['sender']);
    }
	//Redirects to relative chat page, whether it is client or admin
	header('location: http://localhost/' . $params['sender'] .'_chat.php');
?>