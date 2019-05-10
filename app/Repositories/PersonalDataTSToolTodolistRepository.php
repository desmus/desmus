<?php

namespace App\Repositories;

use App\Models\PersonalDataTSToolTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSToolTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:35 am UTC
 *
 * @method PersonalDataTSToolTodolist findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSToolTodolist find($id, $columns = ['*'])
 * @method PersonalDataTSToolTodolist first($columns = ['*'])
*/
class PersonalDataTSToolTodolistRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'views_quantity',
        'updates_quantity',
        'status',
        'datetime',
        'p_d_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSToolTodolist::class;
    }
}
