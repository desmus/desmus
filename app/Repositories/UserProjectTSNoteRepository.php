<?php

namespace App\Repositories;

use App\Models\UserProjectTSNote;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSNoteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserProjectTSNote findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSNote find($id, $columns = ['*'])
 * @method UserProjectTSNote first($columns = ['*'])
*/
class UserProjectTSNoteRepository extends BaseRepository
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
        'project_t_s_note_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTSNote::class;
    }
}
