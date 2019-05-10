<?php

namespace App\Repositories;

use App\Models\SharedProfileVideoView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileVideoViewRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:29 pm UTC
 *
 * @method SharedProfileVideoView findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileVideoView find($id, $columns = ['*'])
 * @method SharedProfileVideoView first($columns = ['*'])
*/
class SharedProfileVideoViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        's_p_v_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileVideoView::class;
    }
}
