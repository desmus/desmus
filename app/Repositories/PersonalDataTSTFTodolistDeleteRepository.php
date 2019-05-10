<?php

namespace App\Repositories;

use App\Models\PersonalDataTSTFTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSTFTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:17 am UTC
 *
 * @method PersonalDataTSTFTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSTFTodolistDelete find($id, $columns = ['*'])
 * @method PersonalDataTSTFTodolistDelete first($columns = ['*'])
*/
class PersonalDataTSTFTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_t_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSTFTodolistDelete::class;
    }
}
