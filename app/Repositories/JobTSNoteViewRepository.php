<?php

namespace App\Repositories;

use App\Models\JobTSNoteView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSNoteViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method JobTSNoteView findWithoutFail($id, $columns = ['*'])
 * @method JobTSNoteView find($id, $columns = ['*'])
 * @method JobTSNoteView first($columns = ['*'])
*/
class JobTSNoteViewRepository extends BaseRepository
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
        return JobTSNoteView::class;
    }
}
