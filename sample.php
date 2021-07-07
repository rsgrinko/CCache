<?php
/*
  Пример использования класса CCache.class.php
*/
require_once __DIR__.'/classes/CCache.php';

CCache::init('/cache/'); // устанавливаем дирректорию для кэша

if(checkCache('test') and CCache::ageOfCache('test')<3600) { // проверяем наличие элемента в кэше и его актуальность
  $var = CCache::getCache('test'); // получаем элемент из кэша
} else { // При отсутствии элемента в кэше 
  $var = $_SERVER; // Выполняем действия для получения этого элемента
  CCache::writeCache('test', $var); // Пишем результат в кэш
}

// Узнаем сколько времени прошло с момента создания кэша элемента
echo CCache::ageOfCache('test');

// Можно узнать размер кэша (bytes)
echo CCache::getCacheSize().' bytes'; 

// Можно узнать размер конкретного элемента в кэше (bytes)
echo CCache::getSize('test').' bytes';


// Также можно удалить элемент из кэша
CCache::delFromCache('test');


// Или полностью очистить кэш
CCache::clearCache();
