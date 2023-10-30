<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class department extends Model
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
    protected $table = 'departments';

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
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return mixed
     */
    public function provinces(){}
}
