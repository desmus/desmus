<?php

namespace App\Repositories;

use App\Models\PersonalDataTSTFTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSTFTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:35 am UTC
 *
 * @method PersonalDataTSTFTodolist findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSTFTodolist find($id, $columns = ['*'])
 * @method PersonalDataTSTFTodolist first($columns = ['*'])
*/
class PersonalDataTSTFTodolistRepository extends BaseRepository
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
        'p_d_t_s_t_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSTFTodolist::class;
    }
}
