<?php

namespace App\Repositories;

use App\Models\UserProjectTSGalerieC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSGalerieCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:54 pm UTC
 *
 * @method UserProjectTSGalerieC findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSGalerieC find($id, $columns = ['*'])
 * @method UserProjectTSGalerieC first($columns = ['*'])
*/
class UserProjectTSGalerieCRepository extends BaseRepository
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
        return UserProjectTSGalerieC::class;
    }
}
