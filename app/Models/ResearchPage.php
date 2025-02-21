<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResearchPage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'research_pages';

    protected $fillable = [
        'section_name',
        'contents',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'contents' => 'array',
    ];
}
