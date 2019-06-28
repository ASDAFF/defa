<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main,
	Bitrix\Main\Loader,
	Bitrix\Main\Application,
	Bitrix\Main\Web\Cookie,
	Bitrix\Main\Context;
\Bitrix\Main\Loader::IncludeModule("skyweb24.popuppro");
define("NO_KEEP_STATISTIC", true);
function addCookie(){
	$context = Application::getInstance()->getContext();
	$responce = $context->getResponse();
	$cookie = new Cookie("skyweb24PopupFilling_".$_REQUEST['idPopup'], 'Y', time()+864000000);
	$cookie->setDomain($context->getServer()->getHttpHost());
	$cookie->setHttpOnly(false);
	$responce->addCookie($cookie);
	$context->getResponse()->flush("");
}

function registerUser($mail, $props){
	global $USER;
	if(!empty($props['REGISTER_USER']) && $props['REGISTER_USER']=='Y'){
		if(!$USER->IsAuthorized()){
			$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), ['EMAIL'=>$mail]);
			if(!$rsUser = $rsUsers->Fetch()){
				$pass=randString(8, ["abcdefghijklnmopqrstuvwxyz", "ABCDEFGHIJKLNMOPQRSTUVWX­YZ", "0123456789"]);
				$tt=$USER->Register($mail, "", "", $pass, $pass, $mail);
			}
		}
	}
}

$popup=new popuppro;
$setting=$popup->getSetting($_REQUEST['idPopup']);
if($setting['row']['active']=='Y'){
	if(!empty($_REQUEST['type']) && $_REQUEST['type']=='checkemail' && !empty($_REQUEST['email'])){
		if(filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)){
			if(!empty($setting['view']['props']['EMAIL_NOT_NEW']) && $setting['view']['props']['EMAIL_NOT_NEW']=='Y'){
				$tmpStatus=$popup->searchinMailList($_REQUEST['email'],$_REQUEST['idPopup']);
				if($tmpStatus){
					addCookie();
					registerUser($_REQUEST['email'], $setting['view']['props']);
				}
				echo json_encode($tmpStatus);
			}else{
				echo json_encode(true);
				addCookie();
				registerUser($_REQUEST['email'], $setting['view']['props']);
			}
		}else{
			echo json_encode(false);
		}
		die();
	}elseif(!check_bitrix_sessid()){
		die("ACCESS_DENIED");
	}else{
		$res='';
		$email = '';
		if(isset($_REQUEST['nothing'])&&isset($_REQUEST['idPopup'])){
			addCookie();
			die();
		}
		if(isset($_REQUEST['email']))
			$email=$_REQUEST['email'];
		if(!isset($_REQUEST['addtotable'])){
			$res = $popup->getCoupon($_REQUEST['id'],$_REQUEST['avaliable'],$email,$_REQUEST['idPopup'],$_REQUEST['resultText']);
			echo $res;
			addCookie();
			die();
		}
		if(isset($_REQUEST['addtotable'])&&$_REQUEST['addtotable']!='Y'){
			$res = $popup->getCoupon($_REQUEST['id'],$_REQUEST['avaliable'],$email,$_REQUEST['idPopup'],$_REQUEST['resultText']);
			echo $res;
			addCookie();
			die();
		}
		if(isset($_REQUEST['email'])&&isset($_REQUEST['idPopup'])&&!empty($_REQUEST['type'])&&$_REQUEST['type']=='addMail'&&$_REQUEST['addtotable']=='Y'){
			$popup->insertToMailList($email,'',$_REQUEST['idPopup']);
		}
		elseif(isset($_REQUEST['email'])&&isset($_REQUEST['idPopup'])&&$_REQUEST['addtotable']=='Y'){
			if($_REQUEST['unique']=='Y'){
				if($popup->searchinMailList($email,$_REQUEST['idPopup'])){
					$res = $popup->getCoupon($_REQUEST['id'],$_REQUEST['avaliable'],$email,$_REQUEST['idPopup'],$_REQUEST['resultText']);
					$popup->insertToMailList($email,'',$_REQUEST['idPopup']);
					addCookie();
					echo $res;
				}else{
					echo 'not_unique';
				}
			}else{
				$res = $popup->getCoupon($_REQUEST['id'],$_REQUEST['avaliable'],$email,$_REQUEST['idPopup'],$_REQUEST['resultText']);
				$popup->insertToMailList($email,'',$_REQUEST['idPopup']);
				addCookie();
				echo $res;
			}
		}
	}
}else{
	echo 'not active window';
}

die();
