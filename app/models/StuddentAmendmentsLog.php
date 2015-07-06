<?php

class StudentAmendmentsLog extends \Eloquent {
    use SoftDeletingTrait;
    protected $fillable = [];
    protected $table = 'student_amendments_log';

    public function scopeLastRecordBySAN($query,$san) {
        return $query->where('san','=',$san)->orderBy('id', 'desc')->first();
    }
}