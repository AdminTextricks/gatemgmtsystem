<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentMaster extends Model
{
    use HasFactory;   

    protected static function booted()
    {
        static::deleting(function ($equipment) {
            if (!empty($equipment->image)) {
                $oldImage = public_path('studentdocument/' . $equipment->image);
                if (File::exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            if (!empty($equipment->eqp_video)) {
                $filePath = public_path('student_documents/' . $equipment->eqp_video);
                if (File::exists($filePath)) {
                    unlink($filePath);
                }
            }
        });
    }
}
