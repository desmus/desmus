<?php

namespace App\Repositories;

use App\Models\UserProjectTSToolD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSToolDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:06 pm UTC
 *
 * @method UserProjectTSToolD findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSToolD find($id, $columns = ['*'])
 * @method UserProjectTSToolD first($columns = ['*'])
*/
class UserProjectTSToolDRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_p_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTSToolD::class;
    }
}
