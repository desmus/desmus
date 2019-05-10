<?php

namespace App\Repositories;

use App\Models\UserJobTSGalerieU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSGalerieURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:00 pm UTC
 *
 * @method UserJobTSGalerieU findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSGalerieU find($id, $columns = ['*'])
 * @method UserJobTSGalerieU first($columns = ['*'])
*/
class UserJobTSGalerieURepository extends BaseRepository
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
        return UserJobTSGalerieU::class;
    }
}
