<?php

namespace App\Repositories;

use App\Models\UserCollegeTSToolFileU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSToolFileURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:01 pm UTC
 *
 * @method UserCollegeTSToolFileU findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSToolFileU find($id, $columns = ['*'])
 * @method UserCollegeTSToolFileU first($columns = ['*'])
*/
class UserCollegeTSToolFileURepository extends BaseRepository
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
        return UserCollegeTSToolFileU::class;
    }
}
