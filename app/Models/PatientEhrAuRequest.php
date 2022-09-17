<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientEhrAuRequest extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'patient_ehr_au_request';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ehr_id','patient_ehr_request_id','status'];
}
