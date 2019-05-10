<?php

namespace App\Repositories;

use App\Models\UserProjectTSToolFileC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSToolFileCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:55 pm UTC
 *
 * @method UserProjectTSToolFileC findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSToolFileC find($id, $columns = ['*'])
 * @method UserProjectTSToolFileC first($columns = ['*'])
*/
class UserProjectTSToolFileCRepository extends BaseRepository
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
        return UserProjectTSToolFileC::class;
    }
}
