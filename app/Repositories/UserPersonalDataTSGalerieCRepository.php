<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSGalerieC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSGalerieCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:54 pm UTC
 *
 * @method UserPersonalDataTSGalerieC findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSGalerieC find($id, $columns = ['*'])
 * @method UserPersonalDataTSGalerieC first($columns = ['*'])
*/
class UserPersonalDataTSGalerieCRepository extends BaseRepository
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
        return UserPersonalDataTSGalerieC::class;
    }
}
