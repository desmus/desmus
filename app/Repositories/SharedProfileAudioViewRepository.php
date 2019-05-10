<?php

namespace App\Repositories;

use App\Models\SharedProfileAudioView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileAudioViewRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:29 pm UTC
 *
 * @method SharedProfileAudioView findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileAudioView find($id, $columns = ['*'])
 * @method SharedProfileAudioView first($columns = ['*'])
*/
class SharedProfileAudioViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        's_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileAudioView::class;
    }
}
