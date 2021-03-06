<?php
	require_once(LIB_PATH.DS.'database.php');

	class Comment extends DatabaseObject{

		protected static $table_name="comments";
		protected static $db_fields=array('id','photograph_id','created','author','body');

		public $id;
		public $photograph_id;
		public $created;
		public $author;
		public $body;


		//new is a keyword so we use make or build
		public static function make($photo_id,$author="Anonymous",$body=""){
			if(!empty($photo_id)&&!empty($author)&&!empty($body)){
				$comment=new Comment();
				$comment->photograph_id=(int)$photo_id;
				$comment->created=strftime("%Y-%m-%d %H:%M:%S",time());
				$comment->author=$author;
				$comment->body=$body;
				return $comment;
			}else{
				return false;
			}
		}

		public static function find_comments_on($photo_id=0){
			global $database;
			$comment_array=self::find_by_condition("photograph_id=".$database->escape_value($photo_id)." ORDER BY created ASC");
			return $comment_array;
		}

		public function send_notification(){

			$mail=new PHPMailer();


			$mail->FromName="Photo Gallery";
			$mail->From="oscar.rodriguez@greengeckowebs.com";
			$mail->AddAddress("lagartoverde97@gmail.com","Oscar");
			$mail->Subject="New Photo Gallery Comment";
			$mail->Body=<<<EMAILBODY

A new comment has been received in the Photo  Gallery.

At {$this->created}, {$this->author} wrote:

{$this->body}

EMAILBODY;

			$result=$mail->Send();
			return $result;
		}

	}
?>