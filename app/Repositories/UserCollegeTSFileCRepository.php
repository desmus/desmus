<?php

namespace App\Repositories;

use App\Models\UserCollegeTSFileC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSFileCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:53 pm UTC
 *
 * @method UserCollegeTSFileC findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSFileC find($id, $columns = ['*'])
 * @method UserCollegeTSFileC first($columns = ['*'])
*/
class UserCollegeTSFileCRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_c_t_s_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTSFileC::class;
    }
}
