<?php

namespace App\Repositories;

use App\Models\CalendarEventUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CalendarEventUpdateRepository
 * @package App\Repositories
 * @version May 26, 2018, 8:13 pm UTC
 *
 * @method CalendarEventUpdate findWithoutFail($id, $columns = ['*'])
 * @method CalendarEventUpdate find($id, $columns = ['*'])
 * @method CalendarEventUpdate first($columns = ['*'])
*/
class CalendarEventUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'calendar_event_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CalendarEventUpdate::class;
    }
}
