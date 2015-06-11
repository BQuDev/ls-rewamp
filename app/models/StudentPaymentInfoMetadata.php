<?php

class StudentPaymentInfoMetadata extends \Eloquent {
    use SoftDeletingTrait;
    //protected $fillable = ['course_fees','payment_status','total_fee','late_admin_fee','late_fee','san','student_id','record_status','created_by','deleted_at','created_at','updated_at'];
    protected $fillable = [];
    protected $table = 'student_payment_info_metadatas';

    public function scopeGetLastRecordBySAN($query,$san) {
       /* if(StudentPaymentInfoMetadata::where('san','=',$san)->count()>0){
        return $query->where('san','=',$san)->orderBy('id', 'desc')->first();}else{return '';}*/
        return $query->where('san','=',$san)->orderBy('id', 'desc')->first();
    }
}