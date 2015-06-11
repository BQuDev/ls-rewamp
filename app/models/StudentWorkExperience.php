<?php

class StudentWorkExperience extends \Eloquent {
	protected $fillable = [];
    protected $table = 'student_work_experiences';

    public function scopeLastRecordBySAN($query,$san) {
        return $query->where('san','=',$san)->orderBy('id', 'desc')->first();
    }

    public function scopeLastThreeRecordsBySAN($query,$san) {
        return $query->where('san','=',$san)->orderBy('id', 'desc')->take(3)->get();
    }

}