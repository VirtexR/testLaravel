<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    public const EUR = 'EUR';
    public const USD = 'USD';
    public const RUB = 'RUB';

}
