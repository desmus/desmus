<?php

namespace App\Repositories;

use App\Models\CollegeTSNoteUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSNoteUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method CollegeTSNoteUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSNoteUpdate find($id, $columns = ['*'])
 * @method CollegeTSNoteUpdate first($columns = ['*'])
*/
class CollegeTSNoteUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'college_t_s_note_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSNoteUpdate::class;
    }
}
