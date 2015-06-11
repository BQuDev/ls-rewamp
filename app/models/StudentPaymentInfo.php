<?php

class StudentPaymentInfo extends \Eloquent {
    use SoftDeletingTrait;
    protected $fillable = [];
    protected $table = 'student_payment_infos';

    public function scopeLastRecordBySAN($query,$san) {
        return $query->where('san','=',$san)->orderBy('id', 'desc')->first();
    }

    public function scopeLastFourRecordsBySAN($query,$san) {
        return $query->where('san','=',$san)->orderBy('id', 'desc')->take(4)->get();
    }
}