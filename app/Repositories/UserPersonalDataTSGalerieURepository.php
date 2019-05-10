<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSGalerieU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSGalerieURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:01 pm UTC
 *
 * @method UserPersonalDataTSGalerieU findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSGalerieU find($id, $columns = ['*'])
 * @method UserPersonalDataTSGalerieU first($columns = ['*'])
*/
class UserPersonalDataTSGalerieURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'u_p_d_t_s_g_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTSGalerieU::class;
    }
}
