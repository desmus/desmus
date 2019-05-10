<?php

namespace App\Repositories;

use App\Models\CollegeTSNoteDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSNoteDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:54 pm UTC
 *
 * @method CollegeTSNoteDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSNoteDelete find($id, $columns = ['*'])
 * @method CollegeTSNoteDelete first($columns = ['*'])
*/
class CollegeTSNoteDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'college_t_s_note_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSNoteDelete::class;
    }
}
