<?php

namespace App\Repositories;

use App\Models\UserProjectTSFileD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSFileDRepository
 * @package App\Repositories
 * @version November 8, 2018, 6:17 am UTC
 *
 * @method UserProjectTSFileD findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSFileD find($id, $columns = ['*'])
 * @method UserProjectTSFileD first($columns = ['*'])
*/
class UserProjectTSFileDRepository extends BaseRepository
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
        return UserProjectTSFileD::class;
    }
}
