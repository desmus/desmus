<?php

namespace App\Repositories;

use App\Models\CollegeTSNoteCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSNoteCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method CollegeTSNoteCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSNoteCreate find($id, $columns = ['*'])
 * @method CollegeTSNoteCreate first($columns = ['*'])
*/
class CollegeTSNoteCreateRepository extends BaseRepository
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
        return CollegeTSNoteCreate::class;
    }
}
