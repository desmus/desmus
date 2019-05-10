<?php

namespace App\Repositories;

use App\Models\UserProjectTSToolC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSToolCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:55 pm UTC
 *
 * @method UserProjectTSToolC findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSToolC find($id, $columns = ['*'])
 * @method UserProjectTSToolC first($columns = ['*'])
*/
class UserProjectTSToolCRepository extends BaseRepository
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
        return UserProjectTSToolC::class;
    }
}
