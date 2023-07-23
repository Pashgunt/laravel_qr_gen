<?php

namespace App\Models;

use App\QR\Enums\QrCodeEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_hash_id',
        'link',
    ];

    protected $table = 'links_for_qr_code';

    public function getQrCodes(string $typeCode = QrCodeEnums::IMG_QR_CODE->value)
    {
        return match($typeCode){
            QrCodeEnums::IMG_QR_CODE->value => $this->hasMany(QrCode::class, 'link_id', 'id'),
            QrCodeEnums::PDF_QR_CODE->value => $this->hasMany(QrPdf::class, 'link_id', 'id'),
        };
    }
}
