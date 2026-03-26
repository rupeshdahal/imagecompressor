<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompressionReport extends Model
{
    protected $fillable = [
        'action',
        'batch_id',
        'referrer',
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
        'country',
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

    protected static function booted(): void
    {
        static::creating(function (self $report): void {
            if (!empty($report->country)) {
                return;
            }

            $report->country = self::resolveCountryCodeFromRequest();
        });
    }

    private static function resolveCountryCodeFromRequest(): string
    {
        try {
            $request = request();
        } catch (\Throwable) {
            return 'ZZ';
        }

        if (!$request) {
            return 'ZZ';
        }

        $headerCandidates = [
            'CF-IPCountry',
            'CloudFront-Viewer-Country',
            'X-Country-Code',
            'X-AppEngine-Country',
            'X-Geo-Country',
        ];

        foreach ($headerCandidates as $header) {
            $value = strtoupper(trim((string) $request->header($header, '')));
            if (preg_match('/^[A-Z]{2}$/', $value)) {
                return $value;
            }
        }

        $acceptLanguage = (string) $request->header('Accept-Language', '');
        if (preg_match('/-[A-Za-z]{2}\b/', $acceptLanguage, $matches)) {
            return strtoupper(substr($matches[0], 1));
        }

        $ip = $request->ip();
        if ($ip && filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
            return 'LOCAL';
        }

        return 'ZZ';
    }
}
