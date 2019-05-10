<?php

namespace App\Repositories;

use App\Models\PersonalDataTSPTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSPTodolistRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:36 am UTC
 *
 * @method PersonalDataTSPTodolist findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSPTodolist find($id, $columns = ['*'])
 * @method PersonalDataTSPTodolist first($columns = ['*'])
*/
class PersonalDataTSPTodolistRepository extends BaseRepository
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
        'p_d_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSPTodolist::class;
    }
}
