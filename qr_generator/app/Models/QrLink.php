<?php

namespace App\Models;

use App\Filters\QueryFilter;
use App\QR\Enums\QrCodeEnums;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QrLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_hash_id',
        'link',
    ];

    protected $table = 'links_for_qr_code';

    public function getQrCodes(string $typeCode = QrCodeEnums::IMG_QR_CODE->value): HasMany
    {
        return match ($typeCode) {
            QrCodeEnums::IMG_QR_CODE->value => $this->hasMany(QrCode::class, 'link_id', 'id'),
            QrCodeEnums::PDF_QR_CODE->value => $this->hasMany(QrPdf::class, 'link_id', 'id'),
        };
    }

    public function scopeJoined(Builder $builder): mixed
    {
        return $builder->join('company_table_hash', 'links_for_qr_code.company_hash_id', '=', 'company_table_hash.id')
            ->join('qr_codes', 'links_for_qr_code.id', '=', 'qr_codes.link_id')
            ->leftJoin('qr_codes_pdf', 'links_for_qr_code.id', '=', 'qr_codes_pdf.link_id');
    }

    public function scopeFilter(
        Builder $builder,
        QueryFilter $filter,
        array $additionalParams = []
    ) {
        return $filter->apply($builder, $additionalParams);
    }

    public function scopeFirstResult(Builder $builder): object|null
    {
        return $builder->first([
            'qr_codes.file_name AS svg_file_name',
            'qr_codes.file_path AS svg_file_path',
            'company_table_hash.*',
            'qr_codes_pdf.*',
            'links_for_qr_code.*',
        ]);
    }

    public function scopePaginateResult(
        Builder $builder,
        int $paginate = 10
    ): LengthAwarePaginator {
        return $builder->paginate($paginate, [
            'qr_codes.file_name AS svg_file_name',
            'qr_codes.file_path AS svg_file_path',
            'company_table_hash.*',
            'qr_codes_pdf.*',
            'links_for_qr_code.*',
        ]);
    }
}
