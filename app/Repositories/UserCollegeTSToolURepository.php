<?php

namespace App\Repositories;

use App\Models\UserCollegeTSToolU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSToolURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:01 pm UTC
 *
 * @method UserCollegeTSToolU findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSToolU find($id, $columns = ['*'])
 * @method UserCollegeTSToolU first($columns = ['*'])
*/
class UserCollegeTSToolURepository extends BaseRepository
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
        return UserCollegeTSToolU::class;
    }
}
