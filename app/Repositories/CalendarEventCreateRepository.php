<?php

namespace App\Repositories;

use App\Models\CalendarEventCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CalendarEventCreateRepository
 * @package App\Repositories
 * @version May 26, 2018, 8:12 pm UTC
 *
 * @method CalendarEventCreate findWithoutFail($id, $columns = ['*'])
 * @method CalendarEventCreate find($id, $columns = ['*'])
 * @method CalendarEventCreate first($columns = ['*'])
*/
class CalendarEventCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'calendar_event_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CalendarEventCreate::class;
    }
}
