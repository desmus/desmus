<?php

namespace App\Repositories;

use App\Models\UserJobC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:52 pm UTC
 *
 * @method UserJobC findWithoutFail($id, $columns = ['*'])
 * @method UserJobC find($id, $columns = ['*'])
 * @method UserJobC first($columns = ['*'])
*/
class UserJobCRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_j_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobC::class;
    }
}
