<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['company_id', 'name', 'description', 'price'];

    public function company() {
        return $this->belongsTo(Company::class);
    }

}
