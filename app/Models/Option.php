<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
		'id', 'site_name','site_title','site_desc','contact_email','contact_phone','site_logo','footer_text','currency_format','contact_address'
	];
}
