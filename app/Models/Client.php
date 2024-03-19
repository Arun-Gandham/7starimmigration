<?php

namespace App\Models;

use App\Models\Country;
use App\Models\PaymentHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'user_id',
        'amount',
        'address',
        'country_id',
        'enq_status',
        'file_submitted',
    ];

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function employee()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function payment()
    {
        return $this->hasMany(PaymentHistory::class, 'client_id', 'id');
    }

    public function getPaymentSum()
    {
        $paymenthostory = $this->payment();
        return $paymenthostory->sum('amount');
    }
}
