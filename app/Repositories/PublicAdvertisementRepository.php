<?php

namespace App\Repositories;

use App\Models\PublicAdvertisement;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicAdvertisementRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:22 pm UTC
 *
 * @method PublicAdvertisement findWithoutFail($id, $columns = ['*'])
 * @method PublicAdvertisement find($id, $columns = ['*'])
 * @method PublicAdvertisement first($columns = ['*'])
*/
class PublicAdvertisementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'link',
        'email',
        'telephone',
        'address',
        'description',
        'image_type',
        'image_size',
        'video_type',
        'video_size',
        'video_link',
        'views_quantity',
        'updates_quantity',
        'status',
        'datetime',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicAdvertisement::class;
    }
}
