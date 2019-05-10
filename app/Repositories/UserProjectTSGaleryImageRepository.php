<?php

namespace App\Repositories;

use App\Models\UserProjectTSGaleryImage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSGaleryImageRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserProjectTSGaleryImage findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSGaleryImage find($id, $columns = ['*'])
 * @method UserProjectTSGaleryImage first($columns = ['*'])
*/
class UserProjectTSGaleryImageRepository extends BaseRepository
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
        'project_t_s_g_image_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTSGaleryImage::class;
    }
}
