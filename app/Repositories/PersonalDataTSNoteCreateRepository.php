<?php

namespace App\Repositories;

use App\Models\PersonalDataTSNoteCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSNoteCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method PersonalDataTSNoteCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSNoteCreate find($id, $columns = ['*'])
 * @method PersonalDataTSNoteCreate first($columns = ['*'])
*/
class PersonalDataTSNoteCreateRepository extends BaseRepository
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
        return PersonalDataTSNoteCreate::class;
    }
}
