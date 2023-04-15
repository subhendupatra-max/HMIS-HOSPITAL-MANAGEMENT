<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class PathologyParameter extends Model
{
    use HasFactory;

    public function unitName()
    {
        return $this->belongsTo(PathologyUnit::class,'unit_id' , 'id');
      
    }
}
