<?php
	/*
		Класс для кэширования данных
		Роман Сергеевич Гринько
		rsgrinko@gmail.com
		https://it-stories.ru
	*/
class CCache{
	private static $cache_dir = '/custom/custom-cache/system_cache/';
	
	public static function init($dir){
		self::$cache_dir = $dir;
	}
	
	
	public static function checkCache($name){ // Проверка наличия элемента в кэше
		if(file_exists($_SERVER['DOCUMENT_ROOT'].self::$cache_dir.md5($name).'.tmp')){
			return true;
		} else {
			return false;
		}
	}
	
	public static function getCache($name){	// Получить элемент из кэша
		if(self::checkCache($name)){
			return unserialize(base64_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].self::$cache_dir.md5($name).'.tmp')));
		} else {
			return false;
		}
	}
		
	public static function writeCache($name, $arValue){ // Записать элемент в кэш
		if(file_put_contents($_SERVER['DOCUMENT_ROOT'].self::$cache_dir.md5($name).'.tmp', base64_encode(serialize($arValue)))){
			return true;
		} else {
			return false;
		}
	}
	
	public static function clearCache(){ // Очистить кэш
		foreach(scandir($_SERVER['DOCUMENT_ROOT'].self::$cache_dir) as $file){
			if($file == '.' or $file == '..') continue;
			if(!unlink($_SERVER['DOCUMENT_ROOT'].self::$cache_dir.$file)){
				return false;
			}
		}
		return true;
	}
	
	public static function delFromCache($name){ // Удалить элемент из кэша
		if(self::checkCache($name)){
			if(!unlink($_SERVER['DOCUMENT_ROOT'].self::$cache_dir.md5($name).'.tmp')){
				return false;	
			}
		}
		return true;
	}	
	
	public static function getSize($name){ // Получить размер элемента в кэше
		if(self::checkCache($name)){
			return $_SERVER['DOCUMENT_ROOT'].self::$cache_dir.md5($name).'.tmp';
			
		}
		return true;
	}
	
	public static function getCacheSize(){ // Получить размер кэша
		$return_size = 0;
		foreach(scandir($_SERVER['DOCUMENT_ROOT'].self::$cache_dir) as $file){
			if($file == '.' or $file == '..') continue;
			$return_size = $return_size + filesize($_SERVER['DOCUMENT_ROOT'].self::$cache_dir.$file);
		}
		return $return_size;
	}
}
?>
