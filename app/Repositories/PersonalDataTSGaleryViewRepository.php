<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGaleryView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGaleryViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method PersonalDataTSGaleryView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGaleryView find($id, $columns = ['*'])
 * @method PersonalDataTSGaleryView first($columns = ['*'])
*/
class PersonalDataTSGaleryViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'personal_d_t_s_g_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSGaleryView::class;
    }
}
