<?php
/*
  Пример использования класса CCache.class.php
*/
require_once __DIR__ . '/classes/CCache.php';


CCache::init('/cache/', 3600, true); // инициализация модуля кэширования


$isUseMemcache = CCache::useMemcache('localhost', 11211); // переключаем кэширование на мемкэш

if ($isUseMemcache) {
    echo 'Используется Memcache';
} else {
    echo 'Ошибка включения Memcache: ' . CCache::getLastError();
}


if (CCache::check('test')) { // проверяем наличие элемента в кэше и его актуальность
    $var = CCache::get('test'); // получаем элемент из кэша
} else { // При отсутствии элемента в кэше 
    $var = $_SERVER; // Выполняем действия для получения этого элемента
    CCache::write('test', $var); // Пишем результат в кэш
}

// Узнаем сколько времени прошло с момента создания кэша элемента
echo CCache::getAge('test');

// Можно узнать размер кэша (bytes)
echo CCache::getCacheSize() . ' bytes';

// Можно узнать размер конкретного элемента в кэше (bytes)
echo CCache::getSize('test') . ' bytes';


// Также можно удалить элемент из кэша
CCache::del('test');


// Или полностью очистить кэш
CCache::flush();
