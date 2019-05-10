<?php

namespace App\Repositories;

use App\Models\PublicFileCommentResponse;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicFileCommentResponseRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:22 pm UTC
 *
 * @method PublicFileCommentResponse findWithoutFail($id, $columns = ['*'])
 * @method PublicFileCommentResponse find($id, $columns = ['*'])
 * @method PublicFileCommentResponse first($columns = ['*'])
*/
class PublicFileCommentResponseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        'public_file_comment_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicFileCommentResponse::class;
    }
}
