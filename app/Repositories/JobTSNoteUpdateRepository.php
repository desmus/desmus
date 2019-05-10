<?php

namespace App\Repositories;

use App\Models\JobTSNoteUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSNoteUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method JobTSNoteUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTSNoteUpdate find($id, $columns = ['*'])
 * @method JobTSNoteUpdate first($columns = ['*'])
*/
class JobTSNoteUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'job_t_s_note_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSNoteUpdate::class;
    }
}
