<?php

namespace App\Repositories;

use App\Models\UserProjectTSToolFileD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSToolFileDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:08 pm UTC
 *
 * @method UserProjectTSToolFileD findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSToolFileD find($id, $columns = ['*'])
 * @method UserProjectTSToolFileD first($columns = ['*'])
*/
class UserProjectTSToolFileDRepository extends BaseRepository
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
        return UserProjectTSToolFileD::class;
    }
}
