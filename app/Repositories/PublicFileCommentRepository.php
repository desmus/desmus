<?php

namespace App\Repositories;

use App\Models\PublicFileComment;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicFileCommentRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:22 pm UTC
 *
 * @method PublicFileComment findWithoutFail($id, $columns = ['*'])
 * @method PublicFileComment find($id, $columns = ['*'])
 * @method PublicFileComment first($columns = ['*'])
*/
class PublicFileCommentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        'public_file_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicFileComment::class;
    }
}
