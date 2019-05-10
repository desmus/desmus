<?php

namespace App\Repositories;

use App\Models\UserCollegeTSGaleryImage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSGaleryImageRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserCollegeTSGaleryImage findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSGaleryImage find($id, $columns = ['*'])
 * @method UserCollegeTSGaleryImage first($columns = ['*'])
*/
class UserCollegeTSGaleryImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'description',
        'status',
        'permissions',
        'user_id',
        'college_t_s_g_image_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTSGaleryImage::class;
    }
}
