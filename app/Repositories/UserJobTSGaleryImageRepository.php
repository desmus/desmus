<?php

namespace App\Repositories;

use App\Models\UserJobTSGaleryImage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSGaleryImageRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserJobTSGaleryImage findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSGaleryImage find($id, $columns = ['*'])
 * @method UserJobTSGaleryImage first($columns = ['*'])
*/
class UserJobTSGaleryImageRepository extends BaseRepository
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
        'job_t_s_g_image_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTSGaleryImage::class;
    }
}
