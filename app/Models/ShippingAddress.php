<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
  protected $fillable = [
    'user_id',
    'recipient',
    'phone',
    'email',
    'country',
    'street_address',
    'apartment',
    'city',
    'state',
    'post_code',
    'delivery_address',
    'notes'
  ];
}