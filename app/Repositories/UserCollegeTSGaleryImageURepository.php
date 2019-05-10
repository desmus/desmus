<?php

namespace App\Repositories;

use App\Models\UserCollegeTSGaleryImageU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSGaleryImageURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:01 pm UTC
 *
 * @method UserCollegeTSGaleryImageU findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSGaleryImageU find($id, $columns = ['*'])
 * @method UserCollegeTSGaleryImageU first($columns = ['*'])
*/
class UserCollegeTSGaleryImageURepository extends BaseRepository
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
        return UserCollegeTSGaleryImageU::class;
    }
}
