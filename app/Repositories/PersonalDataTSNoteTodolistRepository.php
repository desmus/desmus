<?php

namespace App\Repositories;

use App\Models\PersonalDataTSNoteTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSNoteTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:34 am UTC
 *
 * @method PersonalDataTSNoteTodolist findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSNoteTodolist find($id, $columns = ['*'])
 * @method PersonalDataTSNoteTodolist first($columns = ['*'])
*/
class PersonalDataTSNoteTodolistRepository extends BaseRepository
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
        'p_d_t_s_n_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSNoteTodolist::class;
    }
}
