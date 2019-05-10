<?php

namespace App\Repositories;

use App\Models\ProjectTSNoteDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSNoteDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:54 pm UTC
 *
 * @method ProjectTSNoteDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSNoteDelete find($id, $columns = ['*'])
 * @method ProjectTSNoteDelete first($columns = ['*'])
*/
class ProjectTSNoteDeleteRepository extends BaseRepository
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
        return ProjectTSNoteDelete::class;
    }
}
