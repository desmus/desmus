<?php

namespace App\Repositories;

use App\Models\UserCollegeTSGalerieU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSGalerieURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:00 pm UTC
 *
 * @method UserCollegeTSGalerieU findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSGalerieU find($id, $columns = ['*'])
 * @method UserCollegeTSGalerieU first($columns = ['*'])
*/
class UserCollegeTSGalerieURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_c_t_s_g_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTSGalerieU::class;
    }
}
