<?php

namespace App\Repositories;

use App\Models\SharedProfileImageCResponse;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileImageCResponseRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:28 pm UTC
 *
 * @method SharedProfileImageCResponse findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileImageCResponse find($id, $columns = ['*'])
 * @method SharedProfileImageCResponse first($columns = ['*'])
*/
class SharedProfileImageCResponseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        's_p_i_c_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileImageCResponse::class;
    }
}
