<?php

namespace App\Repositories;

use App\Models\PersonalDataTSToolFileView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSToolFileViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method PersonalDataTSToolFileView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSToolFileView find($id, $columns = ['*'])
 * @method PersonalDataTSToolFileView first($columns = ['*'])
*/
class PersonalDataTSToolFileViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'personal_d_t_s_t_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSToolFileView::class;
    }
}
