<?php

namespace App\Repositories;

use App\Models\JobTSNoteDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSNoteDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:54 pm UTC
 *
 * @method JobTSNoteDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTSNoteDelete find($id, $columns = ['*'])
 * @method JobTSNoteDelete first($columns = ['*'])
*/
class JobTSNoteDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'job_t_s_note_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSNoteDelete::class;
    }
}
