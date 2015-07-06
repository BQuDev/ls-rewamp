<?php

class StudentApplicationStatus extends \Eloquent {
    use SoftDeletingTrait;
    protected $fillable = [];
    protected $table = 'student_application_status';

    public function scopeLastRecordBySAN($query,$san) {
        return $query->where('san','=',$san)->orderBy('id', 'desc')->first();
    }
    public function scopeInsertRecordBySAN($query,$san) {
        return $query->where('san','=',$san)->where('id','=',1)->orderBy('id', 'desc')->first();
    }
    public function scopeValidatedRecordBySAN($query,$san) {
        return $query->where('san','=',$san)->where('id','=',2)->orderBy('id', 'desc')->get();
    }
    public function scopeVerifiedRecordBySAN($query,$san) {
        return $query->where('san','=',$san)->where('id','=',3)->orderBy('id', 'desc')->get();
    }

}