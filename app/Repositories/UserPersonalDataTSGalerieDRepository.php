<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSGalerieD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSGalerieDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:06 pm UTC
 *
 * @method UserPersonalDataTSGalerieD findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSGalerieD find($id, $columns = ['*'])
 * @method UserPersonalDataTSGalerieD first($columns = ['*'])
*/
class UserPersonalDataTSGalerieDRepository extends BaseRepository
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
        return UserPersonalDataTSGalerieD::class;
    }
}
