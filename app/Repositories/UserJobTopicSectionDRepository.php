<?php

namespace App\Repositories;

use App\Models\UserJobTopicSectionD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTopicSectionDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:03 pm UTC
 *
 * @method UserJobTopicSectionD findWithoutFail($id, $columns = ['*'])
 * @method UserJobTopicSectionD find($id, $columns = ['*'])
 * @method UserJobTopicSectionD first($columns = ['*'])
*/
class UserJobTopicSectionDRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_j_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTopicSectionD::class;
    }
}
