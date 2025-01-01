<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillingAddress extends Model
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
    'notes'
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}