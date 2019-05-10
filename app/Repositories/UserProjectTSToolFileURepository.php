<?php

namespace App\Repositories;

use App\Models\UserProjectTSToolFileU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSToolFileURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:02 pm UTC
 *
 * @method UserProjectTSToolFileU findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSToolFileU find($id, $columns = ['*'])
 * @method UserProjectTSToolFileU first($columns = ['*'])
*/
class UserProjectTSToolFileURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_p_t_s_t_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTSToolFileU::class;
    }
}
