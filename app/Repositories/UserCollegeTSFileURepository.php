<?php

namespace App\Repositories;

use App\Models\UserCollegeTSFileU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSFileURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:00 pm UTC
 *
 * @method UserCollegeTSFileU findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSFileU find($id, $columns = ['*'])
 * @method UserCollegeTSFileU first($columns = ['*'])
*/
class UserCollegeTSFileURepository extends BaseRepository
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
        return UserCollegeTSFileU::class;
    }
}
