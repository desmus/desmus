<?php

namespace App\Repositories;

use App\Models\PublicFileView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicFileViewRepository
 * @package App\Repositories
 * @version January 20, 2019, 3:45 am UTC
 *
 * @method PublicFileView findWithoutFail($id, $columns = ['*'])
 * @method PublicFileView find($id, $columns = ['*'])
 * @method PublicFileView first($columns = ['*'])
*/
class PublicFileViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'public_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicFileView::class;
    }
}
