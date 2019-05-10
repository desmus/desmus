<?php

namespace App\Repositories;

use App\Models\UserJobTopicD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTopicDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:02 pm UTC
 *
 * @method UserJobTopicD findWithoutFail($id, $columns = ['*'])
 * @method UserJobTopicD find($id, $columns = ['*'])
 * @method UserJobTopicD first($columns = ['*'])
*/
class UserJobTopicDRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_j_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTopicD::class;
    }
}
