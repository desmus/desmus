<?php

namespace App\Repositories;

use App\Models\PublicVideoLike;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicVideoLikeRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:24 pm UTC
 *
 * @method PublicVideoLike findWithoutFail($id, $columns = ['*'])
 * @method PublicVideoLike find($id, $columns = ['*'])
 * @method PublicVideoLike first($columns = ['*'])
*/
class PublicVideoLikeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'datetime',
        'public_video_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicVideoLike::class;
    }
}
