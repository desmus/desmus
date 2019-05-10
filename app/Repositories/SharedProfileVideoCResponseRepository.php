<?php

namespace App\Repositories;

use App\Models\SharedProfileVideoCResponse;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileVideoCResponseRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:29 pm UTC
 *
 * @method SharedProfileVideoCResponse findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileVideoCResponse find($id, $columns = ['*'])
 * @method SharedProfileVideoCResponse first($columns = ['*'])
*/
class SharedProfileVideoCResponseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        's_p_v_c_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileVideoCResponse::class;
    }
}
