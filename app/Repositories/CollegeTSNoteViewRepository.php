<?php

namespace App\Repositories;

use App\Models\CollegeTSNoteView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSNoteViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method CollegeTSNoteView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSNoteView find($id, $columns = ['*'])
 * @method CollegeTSNoteView first($columns = ['*'])
*/
class CollegeTSNoteViewRepository extends BaseRepository
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
        return CollegeTSNoteView::class;
    }
}
