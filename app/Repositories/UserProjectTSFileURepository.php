<?php

namespace App\Repositories;

use App\Models\UserProjectTSFileU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSFileURepository
 * @package App\Repositories
 * @version November 8, 2018, 6:17 am UTC
 *
 * @method UserProjectTSFileU findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSFileU find($id, $columns = ['*'])
 * @method UserProjectTSFileU first($columns = ['*'])
*/
class UserProjectTSFileURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_p_t_s_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTSFileU::class;
    }
}
