<?php

namespace App\Repositories;

use App\Models\SharedProfileImage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileImageRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:27 pm UTC
 *
 * @method SharedProfileImage findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileImage find($id, $columns = ['*'])
 * @method SharedProfileImage first($columns = ['*'])
*/
class SharedProfileImageRepository extends BaseRepository
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
        return SharedProfileImage::class;
    }
}
