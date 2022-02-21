<?php
	class Conexion 
	{
		
		static public function conectar()
		{	
			//conexion PDO
			$link = new PDO("mysql:host=142.93.126.221;dbname=map_place", "sylar_admin", "Sylar_Admin*2018");
			//seteamos los caracteres latinos
			$link->exec("set names utf8");
			return $link;
		}
	}