<?php

namespace App\Repositories;

use App\Models\PersonalDataTSToolView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSToolViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method PersonalDataTSToolView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSToolView find($id, $columns = ['*'])
 * @method PersonalDataTSToolView first($columns = ['*'])
*/
class PersonalDataTSToolViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'personal_data_t_s_tool_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSToolView::class;
    }
}
