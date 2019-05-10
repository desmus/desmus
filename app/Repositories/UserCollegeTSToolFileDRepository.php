<?php

namespace App\Repositories;

use App\Models\UserCollegeTSToolFileD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSToolFileDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:08 pm UTC
 *
 * @method UserCollegeTSToolFileD findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSToolFileD find($id, $columns = ['*'])
 * @method UserCollegeTSToolFileD first($columns = ['*'])
*/
class UserCollegeTSToolFileDRepository extends BaseRepository
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
        return UserCollegeTSToolFileD::class;
    }
}
