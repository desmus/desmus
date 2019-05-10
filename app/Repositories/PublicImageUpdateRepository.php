<?php

namespace App\Repositories;

use App\Models\PublicImageUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicImageUpdateRepository
 * @package App\Repositories
 * @version January 19, 2019, 9:10 pm UTC
 *
 * @method PublicImageUpdate findWithoutFail($id, $columns = ['*'])
 * @method PublicImageUpdate find($id, $columns = ['*'])
 * @method PublicImageUpdate first($columns = ['*'])
*/
class PublicImageUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'public_image_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicImageUpdate::class;
    }
}
