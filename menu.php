<?php

try 
		{
			$sql_nav_menu1  = 'select name_menu,url from nav_menu where id = 1';
			$nav_menu1 = mysql_query($sql_nav_menu1);
			$result_nav_menu1 = mysql_fetch_array($nav_menu1);
			$menu1= $result_nav_menu1[0];
			$url1= $result_nav_menu1[1];
		}
		catch(PDOException $e) 
		{
			error_log($e->getMessage());
			die('Error al seleccionar primer campo de menu');
		}
		try 
		{
			$sql_nav_menu2  = 'select name_menu,url from nav_menu where id = 2';
			$nav_menu2 = mysql_query($sql_nav_menu2);
			$result_nav_menu2 = mysql_fetch_array($nav_menu2);
			$menu2= $result_nav_menu2[0];
			$url2= $result_nav_menu2[1];
		}
		catch(PDOException $e) 
		{
			error_log($e->getMessage());
			die('Error al seleccionar segundo campo de menu');
		}
		try
		{
			$sql_nav_menu3  = 'select name_menu, url from nav_menu where id = 3';
			$nav_menu3 = mysql_query($sql_nav_menu3);
			$result_nav_menu3 = mysql_fetch_array($nav_menu3);
			$menu3= $result_nav_menu3[0];
			$url3= $result_nav_menu3[1];
		}
		catch(PDOException $e) 
		{
			error_log($e->getMessage());
			die('Error al seleccionar tercer campo de menu');
		}
		try
		{
			$sql_nav_menu4  = 'select name_menu, url from nav_menu where id = 4';
			$nav_menu4 = mysql_query($sql_nav_menu4);
			$result_nav_menu4 = mysql_fetch_array($nav_menu4);
			$menu4= $result_nav_menu4[0];
			$url4= $result_nav_menu4[1];
		}
		catch(PDOException $e) 
		{
			error_log($e->getMessage());
			die('Error al seleccionar cuarto campo de menu');
		}
		try
		{
			$sql_nav_menu5  = 'select name_menu, url from nav_menu where id = 5';
			$nav_menu5 = mysql_query($sql_nav_menu5);
			$result_nav_menu5 = mysql_fetch_array($nav_menu5);
			$menu5= $result_nav_menu5[0];
			$url5= $result_nav_menu5[1];
		}
		catch(PDOException $e) 
		{
			error_log($e->getMessage());
			die('Error al seleccionar quinto campo de menu');
		}
?>