<?php

namespace App\Repositories;

use App\Models\PublicAdvertisementUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicAdvertisementUpdateRepository
 * @package App\Repositories
 * @version January 19, 2019, 9:10 pm UTC
 *
 * @method PublicAdvertisementUpdate findWithoutFail($id, $columns = ['*'])
 * @method PublicAdvertisementUpdate find($id, $columns = ['*'])
 * @method PublicAdvertisementUpdate first($columns = ['*'])
*/
class PublicAdvertisementUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'public_advertisement_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicAdvertisementUpdate::class;
    }
}
