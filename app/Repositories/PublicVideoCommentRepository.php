<?php

namespace App\Repositories;

use App\Models\PublicVideoComment;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicVideoCommentRepository
 * @package App\Repositories
 * @version January 9, 2019, 11:10 pm UTC
 *
 * @method PublicVideoComment findWithoutFail($id, $columns = ['*'])
 * @method PublicVideoComment find($id, $columns = ['*'])
 * @method PublicVideoComment first($columns = ['*'])
*/
class PublicVideoCommentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        'public_video_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicVideoComment::class;
    }
}
