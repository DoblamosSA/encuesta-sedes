<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyQualification extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d\TH:i:s';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_qualification';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'headquarters_name',
        'qualitication',
        'question_number'
    ];
}
