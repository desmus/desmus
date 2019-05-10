<?php

namespace App\Repositories;

use App\Models\PublicNoteLike;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicNoteLikeRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:23 pm UTC
 *
 * @method PublicNoteLike findWithoutFail($id, $columns = ['*'])
 * @method PublicNoteLike find($id, $columns = ['*'])
 * @method PublicNoteLike first($columns = ['*'])
*/
class PublicNoteLikeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'datetime',
        'public_note_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicNoteLike::class;
    }
}
