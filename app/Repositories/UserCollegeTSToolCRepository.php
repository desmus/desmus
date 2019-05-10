<?php

namespace App\Repositories;

use App\Models\UserCollegeTSToolC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSToolCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:54 pm UTC
 *
 * @method UserCollegeTSToolC findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSToolC find($id, $columns = ['*'])
 * @method UserCollegeTSToolC first($columns = ['*'])
*/
class UserCollegeTSToolCRepository extends BaseRepository
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
        return UserCollegeTSToolC::class;
    }
}
