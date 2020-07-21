<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportChef extends Model
{
    protected $fillable = ['report_reason','chef_id','user_id'];
}
