<?php

namespace App\Repositories;

use App\Models\UserJobTopicC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTopicCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:53 pm UTC
 *
 * @method UserJobTopicC findWithoutFail($id, $columns = ['*'])
 * @method UserJobTopicC find($id, $columns = ['*'])
 * @method UserJobTopicC first($columns = ['*'])
*/
class UserJobTopicCRepository extends BaseRepository
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
        return UserJobTopicC::class;
    }
}
