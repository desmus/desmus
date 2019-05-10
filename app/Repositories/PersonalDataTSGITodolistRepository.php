<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGITodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGITodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:35 am UTC
 *
 * @method PersonalDataTSGITodolist findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGITodolist find($id, $columns = ['*'])
 * @method PersonalDataTSGITodolist first($columns = ['*'])
*/
class PersonalDataTSGITodolistRepository extends BaseRepository
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
        'p_d_t_s_g_i_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSGITodolist::class;
    }
}
