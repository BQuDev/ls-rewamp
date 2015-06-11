<?php

class StudentDataSnapshot extends \Eloquent {
    use SoftDeletingTrait;
    protected $fillable = [];
    protected $table = 'student_data_snapshot';

    public function scopeLastRecordBySAN($query,$san) {
        return $query->where('san','=',$san)->orderBy('id', 'desc')->first();
    }
}