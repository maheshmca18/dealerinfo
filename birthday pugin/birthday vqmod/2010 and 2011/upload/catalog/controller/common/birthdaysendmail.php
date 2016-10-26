<?php
class ControllerCommonBirthdaysendmail extends Controller {

    public function index()
    {

        $text_admin = 'Admin';
        $dbdate=date("Y-m-d");
        $this->load->model('account/birthdaysendmail');
	ini_set('max_execution_time', 300);
        $getbirthdaycustomerdetails = $this->model_account_birthdaysendmail->getbirthdaycustomerdetails($dbdate);
	$getbirthdaysettingdetails = $this->model_account_birthdaysendmail->getbirthdaysettingdetails($dbdate);

if($this->config->get('crondatevalue')<=$dbdate) {

	   $date = strtotime("+1 day", strtotime($dbdate));
            $datecronchange= date("Y-m-d", $date);
            $this->load->model('account/birthdaysendmail');
            $dbdatecron=array(
                'crondatevalue'=>$datecronchange);
            $this->model_account_birthdaysendmail->editSetting('crondate', $dbdatecron);
}

        if($this->config->get('crondatevalue')==$dbdate) {
	foreach ($getbirthdaysettingdetails as $databirthday) {
             foreach ($getbirthdaycustomerdetails as $data) {
                
                $datevalue = date("Y") . "-" . date("m-d", strtotime($data["Dateofbirth"]));
                $find = array('##firstname', '##lastname', '##store owner name');
                $replace = array($data['firstname'], $data['lastname'], $this->config->get('config_name'));
                $text = $databirthday['br_message'];
                $newtext = str_replace($find, $replace, $text);
                
                if ($databirthday['br_birthdayreminderstatus'] == 1) {

                    $msg = htmlspecialchars_decode(stripslashes($newtext));

                    $mail = new Mail($this->config->get('config_mail'));
                    $mail->setTo($data['email']);
                    $mail->setFrom($this->config->get('config_email'));
                    $mail->setSender($text_admin);
                    $mail->setSubject(sprintf($databirthday['br_subject']));
                    $mail->setHtml(html_entity_decode($msg, ENT_QUOTES, 'UTF-8'));

                    $mail->send();
	        }

            }


	    $subjectadmin="Today's ($dbdate) Birthday Remainder";
            $newdata = "Dear ".$this->config->get('config_owner').", <br>";
            $newdata .= " <br> The following customers celebrating their birthday on this day ($dbdate), <br> ";
            $newdata .= "<table>";
 	    $newdata .= "<tr><th>S.No</th><th>Name</th><th>Email</th></tr>";
			$i=1;

            foreach ($getbirthdaycustomerdetails as $data) {

                $newdata .= "<tr><td>".$i."</td><td>\t". $data['firstname'].$data['lastname'] ."</td><td>\t\t". $data['email'] ." </td>";
                $newdata .= "</tr> <br>";
		$i++;

            }
            $newdata .= "</table> <br><br>";
	    $newdata .= "Note: This is a system generated mailer by IRSSOFT Birthday Remainder";


            if ($databirthday['br_sendbCCtostoreowner'] == 1) {

                $msg = htmlspecialchars_decode(stripslashes($newdata));
                $mail = new Mail($this->config->get('config_mail'));
                $mail->setTo($this->config->get('config_email'));
                $mail->setFrom($this->config->get('config_email'));
                $mail->setSender($text_admin);
                $mail->setSubject(sprintf($subjectadmin));
                $mail->setHtml(html_entity_decode($msg, ENT_QUOTES, 'UTF-8'));

                $mail->send();
	     }

            $date = strtotime("+1 day", strtotime($dbdate));
            $datecronchange= date("Y-m-d", $date);
            $this->load->model('account/birthdaysendmail');
            $dbdatecron=array(
                'crondatevalue'=>$datecronchange);
            $this->model_account_birthdaysendmail->editSetting('crondate', $dbdatecron);
        }
       
}
    }

    }
?>

