<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model {

	protected $table = 'stock';

	protected $guarded = ['id'];

	public $fillable = ['name', 'price', 'count', 'img'];

	public $timestamps = false;

}
