<?php

namespace App\Models;

use App\Models\StudentClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeeAmount extends Model
{
    public function fee_category()
    {
        return $this->belongsTo(StudentFee::class,'fee_category_id','id'); // convert get object by id
    }

    public function student_class()
    {
        return $this->belongsTo(StudentClass::class,'class_id','id'); // convert get object by id
    }
}
