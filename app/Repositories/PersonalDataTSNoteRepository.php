<?php

namespace App\Repositories;

use App\Models\PersonalDataTSNote;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSNoteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method PersonalDataTSNote findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSNote find($id, $columns = ['*'])
 * @method PersonalDataTSNote first($columns = ['*'])
*/
class PersonalDataTSNoteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'content',
        'views_quantity',
        'updates_quantity',
        'status',
        'personal_data_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSNote::class;
    }
}
