<?php

namespace App\Repositories;

use App\Models\SharedProfileImageUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileImageUpdateRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:30 pm UTC
 *
 * @method SharedProfileImageUpdate findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileImageUpdate find($id, $columns = ['*'])
 * @method SharedProfileImageUpdate first($columns = ['*'])
*/
class SharedProfileImageUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        's_p_i_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileImageUpdate::class;
    }
}
