<?php

class StudentMark extends \Eloquent {
    protected $table = 'student_marks';

    public function scopeLastRecordBySAN($query,$san) {
        return $query->where('san','=',$san)->orderBy('id', 'desc')->first();
    }
	
	public function getLastRecordBySAN($san){
	return StudentSource::where('san','=',$san)->orderBy('id', 'desc')->first();
	}

}