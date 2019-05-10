<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGaleryImageView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGaleryImageViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method PersonalDataTSGaleryImageView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGaleryImageView find($id, $columns = ['*'])
 * @method PersonalDataTSGaleryImageView first($columns = ['*'])
*/
class PersonalDataTSGaleryImageViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_g_i_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSGaleryImageView::class;
    }
}
