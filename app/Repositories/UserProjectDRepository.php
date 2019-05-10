<?php

namespace App\Repositories;

use App\Models\UserProjectD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:02 pm UTC
 *
 * @method UserProjectD findWithoutFail($id, $columns = ['*'])
 * @method UserProjectD find($id, $columns = ['*'])
 * @method UserProjectD first($columns = ['*'])
*/
class UserProjectDRepository extends BaseRepository
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
        return UserProjectD::class;
    }
}
