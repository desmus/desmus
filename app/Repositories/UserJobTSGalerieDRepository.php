<?php

namespace App\Repositories;

use App\Models\UserJobTSGalerieD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSGalerieDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:05 pm UTC
 *
 * @method UserJobTSGalerieD findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSGalerieD find($id, $columns = ['*'])
 * @method UserJobTSGalerieD first($columns = ['*'])
*/
class UserJobTSGalerieDRepository extends BaseRepository
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
        return UserJobTSGalerieD::class;
    }
}
