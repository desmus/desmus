<?php

namespace App\Repositories;

use App\Models\PublicVideo;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicVideoRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:22 pm UTC
 *
 * @method PublicVideo findWithoutFail($id, $columns = ['*'])
 * @method PublicVideo find($id, $columns = ['*'])
 * @method PublicVideo first($columns = ['*'])
*/
class PublicVideoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'file_type',
        'file_size',
        'link',
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
        return PublicVideo::class;
    }
}
