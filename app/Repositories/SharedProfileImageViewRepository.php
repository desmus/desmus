<?php

namespace App\Repositories;

use App\Models\SharedProfileImageView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileImageViewRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:29 pm UTC
 *
 * @method SharedProfileImageView findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileImageView find($id, $columns = ['*'])
 * @method SharedProfileImageView first($columns = ['*'])
*/
class SharedProfileImageViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        's_p_i_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileImageView::class;
    }
}
