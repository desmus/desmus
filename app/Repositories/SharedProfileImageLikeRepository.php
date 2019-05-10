<?php

namespace App\Repositories;

use App\Models\SharedProfileImageLike;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileImageLikeRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:28 pm UTC
 *
 * @method SharedProfileImageLike findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileImageLike find($id, $columns = ['*'])
 * @method SharedProfileImageLike first($columns = ['*'])
*/
class SharedProfileImageLikeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'datetime',
        's_p_i_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileImageLike::class;
    }
}
