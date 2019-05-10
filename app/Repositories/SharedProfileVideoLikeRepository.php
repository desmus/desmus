<?php

namespace App\Repositories;

use App\Models\SharedProfileVideoLike;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileVideoLikeRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:29 pm UTC
 *
 * @method SharedProfileVideoLike findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileVideoLike find($id, $columns = ['*'])
 * @method SharedProfileVideoLike first($columns = ['*'])
*/
class SharedProfileVideoLikeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return SharedProfileVideoLike::class;
    }
}
