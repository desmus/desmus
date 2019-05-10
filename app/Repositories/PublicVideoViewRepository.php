<?php

namespace App\Repositories;

use App\Models\PublicVideoView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicVideoViewRepository
 * @package App\Repositories
 * @version January 20, 2019, 3:46 am UTC
 *
 * @method PublicVideoView findWithoutFail($id, $columns = ['*'])
 * @method PublicVideoView find($id, $columns = ['*'])
 * @method PublicVideoView first($columns = ['*'])
*/
class PublicVideoViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'public_video_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicVideoView::class;
    }
}
