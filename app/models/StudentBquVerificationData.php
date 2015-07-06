<?php

class StudentBquVerificationData extends \Eloquent {
    use SoftDeletingTrait;
    protected $fillable = [];
    protected $table = 'student_bqu_verification_data';

    public function scopeLastRecordBySAN($query,$san) {
        // return DB::table('students')->where('san','=',$san)->orderBy('id', 'desc')->first();
        return $query->where('san','=',$san)->orderBy('id', 'desc')->first();
    }

}