<?php

namespace App\Repositories;

use App\Models\UserJobTopicU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTopicURepository
 * @package App\Repositories
 * @version June 18, 2018, 8:59 pm UTC
 *
 * @method UserJobTopicU findWithoutFail($id, $columns = ['*'])
 * @method UserJobTopicU find($id, $columns = ['*'])
 * @method UserJobTopicU first($columns = ['*'])
*/
class UserJobTopicURepository extends BaseRepository
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
        return UserJobTopicU::class;
    }
}
