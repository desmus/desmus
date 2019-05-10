<?php

namespace App\Repositories;

use App\Models\UserCollegeTSGaleryImageD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSGaleryImageDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:07 pm UTC
 *
 * @method UserCollegeTSGaleryImageD findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSGaleryImageD find($id, $columns = ['*'])
 * @method UserCollegeTSGaleryImageD first($columns = ['*'])
*/
class UserCollegeTSGaleryImageDRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_c_t_s_g_i_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTSGaleryImageD::class;
    }
}
