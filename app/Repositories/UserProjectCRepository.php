<?php

namespace App\Repositories;

use App\Models\UserProjectC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:52 pm UTC
 *
 * @method UserProjectC findWithoutFail($id, $columns = ['*'])
 * @method UserProjectC find($id, $columns = ['*'])
 * @method UserProjectC first($columns = ['*'])
*/
class UserProjectCRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectC::class;
    }
}
