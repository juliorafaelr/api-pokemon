<?php

namespace App\Models;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use Uuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pokemons';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'num',
        'name',
        'type_1',
        'type_2',
        'total',
        'hp',
        'attack',
        'defense',
        'sp_atk',
        'sp_def',
        'speed',
        'generation',
        'legendary'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
