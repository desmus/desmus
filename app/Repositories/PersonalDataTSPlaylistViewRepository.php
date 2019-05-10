<?php

namespace App\Repositories;

use App\Models\PersonalDataTSPlaylistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSPlaylistViewRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:08 pm UTC
 *
 * @method PersonalDataTSPlaylistView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSPlaylistView find($id, $columns = ['*'])
 * @method PersonalDataTSPlaylistView first($columns = ['*'])
*/
class PersonalDataTSPlaylistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSPlaylistView::class;
    }
}
