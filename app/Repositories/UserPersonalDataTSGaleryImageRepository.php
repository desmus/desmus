<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSGaleryImage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSGaleryImageRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserPersonalDataTSGaleryImage findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSGaleryImage find($id, $columns = ['*'])
 * @method UserPersonalDataTSGaleryImage first($columns = ['*'])
*/
class UserPersonalDataTSGaleryImageRepository extends BaseRepository
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
        'p_d_t_s_g_i_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTSGaleryImage::class;
    }
}
