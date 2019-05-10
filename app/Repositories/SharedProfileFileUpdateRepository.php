<?php

namespace App\Repositories;

use App\Models\SharedProfileFileUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileFileUpdateRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:29 pm UTC
 *
 * @method SharedProfileFileUpdate findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileFileUpdate find($id, $columns = ['*'])
 * @method SharedProfileFileUpdate first($columns = ['*'])
*/
class SharedProfileFileUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        's_p_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileFileUpdate::class;
    }
}
