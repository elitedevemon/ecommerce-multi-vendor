<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
  protected $fillable = [
    "code",
    "type",
    "value",
    "expiry_date",
    "status",
  ];

  public function discount(int $subtotal)
  {
    if ($this->type == 'fixed') {
      return $this->value;
    } else {
      return ($this->value * $subtotal) / 100;
    }
  }
}