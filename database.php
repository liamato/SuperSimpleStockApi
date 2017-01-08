<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Models\StockItem as Stock;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'database'  => 'stock',
    'username'  => 'root',
    'password'  => 'root',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods
$capsule->setAsGlobal();

// Setup the Eloquent ORM
$capsule->bootEloquent();

if (!Capsule::schema()->hasTable('stock')) {
	
	// Table creation via orm
	Capsule::schema()->create('stock', function (Blueprint $table) {
		$table->increments('id');
		$table->string('name');
		$table->float('price');
		$table->integer('count');
		$table->string('img');
	});
	
	// Inertion of dummy content
	Stock::create(['name' => 'Llapisos', 'price' => 1, 'count' => 22, 'img' => 'http://www.lyra-arte.mx/images/catalogo/solo/21.png']);
	Stock::create(['name' => 'Gomes', 'price' => 0.5, 'count' => 10, 'img' => 'http://papels.es/gestion/imagenesges/zoom/goma-borrar-staedtler.png']);
	Stock::create(['name' => 'Bolis', 'price' => 1.5, 'count' => 18, 'img' => 'http://www.dimateca.com/material-oficina/fotos/boligrafo-pilot-supergrip.png']);
	Stock::create(['name' => 'Regles', 'price' => 5, 'count' => 3, 'img' => 'http://www.educapanama.edu.pa/sites/default/files/styles/fotos_xl/public/img/regla_0.png?itok=rZ8cnbb8']);
}
