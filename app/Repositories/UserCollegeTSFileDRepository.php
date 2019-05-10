<?php

namespace App\Repositories;

use App\Models\UserCollegeTSFileD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSFileDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:03 pm UTC
 *
 * @method UserCollegeTSFileD findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSFileD find($id, $columns = ['*'])
 * @method UserCollegeTSFileD first($columns = ['*'])
*/
class UserCollegeTSFileDRepository extends BaseRepository
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
        return UserCollegeTSFileD::class;
    }
}
