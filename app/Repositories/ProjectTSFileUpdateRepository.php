<?php

namespace App\Repositories;

use App\Models\ProjectTSFileUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSFileUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method ProjectTSFileUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSFileUpdate find($id, $columns = ['*'])
 * @method ProjectTSFileUpdate first($columns = ['*'])
*/
class ProjectTSFileUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'project_t_s_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSFileUpdate::class;
    }
}
