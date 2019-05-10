<?php

namespace App\Repositories;

use App\Models\JobTSNote;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSNoteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method JobTSNote findWithoutFail($id, $columns = ['*'])
 * @method JobTSNote find($id, $columns = ['*'])
 * @method JobTSNote first($columns = ['*'])
*/
class JobTSNoteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'content',
        'views_quantity',
        'updates_quantity',
        'status',
        'job_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSNote::class;
    }
}
