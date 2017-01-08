<?php

use Models\StockItem as Stock;
use Illuminate\Http\Request;	

$app['router']->get('/', function() {
	return Stock::all();
});


$app['router']->get('/{id}', function($id) {
	return Stock::find($id);
})->where('id', '[0-9]+');


$app['router']->post('/{id}', function(Request $request, $id) {
	$s = Stock::find($id);

	foreach($request->json()->all() as $key => $val) {
	    if ($key === 'id') continue;

            if (in_array($key, $s->fillable)) {
                $s[$key] = $val;
            }
	}

	$s->save();

	return $s;
})->where('id', '[0-9]+');

