<?php

namespace App\Repositories;

use App\Models\PersonalDataTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:34 am UTC
 *
 * @method PersonalDataTodolist findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTodolist find($id, $columns = ['*'])
 * @method PersonalDataTodolist first($columns = ['*'])
*/
class PersonalDataTodolistRepository extends BaseRepository
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
        'personal_data_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTodolist::class;
    }
}
