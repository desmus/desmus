<?php

namespace App\Repositories;

use App\Models\ProjectTSToolFileUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolFileUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:52 pm UTC
 *
 * @method ProjectTSToolFileUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolFileUpdate find($id, $columns = ['*'])
 * @method ProjectTSToolFileUpdate first($columns = ['*'])
*/
class ProjectTSToolFileUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'project_t_s_t_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSToolFileUpdate::class;
    }
}
