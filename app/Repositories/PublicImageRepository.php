<?php

namespace App\Repositories;

use App\Models\PublicImage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicImageRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:22 pm UTC
 *
 * @method PublicImage findWithoutFail($id, $columns = ['*'])
 * @method PublicImage find($id, $columns = ['*'])
 * @method PublicImage first($columns = ['*'])
*/
class PublicImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'file_type',
        'file_size',
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
        return PublicImage::class;
    }
}
