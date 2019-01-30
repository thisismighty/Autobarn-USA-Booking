<?php

class DataBookingConfirmation extends MySQLi
{
	protected $_table='';
	protected static $_s_table='';
	protected static $_s_host='';
	protected static $_s_user='';
	protected static $_s_pass='';
	protected static $_s_db='';

	public static function settings($table,$host,$user,$pass,$db)
	{
		static::$_s_table=$table;
		static::$_s_host=$host;
		static::$_s_user=$user;
		static::$_s_pass=$pass;
		static::$_s_db=$db;
	}

	public function __construct($table=null,$host=null,$user=null,$pass=null,$db=null)
	{
		parent::__construct(
			$host===null?$this::$_s_host:$host,
			$user===null?$this::$_s_user:$user,
			$pass===null?$this::$_s_pass:$pass,
			$db===null?$this::$_s_db:$db
		);
		if(mysqli_connect_error()){
			die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
		}
		$this->_table=$this->real_escape_string($table===null?$this::$_s_table:$table);
		$this->create_table();
	}

	public function create_table()
	{
		return $this->query("
CREATE TABLE IF NOT EXISTS `{$this->_table}` (
	`id`					int unsigned not null primary key auto_increment,
	`confirmation`			tinytext,
	`agentemail`			tinytext,
	`email_cancelled_html`	mediumtext,
	`email_cancelled_txt`	mediumtext,
	`email_html`			mediumtext,
	`email_txt`				mediumtext,
	`screen_cancelled`		mediumtext,
	`screen_email_sent`		mediumtext,
	`screen`				mediumtext
)");
}

	public function insert(
		$confirmation,$agentemail,
		$email_cancelled_html,
		$email_cancelled_txt,
		$email_html,
		$email_txt,
		$screen_cancelled,
		$screen_email_sent,
		$screen
	){
		$confirmation=$this->real_escape_string($confirmation);
		$try=$this->query("SELECT count(*) as cnt FROM `{$this->_table}` WHERE `confirmation`='{$confirmation}'");
		if(!$try){
			return false;
		}
		$row=$try->fetch_assoc();
		if(!array_key_exists('cnt', $row)){
			return false;
		}
		if($row['cnt']!=0){
			return null;
		}
		$agentemail	=$this->real_escape_string($agentemail);
		$email_cancelled_html	=$this->real_escape_string(base64_encode($email_cancelled_html));
		$email_cancelled_txt	=$this->real_escape_string(base64_encode($email_cancelled_txt));
		$email_html				=$this->real_escape_string(base64_encode($email_html));
		$email_txt				=$this->real_escape_string(base64_encode($email_txt));
		$screen_cancelled		=$this->real_escape_string(base64_encode($screen_cancelled));
		$screen_email_sent		=$this->real_escape_string(base64_encode($screen_email_sent));
		$screen					=$this->real_escape_string(base64_encode($screen));
		return $this->query("
INSERT INTO `{$this->_table}` SET
	`confirmation`			='{$confirmation}',
	`agentemail`			='{$agentemail}',
	`email_cancelled_html`	='{$email_cancelled_html}',
	`email_cancelled_txt`	='{$email_cancelled_txt}',
	`email_html`			='{$email_html}',
	`email_txt`				='{$email_txt}',
	`screen_cancelled`		='{$screen_cancelled}',
	`screen_email_sent`		='{$screen_email_sent}',
	`screen`				='{$screen}'
");
	}

	
	public function check($confirmation,$agentemail)
	{
		if(strtolower(substr($confirmation,0,2))=='u-'){
			$confirmation=substr($confirmation,2);
		}
		$confirmation=$this->real_escape_string($confirmation);
		$agentemail=$this->real_escape_string($agentemail);
		$try=$this->query("
SELECT * FROM `{$this->_table}` WHERE
	`confirmation`='{$confirmation}'
	AND
	`agentemail`='{$agentemail}'
LIMIT 1
");
		if(!$try){
			return false;
		}
		$data=$try->fetch_assoc();
		if($data===null){
			return false;
		}
		$data['email_cancelled_html']	=base64_decode($data['email_cancelled_html']);
		$data['email_cancelled_txt']	=base64_decode($data['email_cancelled_txt']);
		$data['email_html']				=base64_decode($data['email_html']);
		$data['email_txt']				=base64_decode($data['email_txt']);
		$data['screen_cancelled']		=base64_decode($data['screen_cancelled']);
		$data['screen_email_sent']		=base64_decode($data['screen_email_sent']);
		$data['screen']					=base64_decode($data['screen']);
		return $data;
	}

}
