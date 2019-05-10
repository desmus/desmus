<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSNote;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSNoteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserPersonalDataTSNote findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSNote find($id, $columns = ['*'])
 * @method UserPersonalDataTSNote first($columns = ['*'])
*/
class UserPersonalDataTSNoteRepository extends BaseRepository
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
        'personal_data_t_s_note_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTSNote::class;
    }
}
