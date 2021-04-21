<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'invoice_type',
		'invoice_number',
		'pay_year',
		'pay_term'
	];

	public function user()
	{

		return $this->belongsTo(User::class);
	}

	public function invoice_detail()
	{

		return $this->hasOne(InvoiceSetting::class, 'invoice_type', 'invoice_type');
	}
	public function quarter()
	{

		return $this->hasOne(Quarter::class, 'id', 'pay_term');
	}
}
