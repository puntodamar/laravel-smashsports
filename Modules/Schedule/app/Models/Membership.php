<?php

namespace Modules\Schedule\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Membership extends Model
{
    protected $fillable = [
        'user_id','court_id','weekday','start_time','end_time','price',
        'start_date','end_date','status',
    ];

    protected $casts = [// 0..6
        'price'      => 'integer',
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function court(): BelongsTo
    {
        return $this->belongsTo(Court::class);
    }
}
