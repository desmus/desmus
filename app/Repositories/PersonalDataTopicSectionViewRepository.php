<?php

namespace App\Repositories;

use App\Models\PersonalDataTopicSectionView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTopicSectionViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method PersonalDataTopicSectionView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTopicSectionView find($id, $columns = ['*'])
 * @method PersonalDataTopicSectionView first($columns = ['*'])
*/
class PersonalDataTopicSectionViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'personal_data_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTopicSectionView::class;
    }
}
