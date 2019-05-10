<?php

namespace App\Repositories;

use App\Models\UserJobTSGalerieC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSGalerieCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:54 pm UTC
 *
 * @method UserJobTSGalerieC findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSGalerieC find($id, $columns = ['*'])
 * @method UserJobTSGalerieC first($columns = ['*'])
*/
class UserJobTSGalerieCRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_j_t_s_g_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTSGalerieC::class;
    }
}
