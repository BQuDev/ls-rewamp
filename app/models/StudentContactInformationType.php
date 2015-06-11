<?php

class StudentContactInformationType extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];

    public function scopeLastRecordBySAN($query,$san) {
        return $query->where('san','=',$san)->orderBy('id', 'desc')->first();
    }
}