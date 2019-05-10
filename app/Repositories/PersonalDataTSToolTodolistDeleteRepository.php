<?php

namespace App\Repositories;

use App\Models\PersonalDataTSToolTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSToolTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:16 am UTC
 *
 * @method PersonalDataTSToolTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSToolTodolistDelete find($id, $columns = ['*'])
 * @method PersonalDataTSToolTodolistDelete first($columns = ['*'])
*/
class PersonalDataTSToolTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSToolTodolistDelete::class;
    }
}
