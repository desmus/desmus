<?php

namespace App\Repositories;

use App\Models\UserCollegeTSGalerieC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSGalerieCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:54 pm UTC
 *
 * @method UserCollegeTSGalerieC findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSGalerieC find($id, $columns = ['*'])
 * @method UserCollegeTSGalerieC first($columns = ['*'])
*/
class UserCollegeTSGalerieCRepository extends BaseRepository
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
        return UserCollegeTSGalerieC::class;
    }
}
