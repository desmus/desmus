<?php

namespace App\Repositories;

use App\Models\UserCalendarEvent;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCalendarEventRepository
 * @package App\Repositories
 * @version January 23, 2019, 4:24 pm UTC
 *
 * @method UserCalendarEvent findWithoutFail($id, $columns = ['*'])
 * @method UserCalendarEvent find($id, $columns = ['*'])
 * @method UserCalendarEvent first($columns = ['*'])
*/
class UserCalendarEventRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'description',
        'status',
        'permissions',
        'user_id',
        'calendar_event_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCalendarEvent::class;
    }
}
