<?php
class ControllerCommonBirthdaysendmail extends Controller {

    public function index()
    {

        $text_admin = 'Admin';

        $dbdate=date("Y-m-d");

        $this->load->model('account/birthdaysendmail');

ini_set('max_execution_time', 300);

        $getdate = $this->model_account_birthdaysendmail->getbirthdaydetails($dbdate);


if($this->config->get('crondatevalue')<=$dbdate) {

 $date = strtotime("+1 day", strtotime($dbdate));
            $datecronchange= date("Y-m-d", $date);

            $this->load->model('account/birthdaysendmail');

            $dbdatecron=array(

                'crondatevalue'=>$datecronchange);

            $this->model_account_birthdaysendmail->editSetting('crondate', $dbdatecron);

}

        if($this->config->get('crondatevalue')==$dbdate) {


            foreach ($getdate as $data1) {
                $date = date("Y");
                $datevalue = $date . "-" . date("m-d", strtotime($data1["Dateofbirth"]));
                $todaydate = date("Y-m-d");

                $find = array('##firstname', '##lastname', '##store owner name');
                $replace = array($data1['firstname'], $data1['lastname'], $this->config->get('config_name'));
                $text = $data1['br_message'];
                if (isset($find) && isset($replace)) {
                    $newtext = str_replace($find, $replace, $text);
                }
                if ($data1['br_birthdayreminderstatus'] == 1) {


                    $msg = htmlspecialchars_decode(stripslashes($newtext));

                    //$tomail ='';
                    $mail = new Mail($this->config->get('config_mail'));
                    $mail->setTo($data1['email']);
                    $mail->setFrom($this->config->get('config_email'));
                    $mail->setSender($text_admin);
                    $mail->setSubject(sprintf($data1['br_subject']));
                    //$mail->setText(html_entity_decode($ms, ENT_QUOTES, 'UTF-8'));
                    $mail->setHtml(html_entity_decode($msg, ENT_QUOTES, 'UTF-8'));

                   /* $mail->protocol = $this->config->get('config_mail_protocol');
                    $mail->parameter = $this->config->get('config_mail_parameter');
                    $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
                    $mail->smtp_username = $this->config->get('config_mail_smtp_username');
                    $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
                    $mail->smtp_port = $this->config->get('config_mail_smtp_port');*/
                    //$mail->setTo($this->config->get('config_email'));


                    $mail->send();


                }

            }


		$subjectadmin="Today's ($dbdate) Birthday Remainder";

		$newdata = "Dear ".$this->config->get('config_owner').", <br>";
            $newdata .= " <br> The following customers celebrating their birthday on this day ($dbdate), <br> ";
            $newdata .= "<table>";
 	    $newdata .= "<tr><th>S.No</th><th>Name</th><th>Email</th></tr>";
			$i=1;
$sendcc="";
            foreach ($getdate as $data1) {


                $sendcc = $data1['br_sendbCCtostoreowner'];


                $newdata .= "<tr><td>".$i."</td><td>\t". $data1['firstname'].$data1['lastname'] ."</td><td>\t\t". $data1['email'] ." </td>";
                $newdata .= "</tr> <br>";
		$i++;

            }
            $newdata .= "</table> <br><br>";
		$newdata .= "Note: This is a system generated mailer by IRSSOFT Birthday Remainder";


            if ($sendcc == 1) {


                $msg = htmlspecialchars_decode(stripslashes($newdata));


                $mail = new Mail($this->config->get('config_mail'));
                $mail->setTo($this->config->get('config_email'));
                $mail->setFrom($this->config->get('config_email'));
                $mail->setSender($text_admin);
                $mail->setSubject(sprintf($subjectadmin));
                //$mail->setText(html_entity_decode($ms, ENT_QUOTES, 'UTF-8'));
                $mail->setHtml(html_entity_decode($msg, ENT_QUOTES, 'UTF-8'));

               /* $mail->protocol = $this->config->get('config_mail_protocol');
                $mail->parameter = $this->config->get('config_mail_parameter');
                $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
                $mail->smtp_username = $this->config->get('config_mail_smtp_username');
                $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
                $mail->smtp_port = $this->config->get('config_mail_smtp_port');*/

                $mail->send();


            }

            $date = strtotime("+1 day", strtotime($dbdate));
            $datecronchange= date("Y-m-d", $date);

            $this->load->model('account/birthdaysendmail');

            $dbdatecron=array(

                'crondatevalue'=>$datecronchange);

            $this->model_account_birthdaysendmail->editSetting('crondate', $dbdatecron);

        }
        else{
            echo "not equal";
        }

    }

    }
?>

