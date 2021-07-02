<?php
/*
  Sample for use CCache.class.php
*/
require_once __DIR__.'/classes/CCache.php';

CCache::init('/cache/'); // set cache dir

if(checkCache('test')) { // check awaible cached version
  $var = CCache::getCache('test'); // get element from cache
} else {
  $var = $_SERVER; // get var standart method
  CCache::writeCache('test', $var); // write element to cache
}


//you can check cache size (bytes)
echo CCache::getCacheSize().' bytes'; 

// You can check element in cache (bytes)
echo CCache::getSize('test').' bytes';


// Delete element from cache
CCache::delFromCache('test');


//clear all cache
CCache::clearCache();
