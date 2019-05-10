<?php

namespace App\Repositories;

use App\Models\UserProjectTSFileC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSFileCRepository
 * @package App\Repositories
 * @version November 8, 2018, 6:17 am UTC
 *
 * @method UserProjectTSFileC findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSFileC find($id, $columns = ['*'])
 * @method UserProjectTSFileC first($columns = ['*'])
*/
class UserProjectTSFileCRepository extends BaseRepository
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
        return UserProjectTSFileC::class;
    }
}
