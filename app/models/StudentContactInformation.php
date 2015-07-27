<?php

class StudentContactInformation extends \Eloquent {
    use SoftDeletingTrait;
    protected $fillable = [];
    protected $table = 'student_contact_informations';

    public function scopeLastRecordBySAN($query,$san) {
        return $query->where('san','=',$san)->where('student_contact_information_type','=','2')->orderBy('id', 'desc')->first();
    }
    public function scopeLastUKRecordBySAN($query,$san) {
        return $query->where('san','=',$san)->where('student_contact_information_type','=','1')->orderBy('id', 'desc')->first();
    }
}