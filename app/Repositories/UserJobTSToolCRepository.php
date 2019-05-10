<?php

namespace App\Repositories;

use App\Models\UserJobTSToolC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSToolCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:55 pm UTC
 *
 * @method UserJobTSToolC findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSToolC find($id, $columns = ['*'])
 * @method UserJobTSToolC first($columns = ['*'])
*/
class UserJobTSToolCRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_j_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTSToolC::class;
    }
}
