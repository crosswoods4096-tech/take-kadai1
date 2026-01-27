<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel_1',
        'tel_2',
        'tel_3',
        'address',
        'kind',
        'content',
    ];
    public function getGenderLabelAttribute()
    {
        return [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ][$this->gender] ?? '';
    }
}
