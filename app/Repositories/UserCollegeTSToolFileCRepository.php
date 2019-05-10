<?php

namespace App\Repositories;

use App\Models\UserCollegeTSToolFileC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSToolFileCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:55 pm UTC
 *
 * @method UserCollegeTSToolFileC findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSToolFileC find($id, $columns = ['*'])
 * @method UserCollegeTSToolFileC first($columns = ['*'])
*/
class UserCollegeTSToolFileCRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_c_t_s_t_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTSToolFileC::class;
    }
}
