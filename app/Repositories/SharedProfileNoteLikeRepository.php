<?php

namespace App\Repositories;

use App\Models\SharedProfileNoteLike;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileNoteLikeRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:28 pm UTC
 *
 * @method SharedProfileNoteLike findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileNoteLike find($id, $columns = ['*'])
 * @method SharedProfileNoteLike first($columns = ['*'])
*/
class SharedProfileNoteLikeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'datetime',
        's_p_n_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileNoteLike::class;
    }
}
