<?php

namespace App\Repositories;

use App\Models\UserCollegeTSToolD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSToolDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:06 pm UTC
 *
 * @method UserCollegeTSToolD findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSToolD find($id, $columns = ['*'])
 * @method UserCollegeTSToolD first($columns = ['*'])
*/
class UserCollegeTSToolDRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_c_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTSToolD::class;
    }
}
