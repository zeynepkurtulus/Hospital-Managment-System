<?php

    $URL = "https://cs-306-project-9b844-default-rtdb.firebaseio.com/chats.json";
    header("refresh: 60");

    function get_messages() { 
        global $URL;
        $ch = curl_init();
        curl_setopt_array($ch, [ CURLOPT_URL => $URL,
                                CURLOPT_POST => FALSE, // It will be a get request 
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_SSL_VERIFYPEER => false, ]);
        $response = curl_exec($ch); 
        curl_close($ch);
        return json_decode($response, true); 
    }

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

    $msg_res_json = get_messages();

    if (isset($_POST['usermsg']) || isset($_POST['usermsg1'])) {
        if (isset($_POST['usermsg'])) {
          $user_msg = $_POST['usermsg'];
          send_msg($user_msg, "Guest");
        } else {
          $user_msg1 = $_POST['usermsg1'];
          send_msg($user_msg1, "Admin");
        }
    echo $user_msg1;


      }
?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
</head>

<?php
$message = 'If not logged in, please log in!';

echo '<div class="box" style="width: 100px; height: 60px; border: 1px ; background-color: transparent;">';
echo '</div>';
echo '<div class="box" style="width: 220px; height: 30px; border: 1px ; background-color: rgb(135, 206, 250, 0.9);">';
echo $message;
echo '</div>';
?>

<?php
$link_url = 'http://localhost/hms/adminlogin.php';
$link_text = 'Admin Login Link';

echo '<div class="box" style="width: 220px; height: 30px; border: 1px ; background-color:  rgb(135, 206, 250, 0.9);">';
echo '<a href="' . $link_url . '" style="color: black;">' . $link_text . '</a>';
echo '</div>';
?>




<div class="menu">
<div class="back"><i class="fa fa-chevron-left"></i> <img src="https://i.imgur.com/DY6gND0.png" draggable="false"/></div>
<div class="name">Support Chat</div>
<div class="last"><?=date('D-m-y H:i')?></div>
</div>

<ol class="chat" style="text-align: right;">
<?php
	if($msg_res_json != null)
	{
		$keys = array_keys($msg_res_json);
		if($keys != null)
		{
			for ($i = 0; $i < count($keys); $i++){
				$chat_msg = $msg_res_json[$keys[$i]];
				$name = $chat_msg['name'];
				$msg = $chat_msg['msg'];
				$time = $chat_msg['time'];
                if ($name == "Guest") {
                    $from = 'self';
                    echo  '
               <li class="'.$from.'">
               <div class="avatar">
                        <img src="https://i.imgur.com/DY6gND0.png" draggable="false"/>
                    </div>
                        <div class="msg">
                            <p><b>'.$name.'</b></p>
                            <p>'.$msg.'</p>
                            <time>'.$time.'</time>
                        </div>
                    </li>';
                  }
			}
		}
	}
?>
</ol>

<ol class="chat" style="text-align: left;">
  <?php
  if($msg_res_json != null) {
    $keys = array_keys($msg_res_json);
    if($keys != null) {
      for ($i = 0; $i < count($keys); $i++){
        $chat_msg = $msg_res_json[$keys[$i]];
        $name = $chat_msg['name'];
        $time = $chat_msg['time'];
        $msg = $chat_msg['msg'];
        if ($name == "Admin") {
            $from = 'other';
            echo  '
       <li class="'.$from.'">
       <div class="avatar">
                <img src="https://i.imgur.com/DY6gND0.png" draggable="false"/>
            </div>
                <div class="msg">
                    <p><b>'.$name.'</b></p>
                    <p>'.$msg.'</p>
                    <time>'.$time.'</time>
                </div>
            </li>';
        }
      }
    }
  }
  ?>
</ol>

<form name="form" action = "chatpage.php" method="POST">
    <input name="usermsg1" class="textarea" type="text" placeholder="Type here!"/>
    <input type="submit" style="display: none" />
</form>





