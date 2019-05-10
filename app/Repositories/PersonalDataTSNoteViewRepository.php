<?php

namespace App\Repositories;

use App\Models\PersonalDataTSNoteView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSNoteViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method PersonalDataTSNoteView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSNoteView find($id, $columns = ['*'])
 * @method PersonalDataTSNoteView first($columns = ['*'])
*/
class PersonalDataTSNoteViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'personal_data_t_s_note_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSNoteView::class;
    }
}
