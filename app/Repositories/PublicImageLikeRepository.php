<?php

namespace App\Repositories;

use App\Models\PublicImageLike;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicImageLikeRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:23 pm UTC
 *
 * @method PublicImageLike findWithoutFail($id, $columns = ['*'])
 * @method PublicImageLike find($id, $columns = ['*'])
 * @method PublicImageLike first($columns = ['*'])
*/
class PublicImageLikeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'datetime',
        'public_image_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicImageLike::class;
    }
}
