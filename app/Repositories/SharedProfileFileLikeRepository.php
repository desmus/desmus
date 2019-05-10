<?php

namespace App\Repositories;

use App\Models\SharedProfileFileLike;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileFileLikeRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:28 pm UTC
 *
 * @method SharedProfileFileLike findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileFileLike find($id, $columns = ['*'])
 * @method SharedProfileFileLike first($columns = ['*'])
*/
class SharedProfileFileLikeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'datetime',
        's_p_f_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileFileLike::class;
    }
}
