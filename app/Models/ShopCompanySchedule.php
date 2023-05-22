<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopCompanySchedule extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'shop_company_schedules';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'shop_company_id',
        'monday_morning_opening',
        'monday_morning_closing',
        'monday_afternoon_opening',
        'monday_afternoon_closing',
        'tuesday_morning_opening',
        'tuesday_morning_closing',
        'tuesday_afternoon_opening',
        'tuesday_afternoon_closing',
        'wednesday_morning_opening',
        'wednesday_morning_closing',
        'wednesday_afternoon_opening',
        'wednesday_afternoon_closing',
        'thursday_morning_opening',
        'thursday_morning_closing',
        'thursday_afternoon_opening',
        'thursday_afternoon_closing',
        'friday_morning_opening',
        'friday_morning_closing',
        'friday_afternoon_opening',
        'friday_afternoon_closing',
        'saturday_morning_opening',
        'saturday_morning_closing',
        'saturday_afternoon_opening',
        'saturday_afternoon_closing',
        'sunday_morning_opening',
        'sunday_morning_closing',
        'sunday_afternoon_opening',
        'sunday_afternoon_closing',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function shop_company()
    {
        return $this->belongsTo(ShopCompany::class, 'shop_company_id');
    }
}
