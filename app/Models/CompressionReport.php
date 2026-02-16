<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompressionReport extends Model
{
    protected $fillable = [
        'original_name',
        'original_format',
        'output_format',
        'original_size',
        'compressed_size',
        'reduction_percent',
        'quality',
        'width',
        'height',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'original_size'     => 'integer',
        'compressed_size'   => 'integer',
        'reduction_percent' => 'float',
        'quality'           => 'integer',
        'width'             => 'integer',
        'height'            => 'integer',
    ];
}
