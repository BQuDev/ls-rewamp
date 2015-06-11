<?php

class Student extends \Eloquent {
    use SoftDeletingTrait;
    protected $fillable = [];
    protected $table = 'students';
	
	public function scopeLastRecordBySAN($query,$san) {
       // return DB::table('students')->where('san','=',$san)->orderBy('id', 'desc')->first();
        return $query->where('san','=',$san)->orderBy('id', 'desc')->first();
    }

}