<?php

namespace App\Repositories;

use App\Models\UserProjectTSGalerieU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSGalerieURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:01 pm UTC
 *
 * @method UserProjectTSGalerieU findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSGalerieU find($id, $columns = ['*'])
 * @method UserProjectTSGalerieU first($columns = ['*'])
*/
class UserProjectTSGalerieURepository extends BaseRepository
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
        return UserProjectTSGalerieU::class;
    }
}
