<?php

namespace App\Repositories;

use App\Models\PersonalDataTSNoteUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSNoteUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method PersonalDataTSNoteUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSNoteUpdate find($id, $columns = ['*'])
 * @method PersonalDataTSNoteUpdate first($columns = ['*'])
*/
class PersonalDataTSNoteUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'personal_data_t_s_note_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSNoteUpdate::class;
    }
}
