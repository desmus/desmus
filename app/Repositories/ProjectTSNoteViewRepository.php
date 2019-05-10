<?php

namespace App\Repositories;

use App\Models\ProjectTSNoteView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSNoteViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method ProjectTSNoteView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSNoteView find($id, $columns = ['*'])
 * @method ProjectTSNoteView first($columns = ['*'])
*/
class ProjectTSNoteViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'project_t_s_note_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSNoteView::class;
    }
}
