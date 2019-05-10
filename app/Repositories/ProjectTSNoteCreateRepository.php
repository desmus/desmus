<?php

namespace App\Repositories;

use App\Models\ProjectTSNoteCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSNoteCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method ProjectTSNoteCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSNoteCreate find($id, $columns = ['*'])
 * @method ProjectTSNoteCreate first($columns = ['*'])
*/
class ProjectTSNoteCreateRepository extends BaseRepository
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
        return ProjectTSNoteCreate::class;
    }
}
