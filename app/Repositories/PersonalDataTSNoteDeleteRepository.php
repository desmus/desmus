<?php

namespace App\Repositories;

use App\Models\PersonalDataTSNoteDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSNoteDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:55 pm UTC
 *
 * @method PersonalDataTSNoteDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSNoteDelete find($id, $columns = ['*'])
 * @method PersonalDataTSNoteDelete first($columns = ['*'])
*/
class PersonalDataTSNoteDeleteRepository extends BaseRepository
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
        return PersonalDataTSNoteDelete::class;
    }
}
