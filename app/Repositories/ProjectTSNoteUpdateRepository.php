<?php

namespace App\Repositories;

use App\Models\ProjectTSNoteUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSNoteUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method ProjectTSNoteUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSNoteUpdate find($id, $columns = ['*'])
 * @method ProjectTSNoteUpdate first($columns = ['*'])
*/
class ProjectTSNoteUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'project_t_s_note_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSNoteUpdate::class;
    }
}
