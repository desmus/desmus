<?php

namespace App\Repositories;

use App\Models\SharedProfileNoteCResponse;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileNoteCResponseRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:28 pm UTC
 *
 * @method SharedProfileNoteCResponse findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileNoteCResponse find($id, $columns = ['*'])
 * @method SharedProfileNoteCResponse first($columns = ['*'])
*/
class SharedProfileNoteCResponseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        's_p_n_c_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileNoteCResponse::class;
    }
}
