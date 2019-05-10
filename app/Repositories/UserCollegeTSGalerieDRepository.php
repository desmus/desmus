<?php

namespace App\Repositories;

use App\Models\UserCollegeTSGalerieD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSGalerieDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:05 pm UTC
 *
 * @method UserCollegeTSGalerieD findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSGalerieD find($id, $columns = ['*'])
 * @method UserCollegeTSGalerieD first($columns = ['*'])
*/
class UserCollegeTSGalerieDRepository extends BaseRepository
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
        return UserCollegeTSGalerieD::class;
    }
}
