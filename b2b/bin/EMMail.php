<?php

class EMMail
{
	protected static $_s_to_override		=null;
	protected static $_s_to_add				=null;
	
	protected static $_s_cc					=null;
	protected static $_s_cc_override		=null;
	protected static $_s_cc_add				=null;
	
	protected static $_s_bcc				=null;
	protected static $_s_bcc_override		=null;
	protected static $_s_bcc_add			=null;
	
	protected static $_s_from				=null;
	protected static $_s_from_override		=null;
	
	protected static $_s_reply_to			=null;
	protected static $_s_reply_to_override	=null;
	
	protected static $_s_Host				=null;
	protected static $_s_SMTPAuth			=null;
	protected static $_s_SMTPSecure			=null;
	protected static $_s_Port				=null;
	protected static $_s_Username			=null;
	protected static $_s_Password			=null;

	public static function settings(
		$Host			=null,$SMTPAuth				=null,$SMTPSecure	=null,
		$Port			=null,$Username				=null,$Password		=null,
		$to_override	=null,$to_add				=null,
		$cc				=null,$cc_override			=null,$cc_add		=null,
		$bcc			=null,$bcc_override			=null,$bcc_add		=null,
		$from			=null,$from_override		=null,
		$reply_to		=null,$reply_to_override	=null
	)
	{
		static::$_s_to_override			=$to_override;
		static::$_s_to_add				=$to_add;

		static::$_s_cc					=$cc;
		static::$_s_cc_override			=$cc_override;
		static::$_s_cc_add				=$cc_add;

		static::$_s_bcc					=$bcc;
		static::$_s_bcc_override		=$bcc_override;
		static::$_s_bcc_add				=$bcc_add;

		static::$_s_from				=$from;
		static::$_s_from_override		=$from_override;

		static::$_s_reply_to			=$reply_to;
		static::$_s_reply_to_override	=$reply_to_override;
		
		static::$_s_Host				=$Host;
		static::$_s_SMTPAuth			=$SMTPAuth;
		static::$_s_SMTPSecure			=$SMTPSecure;
		static::$_s_Port				=$Port;
		static::$_s_Username			=$Username;
		static::$_s_Password			=$Password;
	}
	
	public static function settings_smtp(
		$Host			=null,$SMTPAuth				=null,$SMTPSecure	=null,
		$Port			=null,$Username				=null,$Password		=null
	){
		static::$_s_Host				=$Host;
		static::$_s_SMTPAuth			=$SMTPAuth;
		static::$_s_SMTPSecure			=$SMTPSecure;
		static::$_s_Port				=$Port;
		static::$_s_Username			=$Username;
		static::$_s_Password			=$Password;
	}
	
	public static function settings_add(
		$to_add=null,$cc_add=null,$bcc_add=null
	){
		static::$_s_to_add	=$to_add;
		static::$_s_cc_add	=$cc_add;
		static::$_s_bcc_add	=$bcc_add;
	}

	/**
	 * 
	 * @param type $to_override
	 * @param type $cc_override
	 * @param type $bcc_override
	 * @param type $from_override
	 * @param type $reply_to_override
	 */
	public static function settings_override(
		$to_override	=null,$cc_override			=null,$bcc_override		=null,
		$from_override	=null,$reply_to_override	=null
	){
		static::$_s_to_override			=$to_override;
		static::$_s_cc_override			=$cc_override;
		static::$_s_bcc_override		=$bcc_override;
		static::$_s_from_override		=$from_override;
		static::$_s_reply_to_override	=$reply_to_override;
	}
	
	protected static $_s_log_obj=null;
	public static function settings_log(EMDailyLog $EMDailyLog){
		static::$_s_log_obj=$EMDailyLog;
	}

	protected $_mail				=null;
	
	protected $_to_override			=null;
	protected $_to_add				=null;
	
	protected $_cc					=null;
	protected $_cc_override			=null;
	protected $_cc_add				=null;
	
	protected $_bcc					=null;
	protected $_bcc_override		=null;
	protected $_bcc_add				=null;
	
	protected $_from				=null;
	protected $_from_override		=null;
	
	protected $_reply_to			=null;
	protected $_reply_to_override	=null;
	
	/**
	 *
	 * @var type EMDailyLog
	 */
	protected $_log_obj				=null;
	
	protected $_Host				=null;
	protected $_SMTPAuth			=null;
	protected $_SMTPSecure			=null;
	protected $_Port				=null;
	protected $_Username			=null;
	protected $_Password			=null;
	
	public function __construct(
		$Host			=null,$SMTPAuth				=null,$SMTPSecure	=null,
		$Port			=null,$Username				=null,$Password		=null,
		$to_override	=null,$to_add				=null,
		$cc				=null,$cc_override			=null,$cc_add		=null,
		$bcc			=null,$bcc_override			=null,$bcc_add		=null,
		$from			=null,$from_override		=null,
		$reply_to		=null,$reply_to_override	=null,$EMDailyLog	=null
	)
	{
		$this->_to_override			=$to_override			===null?$this::$_s_to_override			:$to_override;
		$this->_to_add				=$to_add				===null?$this::$_s_to_add				:$to_add;
		$this->_cc					=$cc					===null?$this::$_s_cc					:$cc;
		$this->_cc_override			=$cc_override			===null?$this::$_s_cc_override			:$cc_override;
		$this->_cc_add				=$cc_add				===null?$this::$_s_cc_add				:$cc_add;
		$this->_bcc					=$bcc					===null?$this::$_s_bcc					:$bcc;
		$this->_bcc_override		=$bcc_override			===null?$this::$_s_bcc_override			:$bcc_override;
		$this->_bcc_add				=$bcc_add				===null?$this::$_s_bcc_add				:$bcc_add;
		$this->_from				=$from					===null?$this::$_s_from					:$from;
		$this->_from_override		=$from_override			===null?$this::$_s_from_override		:$from_override;
		$this->_reply_to			=$reply_to				===null?$this::$_s_reply_to				:$reply_to;
		$this->_reply_to_override	=$reply_to_override		===null?$this::$_s_reply_to_override	:$reply_to_override;
		
		$this->_log_obj				=$EMDailyLog			===null?$this::$_s_log_obj				:$EMDailyLog;
		
		$this->_Host				=$Host					===null?$this::$_s_Host					:$Host;
		$this->_SMTPAuth			=$SMTPAuth				===null?$this::$_s_SMTPAuth				:$SMTPAuth;
		$this->_SMTPSecure			=$SMTPSecure			===null?$this::$_s_SMTPSecure			:$SMTPSecure;
		$this->_Port				=$Port					===null?$this::$_s_Port					:$Port;
		$this->_Username			=$Username				===null?$this::$_s_Username				:$Username;
		$this->_Password			=$Password				===null?$this::$_s_Password				:$Password;
	}

	/*
	protected function _to($to)
	{
		if($this->_to_override!==null){
			$this->_log("to header override:");
			return $this->_to_override;
		}
		if($to!==null){
			$this->_log("to header call:");
			if(is_array($to)){
				$ret=$to;
			}else{
				$ret=array();
				$ret[]=$to;
			}
		}
		$this->_log("to header set:");
		$this->_phpmailer_addAddress_mixed($this->_to_add);
		return $ret;
	}
	 * 
	 */
	
	/**
	 * no override for the moment
	 * @param type $to
	 * @param type $subject
	 * @param type $html
	 * @param type $txt
	 * @param type $from
	 * @param type $reply_to
	 * @param type $cc
	 * @param type $bcc
	 * @return type
	 */
	public function send_email_custom($to,$subject,$html,$txt,$from=null,$reply_to=null,$cc=null,$bcc=null)
	{
		//create a boundary for the email. This 
		$boundary=uniqid('np');
		$headers=array();
		$headers[]='MIME-Version: 1.0';
		
		if($from!==null){
			$headers[]="From: {$from}";
		}
		
		if(!is_array($to)){
			$to=array($to);
		}
		$to=implode(', ',$to);
		$headers[]="To: {$to}";
		
		if($cc!==null){
			if(!is_array($cc)){
				$cc=array($cc);
			}
			$cc=implode(', ',$cc);
			$headers[]="Cc: {$cc}";
		}

		if($bcc!==null){
			if(!is_array($bcc)){
				$bcc=array($bcc);
			}
			$bcc=implode(', ',$bcc);
			$headers[]="Bcc: {$bcc}";
		}
		
		$headers[]="Content-Type: multipart/alternative;boundary={$boundary}";
		
		$message=array();
		$message[]="This is a multi-part message in MIME format.";
		
		$message[]='';
		$message[]="--{$boundary}";
		$message[]='Content-Type: text/plain;charset="iso-8859-1"';
		$message[]='Content-Transfer-Encoding: 7bit';
		$message[]='';
		$message[]=$txt;
		
		$message[]='';
		$message[]="--{$boundary}";
		$message[]='Content-type: text/html;charset="iso-8859-1"';
		$message[]='Content-Transfer-Encoding: quoted-printable';
		$message[]='';
		$message[]=$html;
		$message[]='';
		
		$headers=implode("\r\n",$headers);
		$message=implode("\r\n",$message);
		$this->_log("subject is {$subject}");
		$this->_log("headers are {$headers}");
		$this->_log("message is {$message}");

		return mail('',$subject,$message,$headers);
	}

	/**
	 * 
	 * @param type $to
	 * @param type $subject
	 * @param type $html
	 * @param type $txt
	 * @param type $from
	 * @param type $reply_to
	 * @param type $cc
	 * @param type $bcc
	 * @return boolean
	 */
	public function send_email($to,$subject,$html,$txt,$from=null,$reply_to=null,$cc=null,$bcc=null){
		$this->_log('starting...');
		
		$this->_phpmailer($to,$from,$reply_to,$cc,$bcc);
		
		$this->_mail->IsHTML(true);
		$this->_log('body is '.substr($html,0,1000).'...');
		$this->_mail->Body=$html;
		$this->_log('altbody is '.substr($txt,0,500).'...');
		$this->_mail->AltBody=$txt;
		$this->_log("subject is {$subject}");
		$this->_mail->Subject=$subject;

		if(!$this->_mail->send()){
			$this->_log("end: error: {$this->_mail->ErrorInfo}");
			return false;
		}
		$this->_log("end: success");
		return true;
	}
	
	protected function _log($msg){
		if($this->_log_obj===null){
			return;
		}
		$this->_log_obj->log($msg);
	}

	protected function _break_address_name($email){
		preg_match('#<.*?>#',$email,$matches);
		if(empty($matches)){
			return array(
				'email'=>$email,
				'name'=>'',
			);
		}
		return array(
			'email'=>substr($matches[0],1,-1),
			'name'=>trim(str_replace($matches[0],'',$email)),
		);
	}
	
	protected function _phpmailer_addBCC($bcc){
		if($this->_bcc_override!==null){
			$this->_log("bcc header override:");
			$this->_phpmailer_addBCC_mixed($this->_bcc_override);
			return;
		}
		if($bcc!==null){
			$this->_log("bcc header call:");
			$this->_phpmailer_addBCC_mixed($bcc);
		}
		$this->_log("bcc header set:");
		$this->_phpmailer_addBCC_mixed($this->_bcc_add);
	}

	protected function _phpmailer_addCC($cc){
		if($this->_cc_override!==null){
			$this->_log("cc header override:");
			$this->_phpmailer_addCC_mixed($this->_cc_override);
			return;
		}
		if($cc!==null){
			$this->_log("cc header call:");
			$this->_phpmailer_addCC_mixed($cc);
		}
		$this->_log("cc header set:");
		$this->_phpmailer_addCC_mixed($this->_cc_add);
	}

	protected function _phpmailer_addReplyTo($reply_to){
		if($this->_reply_to_override!==null){
			$this->_log("reply-to header override: {$this->_reply_to_override}");
			$tmp=$this->_break_address_name($this->_reply_to_override);
			$this->_mail->addReplyTo($tmp['email'],$tmp['name']);
			return;
		}
		if($reply_to!==null){
			$this->_log("reply-to header call: {$reply_to}");
			$tmp=$this->_break_address_name($reply_to);
			$this->_mail->addReplyTo($tmp['email'],$tmp['name']);
			return;
		}
		if($this->_reply_to!==null){
			$this->_log("reply-to header set: {$this->_reply_to}");
			$tmp=$this->_break_address_name($this->_reply_to);
			$this->_mail->addReplyTo($tmp['email'],$tmp['name']);
			return;
		}
	}

	protected function _phpmailer_setFrom($from){
		if($this->_from_override!==null){
			$this->_log("from header override: {$this->_from_override}");
			$tmp=$this->_break_address_name($this->_from_override);
			$this->_mail->setFrom($tmp['email'],$tmp['name']);
			return;
		}
		if($from!==null){
			$this->_log("from header call: {$from}");
			$tmp=$this->_break_address_name($from);
			$this->_mail->setFrom($tmp['email'],$tmp['name']);
			return;
		}
		if($this->_from!==null){
			$this->_log("from header set: {$this->from}");
			$tmp=$this->_break_address_name($this->_from);
			$this->_mail->setFrom($tmp['email'],$tmp['name']);
			return;
		}
	}
	
	protected function _phpmailer_addAddress($to){
		if($this->_to_override!==null){
			$this->_log("to header override:");
			$this->_phpmailer_addAddress_mixed($this->_to_override);
			return;
		}
		if($to!==null){
			$this->_log("to header call:");
			$this->_phpmailer_addAddress_mixed($to);
		}
		$this->_log("to header set:");
		$this->_phpmailer_addAddress_mixed($this->_to_add);
	}
	
	protected function _phpmailer_addAddress_mixed($add){
		if(!is_array($add)){
			$this->_log($add);
			$tmp=$this->_break_address_name($add);
			$this->_mail->addAddress($tmp['email'],$tmp['name']);
			return;
		}
		foreach($add as $tmp){
			$tmp=$this->_break_address_name($tmp);
			$this->_mail->addAddress($tmp['email'],$tmp['name']);
		}
	}

	protected function _phpmailer_addCC_mixed($add){
		if(!is_array($add)){
			$this->_log($add);
			$tmp=$this->_break_address_name($add);
			$this->_mail->addCC($tmp['email'],$tmp['name']);
			return;
		}
		foreach($add as $tmp){
			$tmp=$this->_break_address_name($tmp);
			$this->_mail->addCC($tmp['email'],$tmp['name']);
		}
	}

	protected function _phpmailer_addBCC_mixed($add){
		if(!is_array($add)){
			$this->_log($add);
			$tmp=$this->_break_address_name($add);
			$this->_mail->addBCC($tmp['email'],$tmp['name']);
			return;
		}
		foreach($add as $tmp){
			$tmp=$this->_break_address_name($tmp);
			$this->_mail->addBCC($tmp['email'],$tmp['name']);
		}
	}

	protected function _phpmailer($to,$from,$reply_to,$cc,$bcc)
	{
		$this->_mail=new PHPMailer();
		if($this->_Host===null){
			$this->_log('using php mail');
			$this->_mail->isMail();
		}else{
			$this->_log("using smtp {$this->_Host} / {$this->_Username}");
			$this->_mail->Host			=$this->_Host;
			$this->_mail->SMTPAuth		=$this->_SMTPAuth;
			$this->_mail->SMTPSecure	=$this->_SMTPSecure;
			$this->_mail->Port			=$this->_Port;
			$this->_mail->Username		=$this->_Username;
			$this->_mail->Password		=$this->_Password;
			$this->_mail->IsSMTP();
		}
		
		$this->_phpmailer_addAddress($to);
		$this->_phpmailer_setFrom($from);
		$this->_phpmailer_addReplyTo($reply_to);
		$this->_phpmailer_addCC($cc);
		$this->_phpmailer_addBCC($bcc);
	}

}