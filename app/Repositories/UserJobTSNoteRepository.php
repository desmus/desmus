<?php

namespace App\Repositories;

use App\Models\UserJobTSNote;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSNoteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserJobTSNote findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSNote find($id, $columns = ['*'])
 * @method UserJobTSNote first($columns = ['*'])
*/
class UserJobTSNoteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'description',
        'status',
        'permissions',
        'user_id',
        'job_t_s_note_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTSNote::class;
    }
}
