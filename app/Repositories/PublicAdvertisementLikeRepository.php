<?php

namespace App\Repositories;

use App\Models\PublicAdvertisementLike;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicAdvertisementLikeRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:24 pm UTC
 *
 * @method PublicAdvertisementLike findWithoutFail($id, $columns = ['*'])
 * @method PublicAdvertisementLike find($id, $columns = ['*'])
 * @method PublicAdvertisementLike first($columns = ['*'])
*/
class PublicAdvertisementLikeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'datetime',
        'public_advertisement_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicAdvertisementLike::class;
    }
}
