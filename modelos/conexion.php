<?php
	class Conexion 
	{
		
		static public function conectar()
		{	
			//conexion PDO
			$link = new PDO("mysql:host=1412122.91213.121226.22112;dbname=map_place12", "sylar_admin121", "1212");
			//seteamos los caracteres latinos
			$link->exec("set names utf8");
			return $link;
		}
	}
