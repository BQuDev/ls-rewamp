<?php

class StudentSource extends \Eloquent {
    use SoftDeletingTrait;
    protected $fillable = [];
    protected $table = 'student_sources';

    public function scopeLastRecordBySAN($query,$san) {
        return $query->where('san','=',$san)->orderBy('id', 'desc')->first();
    }
	
	public function getLastRecordBySAN($san){
	return StudentSource::where('san','=',$san)->orderBy('id', 'desc')->first();
	}

}