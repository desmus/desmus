<?php

namespace App\Repositories;

use App\Models\SharedProfileFileCResponse;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileFileCResponseRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:28 pm UTC
 *
 * @method SharedProfileFileCResponse findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileFileCResponse find($id, $columns = ['*'])
 * @method SharedProfileFileCResponse first($columns = ['*'])
*/
class SharedProfileFileCResponseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        's_p_f_c_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileFileCResponse::class;
    }
}
