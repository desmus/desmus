<?php

namespace App\Repositories;

use App\Models\JobTSNoteCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSNoteCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method JobTSNoteCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTSNoteCreate find($id, $columns = ['*'])
 * @method JobTSNoteCreate first($columns = ['*'])
*/
class JobTSNoteCreateRepository extends BaseRepository
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
        return JobTSNoteCreate::class;
    }
}
