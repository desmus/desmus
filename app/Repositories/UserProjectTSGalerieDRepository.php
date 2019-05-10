<?php

namespace App\Repositories;

use App\Models\UserProjectTSGalerieD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSGalerieDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:05 pm UTC
 *
 * @method UserProjectTSGalerieD findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSGalerieD find($id, $columns = ['*'])
 * @method UserProjectTSGalerieD first($columns = ['*'])
*/
class UserProjectTSGalerieDRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_p_t_s_g_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTSGalerieD::class;
    }
}
