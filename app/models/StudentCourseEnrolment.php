<?php

class StudentCourseEnrolment extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = 'student_course_enrolments';

    public function scopeLastRecordBySAN($query,$san) {
        return $query->where('san','=',$san)->orderBy('id', 'desc')->first();
    }
}