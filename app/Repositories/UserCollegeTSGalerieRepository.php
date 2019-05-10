<?php

namespace App\Repositories;

use App\Models\UserCollegeTSGalerie;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSGalerieRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserCollegeTSGalerie findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSGalerie find($id, $columns = ['*'])
 * @method UserCollegeTSGalerie first($columns = ['*'])
*/
class UserCollegeTSGalerieRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'description',
        'status',
        'permissions',
        'user_id',
        'college_t_s_galery_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTSGalerie::class;
    }
}
