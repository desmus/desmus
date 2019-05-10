<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class JobTSToolFileTodolistView
 * @package App\Models
 * @version May 30, 2018, 3:13 am UTC
 *
 * @property \App\Models\JobTSToolFileTodolist jobTSToolFileTodolist
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection calendarEventCreates
 * @property \Illuminate\Database\Eloquent\Collection calendarEventDeletes
 * @property \Illuminate\Database\Eloquent\Collection calendarEventUpdates
 * @property \Illuminate\Database\Eloquent\Collection calendarEventViews
 * @property \Illuminate\Database\Eloquent\Collection collegeCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSFileCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSFileDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSFileTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSFileTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSFileTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSFileTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTSFileUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSFileViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGImageTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGImageTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGImageTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGImageTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryImageCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryImageDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryImageUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryImageViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTSNoteCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSNoteDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSNoteTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSNoteTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSNoteTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSNoteTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTSNoteUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSNoteViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolFileCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolFileDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolFileTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolFileTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolFileTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolFileTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolFileUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolFileViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicSectionCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicSectionDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicSectionTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicSectionTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicSectionTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicSectionTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicSectionUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicSectionViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicViews
 * @property \Illuminate\Database\Eloquent\Collection collegeUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeViews
 * @property \Illuminate\Database\Eloquent\Collection contactCreates
 * @property \Illuminate\Database\Eloquent\Collection contactDeletes
 * @property \Illuminate\Database\Eloquent\Collection contactUpdates
 * @property \Illuminate\Database\Eloquent\Collection contactViews
 * @property \Illuminate\Database\Eloquent\Collection jobCreates
 * @property \Illuminate\Database\Eloquent\Collection jobDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSFileCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSFileDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSFileTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSFileTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSFileTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSFileTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection jobTSFileUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSFileViews
 * @property \Illuminate\Database\Eloquent\Collection jobTSGImageTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSGImageTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSGImageTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSGImageTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryImageCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryImageCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryImageDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryImageDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryImageUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryImageUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryImageViews
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryImageViews
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryViews
 * @property \Illuminate\Database\Eloquent\Collection jobTSNoteCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSNoteDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSNoteTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSNoteTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSNoteTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSNoteTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection jobTSNoteUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSNoteViews
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolFileCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolFileDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolFileTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolFileTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolFileTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolFileUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolFileViews
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolViews
 * @property \Illuminate\Database\Eloquent\Collection jobTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection jobTopicCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTopicDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTopicSectionCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTopicSectionDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTopicSectionTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTopicSectionTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTopicSectionTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTopicSectionTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection jobTopicSectionUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTopicSectionViews
 * @property \Illuminate\Database\Eloquent\Collection jobTopicTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTopicTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTopicTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTopicTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection jobTopicUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTopicViews
 * @property \Illuminate\Database\Eloquent\Collection jobUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobViews
 * @property \Illuminate\Database\Eloquent\Collection messageCreates
 * @property \Illuminate\Database\Eloquent\Collection messageDeletes
 * @property \Illuminate\Database\Eloquent\Collection messageViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSFTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSFTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSFTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSFTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSFileCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSFileDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSFileUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSFileViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGITodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGITodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGITodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGITodolistViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGaleryCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGaleryDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGaleryImageCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGaleryImageDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGaleryImageUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGaleryImageViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGaleryUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGaleryViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSNTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSNTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSNTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSNTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSNoteCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSNoteDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSNoteUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSNoteViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSTFTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSTFTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSTFTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSTFTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSTTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSTTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSTTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSTTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSToolCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSToolDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSToolFileCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSToolFileDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSToolFileUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSToolFileViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSToolUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSToolViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicSectionCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicSectionDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicSectionUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicSectionViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataViews
 * @property \Illuminate\Database\Eloquent\Collection projectCreates
 * @property \Illuminate\Database\Eloquent\Collection projectDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSFileCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSFileDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSFileTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSFileTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSFileTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSFileTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection projectTSFileUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSFileViews
 * @property \Illuminate\Database\Eloquent\Collection projectTSGImageTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSGImageTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSGImageTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSGImageTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryImageCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryImageDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryImageUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryImageViews
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryViews
 * @property \Illuminate\Database\Eloquent\Collection projectTSNoteCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSNoteDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSNoteTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSNoteTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSNoteTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSNoteTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection projectTSNoteUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSNoteViews
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolFileCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolFileDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolFileTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolFileTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolFileTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolFileTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolFileUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolFileViews
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolViews
 * @property \Illuminate\Database\Eloquent\Collection projectTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection projectTopicCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTopicDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTopicSectionCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTopicSectionDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTopicSectionTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTopicSectionTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTopicSectionTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTopicSectionTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection projectTopicSectionUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTopicSectionViews
 * @property \Illuminate\Database\Eloquent\Collection projectTopicTodolistCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTopicTodolistDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTopicTodolistUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTopicTodolistViews
 * @property \Illuminate\Database\Eloquent\Collection projectTopicUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTopicViews
 * @property \Illuminate\Database\Eloquent\Collection projectUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectViews
 * @property \Illuminate\Database\Eloquent\Collection userCollegeTSFiles
 * @property \Illuminate\Database\Eloquent\Collection userCollegeTSGaleries
 * @property \Illuminate\Database\Eloquent\Collection userCollegeTSGaleryImages
 * @property \Illuminate\Database\Eloquent\Collection userCollegeTSNotes
 * @property \Illuminate\Database\Eloquent\Collection userCollegeTSToolFiles
 * @property \Illuminate\Database\Eloquent\Collection userCollegeTSTools
 * @property \Illuminate\Database\Eloquent\Collection userCollegeTopicSections
 * @property \Illuminate\Database\Eloquent\Collection userCollegeTopics
 * @property \Illuminate\Database\Eloquent\Collection userColleges
 * @property \Illuminate\Database\Eloquent\Collection userJobTSFiles
 * @property \Illuminate\Database\Eloquent\Collection userJobTSGaleries
 * @property \Illuminate\Database\Eloquent\Collection userJobTSGaleryImages
 * @property \Illuminate\Database\Eloquent\Collection userJobTSNotes
 * @property \Illuminate\Database\Eloquent\Collection userJobTSToolFiles
 * @property \Illuminate\Database\Eloquent\Collection userJobTSTools
 * @property \Illuminate\Database\Eloquent\Collection userJobTopicSections
 * @property \Illuminate\Database\Eloquent\Collection userJobTopics
 * @property \Illuminate\Database\Eloquent\Collection userJobs
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDataTSFiles
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDataTSGaleries
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDataTSGaleryImages
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDataTSNotes
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDataTSToolFiles
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDataTSTools
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDataTopicSections
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDataTopics
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDatas
 * @property \Illuminate\Database\Eloquent\Collection userProjectTSFiles
 * @property \Illuminate\Database\Eloquent\Collection userProjectTSGaleries
 * @property \Illuminate\Database\Eloquent\Collection userProjectTSGaleryImages
 * @property \Illuminate\Database\Eloquent\Collection userProjectTSNotes
 * @property \Illuminate\Database\Eloquent\Collection userProjectTSToolFiles
 * @property \Illuminate\Database\Eloquent\Collection userProjectTSTools
 * @property \Illuminate\Database\Eloquent\Collection userProjectTopicSections
 * @property \Illuminate\Database\Eloquent\Collection userProjectTopics
 * @property \Illuminate\Database\Eloquent\Collection userProjects
 * @property string|\Carbon\Carbon datetime
 * @property integer user_id
 * @property integer j_t_s_t_f_t_id
 */
class JobTSToolFileTodolistView extends Model
{
    use SoftDeletes;

    public $table = 'job_t_s_tool_file_todolist_views';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'datetime',
        'user_id',
        'j_t_s_t_f_t_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'j_t_s_t_f_t_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function jobTSToolFileTodolist()
    {
        return $this->belongsTo(\App\Models\JobTSToolFileTodolist::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
