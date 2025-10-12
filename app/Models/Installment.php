<?php

namespace App\Models;

use Database\Factories\InstallmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    /** @use HasFactory<InstallmentFactory> */
    use HasFactory;
}
