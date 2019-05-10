<?php

namespace App\Repositories;

use App\Models\UserJobTSToolFileU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSToolFileURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:02 pm UTC
 *
 * @method UserJobTSToolFileU findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSToolFileU find($id, $columns = ['*'])
 * @method UserJobTSToolFileU first($columns = ['*'])
*/
class UserJobTSToolFileURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_j_t_s_t_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTSToolFileU::class;
    }
}
