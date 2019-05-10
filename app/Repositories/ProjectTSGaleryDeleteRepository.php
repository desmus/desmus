<?php

namespace App\Repositories;

use App\Models\ProjectTSGaleryDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGaleryDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:55 pm UTC
 *
 * @method ProjectTSGaleryDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGaleryDelete find($id, $columns = ['*'])
 * @method ProjectTSGaleryDelete first($columns = ['*'])
*/
class ProjectTSGaleryDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'project_t_s_galery_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSGaleryDelete::class;
    }
}
