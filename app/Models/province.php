<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class province extends Model
{
    use HasFactory;
    /**
     * @var bool
     */
    public $incrementing = false;
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Tabla asociada al modelo
     *
     * @var string
     */
    protected $table = 'provinces';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Los atributos que deben estar ocultos para las matrices.
     *
     * @var array
     */
    protected $hidden = [
        'active'
    ];

    /**
     * @return mixed
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * @return mixed
     */
    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
