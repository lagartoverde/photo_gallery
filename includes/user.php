<?php

	require_once('database.php');

	class User{

		public static function find_all(){
			$result=self::find_by_sql("SELECT*FROM users");
			return $result;

		}

		public static function find_by_id($id=0){
			$result=self::find_by_sql("SELECT * FROM users WHERE id={$id}");
			return $result;
		}

		public static function find_by_sql($sql=""){
			global $database;
			$result_set=$database->query($sql);
			return $result_set;
		}

		public static function find_by_condition($condition="1"){
			$result=self::find_by_sql("SELECT*FROM users WHERE ".$condition);
			return $result;
		}

	}
?>