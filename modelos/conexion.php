<?php

class Conexion {

		static public function conectar() {
	 
		   try {
			  $link = new PDO("mysql:host=localhost;dbname=db_proyecto", "root", "");
			  $link->exec("set names utf8");
			  $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar errores de PDO
			  return $link;
		   } catch (PDOException $e) {
			  // Puedes usar echo o un log aquí, dependiendo de tu entorno de producción
			  die("Error en la conexión: " . $e->getMessage());
		   }
		}
	
}
	 
