<?php

require ('Api.php');
require('ItBookStoreApi.php');
require ('GoogleBooksApi.php');

$list = new ItBookStoreApi('/search/', 'json', 'books');
$listGoogle = new GoogleBooksApi('?q=', 'json', 'items');

var_dump($list->getBooksByAuthor('Robert C. Martin'));
var_dump($listGoogle->getBooksByAuthor('Shakespare', 30));
var_dump($listGoogle->getBooksByPublishedYear(201202, 50));
var_dump($list->getBooksByPublishedYear(2015));