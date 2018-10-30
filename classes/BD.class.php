<?php
	class BD{
		private static $conn;
		public function __construct(){}
		public function conn(){
			if(is_null(self::$conn)){
				self::$conn = new PDO('mysql:host=198.71.241.36;dbname=tcc;charset=utf8','ariusxi','master123');
			}
			return self::$conn;
		}
	}