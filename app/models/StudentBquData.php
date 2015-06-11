<?php

class StudentBquData extends \Eloquent {
	protected $fillable = [];
    protected $table ='student_bqu_data';

    public function scopeLastRecordBySAN($query,$san) {
        return $query->where('san','=',$san)->orderBy('id', 'desc')->first();
    }
    public function scopeGetNameByID($query,$id) {
        return $query->where('id','=',$id)->first()->name;
    }

}