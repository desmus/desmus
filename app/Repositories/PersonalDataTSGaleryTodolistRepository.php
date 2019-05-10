<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGaleryTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGaleryTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:35 am UTC
 *
 * @method PersonalDataTSGaleryTodolist findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGaleryTodolist find($id, $columns = ['*'])
 * @method PersonalDataTSGaleryTodolist first($columns = ['*'])
*/
class PersonalDataTSGaleryTodolistRepository extends BaseRepository
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
        'p_d_t_s_g_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSGaleryTodolist::class;
    }
}
