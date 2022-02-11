<?php

namespace App\Models;

use App\Models\User;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\DiscountStudent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignStudent extends Model
{
    public function student()
    {
        return $this->belongsTo(User::class,'student_id','id');
    }

    public function discount()
    {
        return $this->belongsTo(DiscountStudent::class,'id','assign_student_id');
    }

    public function student_class()
    {
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }

    public function student_year()
    {
        return $this->belongsTo(StudentYear::class,'year_id','id');
    }

}
