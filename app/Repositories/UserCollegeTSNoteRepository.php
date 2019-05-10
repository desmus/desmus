<?php

namespace App\Repositories;

use App\Models\UserCollegeTSNote;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSNoteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserCollegeTSNote findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSNote find($id, $columns = ['*'])
 * @method UserCollegeTSNote first($columns = ['*'])
*/
class UserCollegeTSNoteRepository extends BaseRepository
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
        'college_t_s_note_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTSNote::class;
    }
}
