<?php

class Mastersheet extends \Eloquent {

    protected $table = 'mastersheet';
    protected $connection = 'mysql_mastersheet';

    public function scopeLastRecordBySAN($query,$san) {
        // return DB::table('students')->where('san','=',$san)->orderBy('id', 'desc')->first();
        return $query->where('san','=',$san)->orderBy('id', 'desc')->first();
    }

}