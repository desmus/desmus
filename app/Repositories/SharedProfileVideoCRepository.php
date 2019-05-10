<?php

namespace App\Repositories;

use App\Models\SharedProfileVideoC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileVideoCRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:29 pm UTC
 *
 * @method SharedProfileVideoC findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileVideoC find($id, $columns = ['*'])
 * @method SharedProfileVideoC first($columns = ['*'])
*/
class SharedProfileVideoCRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        's_p_v_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileVideoC::class;
    }
}
