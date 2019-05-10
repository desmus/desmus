<?php

namespace App\Repositories;

use App\Models\PersonalDataTSTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method PersonalDataTSTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSTodolistDelete find($id, $columns = ['*'])
 * @method PersonalDataTSTodolistDelete first($columns = ['*'])
*/
class PersonalDataTSTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSTodolistDelete::class;
    }
}
