<?php

namespace App\Repositories;

use App\Models\UserJobTSGalerie;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSGalerieRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserJobTSGalerie findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSGalerie find($id, $columns = ['*'])
 * @method UserJobTSGalerie first($columns = ['*'])
*/
class UserJobTSGalerieRepository extends BaseRepository
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
        'job_t_s_galery_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTSGalerie::class;
    }
}
