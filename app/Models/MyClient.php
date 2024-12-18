<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
 
class MyClient extends Model
{
    use HasFactory;
 
    protected $table = 'my_clients';
 
    protected $fillable = [
        'name', 'slug', 'is_project', 'self_capture', 'client_prefix', 'client_logo',
        'address', 'phone_number', 'city', 'created_at', 'updated_at', 'deleted_at'
    ];
 
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
 
    public function redisKey()
    {
        return "client:{$this->id}";
    }
 
    // Menyimpan data di Redis setelah disimpan
    protected static function booted()
    {
        static::saved(function ($client) {
            Redis::set($client->redisKey(), json_encode($client));
        });
 
        static::updated(function ($client) {
            Redis::del($client->redisKey());
            Redis::set($client->redisKey(), json_encode($client));
        });
 
        static::deleted(function ($client) {
            Redis::del($client->redisKey());
        });
    }
}