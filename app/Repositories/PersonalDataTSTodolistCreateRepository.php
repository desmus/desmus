<?php

namespace App\Repositories;

use App\Models\PersonalDataTSTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:08 am UTC
 *
 * @method PersonalDataTSTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSTodolistCreate find($id, $columns = ['*'])
 * @method PersonalDataTSTodolistCreate first($columns = ['*'])
*/
class PersonalDataTSTodolistCreateRepository extends BaseRepository
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
        return PersonalDataTSTodolistCreate::class;
    }
}
