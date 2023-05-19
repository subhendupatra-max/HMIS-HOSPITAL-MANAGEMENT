<?php

namespace App\Models\bloodBank;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Components extends Model
{
    use HasFactory;

    public function getComponentsDetails()
    {
        return $this->belongsTo(ComponentsDetail::class, 'id', 'components_id');
    }
}
