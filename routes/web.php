<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/sharedFile', 'SharedFileController@index')->name('sharedFile');

Auth::routes();

Route::get('/sharedFile', 'SharedFileController@index');

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/sharedFile', 'SharedFileController@index');

Route::get('/home', 'HomeController@index');

Route::resource('homes', 'HomeController');

Route::resource('publicProfile', 'PublicProfileController');

Route::resource('sharedProfile', 'SharedProfileController');

Route::resource('publicUser', 'PublicUserController');

Route::get('publicUser/{id}', ['as' => 'PublicUserController.show', 'uses' => 'PublicUserController@show']);

Route::resource('sharedProfileUser', 'SharedProfileUserController');

Route::get('sharedProfileUser/{id}', ['as' => 'SharedProfileUserController.show', 'uses' => 'SharedProfileUserController@show']);

Route::resource('sharedProfileFeed', 'SharedProfileFeedController');

Route::get('sharedProfileFeed/{id}', ['as' => 'SharedProfileFeedController.show', 'uses' => 'SharedProfileFeedController@show']);

Route::resource('sharedFiles', 'SharedFileController');

Route::resource('colleges', 'CollegeController');

Route::resource('jobs', 'JobController');

Route::resource('projects', 'ProjectController');

Route::resource('personalDatas', 'PersonalDataController');

Route::resource('collegeTopics', 'CollegeTopicController');

Route::resource('jobTopics', 'JobTopicController');

Route::resource('projectTopics', 'ProjectTopicController');

Route::resource('personalDataTopics', 'PersonalDataTopicController');

Route::resource('collegeTopicSections', 'CollegeTopicSectionController');

Route::resource('jobTopicSections', 'JobTopicSectionController');

Route::resource('projectTopicSections', 'ProjectTopicSectionController');

Route::resource('personalDataTopicSections', 'PersonalDataTopicSectionController');

Route::resource('collegeTSFiles', 'CollegeTSFileController');

Route::resource('jobTSFiles', 'JobTSFileController');

Route::resource('projectTSFiles', 'ProjectTSFileController');

Route::resource('personalDataTSFiles', 'PersonalDataTSFileController');

Route::resource('collegeTSNotes', 'CollegeTSNoteController');

Route::resource('jobTSNotes', 'JobTSNoteController');

Route::resource('projectTSNotes', 'ProjectTSNoteController');

Route::resource('personalDataTSNotes', 'PersonalDataTSNoteController');

Route::resource('collegeTSGaleries', 'CollegeTSGalerieController');

Route::resource('jobTSGaleries', 'JobTSGalerieController');

Route::resource('projectTSGaleries', 'ProjectTSGalerieController');

Route::resource('personalDataTSGaleries', 'PersonalDataTSGalerieController');

Route::resource('collegeTSTools', 'CollegeTSToolController');

Route::resource('jobTSTools', 'JobTSToolController');

Route::resource('projectTSTools', 'ProjectTSToolController');

Route::resource('personalDataTSTools', 'PersonalDataTSToolController');

Route::resource('collegeTSGaleryImages', 'CollegeTSGaleryImageController');

Route::resource('jobTSGaleryImages', 'JobTSGaleryImageController');

Route::resource('projectTSGaleryImages', 'ProjectTSGaleryImageController');

Route::resource('personalDataTSGaleryImages', 'PersonalDataTSGaleryImageController');

Route::resource('collegeTSToolFiles', 'CollegeTSToolFileController');

Route::resource('jobTSToolFiles', 'JobTSToolFileController');

Route::resource('projectTSToolFiles', 'ProjectTSToolFileController');

Route::resource('personalDataTSToolFiles', 'PersonalDataTSToolFileController');

Route::resource('userColleges', 'UserCollegeController');

Route::resource('userJobs', 'UserJobController');

Route::resource('userProjects', 'UserProjectController');

Route::resource('userPersonalDatas', 'UserPersonalDataController');

Route::resource('userCollegeTopics', 'UserCollegeTopicController');

Route::resource('userJobTopics', 'UserJobTopicController');

Route::resource('userProjectTopics', 'UserProjectTopicController');

Route::resource('userPersonalDataTopics', 'UserPersonalDataTopicController');

Route::resource('userCollegeTopicSections', 'UserCollegeTopicSectionController');

Route::resource('userJobTopicSections', 'UserJobTopicSectionController');

Route::resource('userProjectTopicSections', 'UserProjectTopicSectionController');

Route::resource('userPersonalDataTopicSections', 'UserPersonalDataTopicSectionController');

Route::resource('userCollegeTSFiles', 'UserCollegeTSFileController');

Route::resource('userJobTSFiles', 'UserJobTSFileController');

Route::resource('userProjectTSFiles', 'UserProjectTSFileController');

Route::resource('userPersonalDataTSFiles', 'UserPersonalDataTSFileController');

Route::resource('userCollegeTSNotes', 'UserCollegeTSNoteController');

Route::resource('userJobTSNotes', 'UserJobTSNoteController');

Route::resource('userProjectTSNotes', 'UserProjectTSNoteController');

Route::resource('userPersonalDataTSNotes', 'UserPersonalDataTSNoteController');

Route::resource('userCollegeTSGaleries', 'UserCollegeTSGalerieController');

Route::resource('userJobTSGaleries', 'UserJobTSGalerieController');

Route::resource('userProjectTSGaleries', 'UserProjectTSGalerieController');

Route::resource('userPersonalDataTSGaleries', 'UserPersonalDataTSGalerieController');

Route::resource('userCollegeTSTools', 'UserCollegeTSToolController');

Route::resource('userJobTSTools', 'UserJobTSToolController');

Route::resource('userProjectTSTools', 'UserProjectTSToolController');

Route::resource('userPersonalDataTSTools', 'UserPersonalDataTSToolController');

Route::resource('userCollegeTSGaleryImages', 'UserCollegeTSGaleryImageController');

Route::resource('userJobTSGaleryImages', 'UserJobTSGaleryImageController');

Route::resource('userProjectTSGaleryImages', 'UserProjectTSGaleryImageController');

Route::resource('userPersonalDataTSGaleryImages', 'UserPersonalDataTSGaleryImageController');

Route::resource('userCollegeTSToolFiles', 'UserCollegeTSToolFileController');

Route::resource('userJobTSToolFiles', 'UserJobTSToolFileController');

Route::resource('userProjectTSToolFiles', 'UserProjectTSToolFileController');

Route::resource('userPersonalDataTSToolFiles', 'UserPersonalDataTSToolFileController');

Route::resource('collegeCreates', 'CollegeCreateController');

Route::resource('jobCreates', 'JobCreateController');

Route::resource('projectCreates', 'ProjectCreateController');

Route::resource('personalDataCreates', 'PersonalDataCreateController');

Route::resource('collegeTopicCreates', 'CollegeTopicCreateController');

Route::resource('jobTopicCreates', 'JobTopicCreateController');

Route::resource('projectTopicCreates', 'ProjectTopicCreateController');

Route::resource('personalDataTopicCreates', 'PersonalDataTopicCreateController');

Route::resource('collegeTopicSectionCreates', 'CollegeTopicSectionCreateController');

Route::resource('jobTopicSectionCreates', 'JobTopicSectionCreateController');

Route::resource('projectTopicSectionCreates', 'ProjectTopicSectionCreateController');

Route::resource('personalDataTopicSectionCreates', 'PersonalDataTopicSectionCreateController');

Route::resource('collegeTSFileCreates', 'CollegeTSFileCreateController');

Route::resource('jobTSFileCreates', 'JobTSFileCreateController');

Route::resource('projectTSFileCreates', 'ProjectTSFileCreateController');

Route::resource('personalDataTSFileCreates', 'PersonalDataTSFileCreateController');

Route::resource('collegeTSNoteCreates', 'CollegeTSNoteCreateController');

Route::resource('jobTSNoteCreates', 'JobTSNoteCreateController');

Route::resource('projectTSNoteCreates', 'ProjectTSNoteCreateController');

Route::resource('personalDataTSNoteCreates', 'PersonalDataTSNoteCreateController');

Route::resource('collegeTSGaleryCreates', 'CollegeTSGaleryCreateController');

Route::resource('jobTSGaleryCreates', 'JobTSGaleryCreateController');

Route::resource('projectTSGaleryCreates', 'ProjectTSGaleryCreateController');

Route::resource('personalDataTSGaleryCreates', 'PersonalDataTSGaleryCreateController');

Route::resource('collegeTSToolCreates', 'CollegeTSToolCreateController');

Route::resource('jobTSToolCreates', 'JobTSToolCreateController');

Route::resource('projectTSToolCreates', 'ProjectTSToolCreateController');

Route::resource('personalDataTSToolCreates', 'PersonalDataTSToolCreateController');

Route::resource('collegeTSGaleryImageCreates', 'CollegeTSGaleryImageCreateController');

Route::resource('projectTSGaleryImageCreates', 'ProjectTSGaleryImageCreateController');

Route::resource('personalDataTSGaleryImageCreates', 'PersonalDataTSGaleryImageCreateController');

Route::resource('collegeTSToolFileCreates', 'CollegeTSToolFileCreateController');

Route::resource('jobTSToolFileCreates', 'JobTSToolFileCreateController');

Route::resource('projectTSToolFileCreates', 'ProjectTSToolFileCreateController');

Route::resource('personalDataTSToolFileCreates', 'PersonalDataTSToolFileCreateController');

Route::resource('collegeViews', 'CollegeViewController');

Route::resource('jobViews', 'JobViewController');

Route::resource('projectViews', 'ProjectViewController');

Route::resource('personalDataViews', 'PersonalDataViewController');

Route::resource('collegeTopicViews', 'CollegeTopicViewController');

Route::resource('jobTopicViews', 'JobTopicViewController');

Route::resource('projectTopicViews', 'ProjectTopicViewController');

Route::resource('personalDataTopicViews', 'PersonalDataTopicViewController');

Route::resource('collegeTopicSectionViews', 'CollegeTopicSectionViewController');

Route::resource('jobTopicSectionViews', 'JobTopicSectionViewController');

Route::resource('projectTopicSectionViews', 'ProjectTopicSectionViewController');

Route::resource('personalDataTopicSectionViews', 'PersonalDataTopicSectionViewController');

Route::resource('collegeTSFileViews', 'CollegeTSFileViewController');

Route::resource('jobTSFileViews', 'JobTSFileViewController');

Route::resource('projectTSFileViews', 'ProjectTSFileViewController');

Route::resource('personalDataTSFileViews', 'PersonalDataTSFileViewController');

Route::resource('collegeTSNoteViews', 'CollegeTSNoteViewController');

Route::resource('jobTSNoteViews', 'JobTSNoteViewController');

Route::resource('projectTSNoteViews', 'ProjectTSNoteViewController');

Route::resource('personalDataTSNoteViews', 'PersonalDataTSNoteViewController');

Route::resource('collegeTSGaleryViews', 'CollegeTSGaleryViewController');

Route::resource('jobTSGaleryViews', 'JobTSGaleryViewController');

Route::resource('projectTSGaleryViews', 'ProjectTSGaleryViewController');

Route::resource('personalDataTSGaleryViews', 'PersonalDataTSGaleryViewController');

Route::resource('collegeTSToolViews', 'CollegeTSToolViewController');

Route::resource('jobTSToolViews', 'JobTSToolViewController');

Route::resource('projectTSToolViews', 'ProjectTSToolViewController');

Route::resource('personalDataTSToolViews', 'PersonalDataTSToolViewController');

Route::resource('collegeTSGaleryImageViews', 'CollegeTSGaleryImageViewController');

Route::resource('projectTSGaleryImageViews', 'ProjectTSGaleryImageViewController');

Route::resource('personalDataTSGaleryImageViews', 'PersonalDataTSGaleryImageViewController');

Route::resource('collegeTSToolFileViews', 'CollegeTSToolFileViewController');

Route::resource('jobTSToolFileViews', 'JobTSToolFileViewController');

Route::resource('projectTSToolFileViews', 'ProjectTSToolFileViewController');

Route::resource('personalDataTSToolFileViews', 'PersonalDataTSToolFileViewController');

Route::resource('collegeUpdates', 'CollegeUpdateController');

Route::resource('jobUpdates', 'JobUpdateController');

Route::resource('projectUpdates', 'ProjectUpdateController');

Route::resource('personalDataUpdates', 'PersonalDataUpdateController');

Route::resource('collegeTopicUpdates', 'CollegeTopicUpdateController');

Route::resource('jobTopicUpdates', 'JobTopicUpdateController');

Route::resource('projectTopicUpdates', 'ProjectTopicUpdateController');

Route::resource('personalDataTopicUpdates', 'PersonalDataTopicUpdateController');

Route::resource('collegeTopicSectionUpdates', 'CollegeTopicSectionUpdateController');

Route::resource('jobTopicSectionUpdates', 'JobTopicSectionUpdateController');

Route::resource('projectTopicSectionUpdates', 'ProjectTopicSectionUpdateController');

Route::resource('personalDataTopicSectionUpdates', 'PersonalDataTopicSectionUpdateController');

Route::resource('collegeTSFileUpdates', 'CollegeTSFileUpdateController');

Route::resource('jobTSFileUpdates', 'JobTSFileUpdateController');

Route::resource('projectTSFileUpdates', 'ProjectTSFileUpdateController');

Route::resource('personalDataTSFileUpdates', 'PersonalDataTSFileUpdateController');

Route::resource('collegeTSNoteUpdates', 'CollegeTSNoteUpdateController');

Route::resource('jobTSNoteUpdates', 'JobTSNoteUpdateController');

Route::resource('projectTSNoteUpdates', 'ProjectTSNoteUpdateController');

Route::resource('personalDataTSNoteUpdates', 'PersonalDataTSNoteUpdateController');

Route::resource('collegeTSGaleryUpdates', 'CollegeTSGaleryUpdateController');

Route::resource('jobTSGaleryUpdates', 'JobTSGaleryUpdateController');

Route::resource('projectTSGaleryUpdates', 'ProjectTSGaleryUpdateController');

Route::resource('personalDataTSGaleryUpdates', 'PersonalDataTSGaleryUpdateController');

Route::resource('collegeTSToolUpdates', 'CollegeTSToolUpdateController');

Route::resource('jobTSToolUpdates', 'JobTSToolUpdateController');

Route::resource('projectTSToolUpdates', 'ProjectTSToolUpdateController');

Route::resource('personalDataTSToolUpdates', 'PersonalDataTSToolUpdateController');

Route::resource('collegeTSGaleryImageUpdates', 'CollegeTSGaleryImageUpdateController');

Route::resource('projectTSGaleryImageUpdates', 'ProjectTSGaleryImageUpdateController');

Route::resource('personalDataTSGaleryImageUpdates', 'PersonalDataTSGaleryImageUpdateController');

Route::resource('collegeTSToolFileUpdates', 'CollegeTSToolFileUpdateController');

Route::resource('jobTSToolFileUpdates', 'JobTSToolFileUpdateController');

Route::resource('projectTSToolFileUpdates', 'ProjectTSToolFileUpdateController');

Route::resource('personalDataTSToolFileUpdates', 'PersonalDataTSToolFileUpdateController');

Route::resource('collegeDeletes', 'CollegeDeleteController');

Route::resource('jobDeletes', 'JobDeleteController');

Route::resource('projectDeletes', 'ProjectDeleteController');

Route::resource('personalDataDeletes', 'PersonalDataDeleteController');

Route::resource('collegeTopicDeletes', 'CollegeTopicDeleteController');

Route::resource('jobTopicDeletes', 'JobTopicDeleteController');

Route::resource('projectTopicDeletes', 'ProjectTopicDeleteController');

Route::resource('personalDataTopicDeletes', 'PersonalDataTopicDeleteController');

Route::resource('collegeTopicSectionDeletes', 'CollegeTopicSectionDeleteController');

Route::resource('jobTopicSectionDeletes', 'JobTopicSectionDeleteController');

Route::resource('projectTopicSectionDeletes', 'ProjectTopicSectionDeleteController');

Route::resource('personalDataTopicSectionDeletes', 'PersonalDataTopicSectionDeleteController');

Route::resource('collegeTSFileDeletes', 'CollegeTSFileDeleteController');

Route::resource('jobTSFileDeletes', 'JobTSFileDeleteController');

Route::resource('projectTSFileDeletes', 'ProjectTSFileDeleteController');

Route::resource('personalDataTSFileDeletes', 'PersonalDataTSFileDeleteController');

Route::resource('collegeTSNoteDeletes', 'CollegeTSNoteDeleteController');

Route::resource('jobTSNoteDeletes', 'JobTSNoteDeleteController');

Route::resource('projectTSNoteDeletes', 'ProjectTSNoteDeleteController');

Route::resource('personalDataTSNoteDeletes', 'PersonalDataTSNoteDeleteController');

Route::resource('collegeTSGaleryDeletes', 'CollegeTSGaleryDeleteController');

Route::resource('jobTSGaleryDeletes', 'JobTSGaleryDeleteController');

Route::resource('projectTSGaleryDeletes', 'ProjectTSGaleryDeleteController');

Route::resource('personalDataTSGaleryDeletes', 'PersonalDataTSGaleryDeleteController');

Route::resource('collegeTSToolDeletes', 'CollegeTSToolDeleteController');

Route::resource('jobTSToolDeletes', 'JobTSToolDeleteController');

Route::resource('projectTSToolDeletes', 'ProjectTSToolDeleteController');

Route::resource('personalDataTSToolDeletes', 'PersonalDataTSToolDeleteController');

Route::resource('collegeTSGaleryImageDeletes', 'CollegeTSGaleryImageDeleteController');

Route::resource('projectTSGaleryImageDeletes', 'ProjectTSGaleryImageDeleteController');

Route::resource('personalDataTSGaleryImageDeletes', 'PersonalDataTSGaleryImageDeleteController');

Route::resource('collegeTSToolFileDeletes', 'CollegeTSToolFileDeleteController');

Route::resource('jobTSToolFileDeletes', 'JobTSToolFileDeleteController');

Route::resource('projectTSToolFileDeletes', 'ProjectTSToolFileDeleteController');

Route::resource('personalDataTSToolFileDeletes', 'PersonalDataTSToolFileDeleteController');

Route::resource('contacts', 'ContactController');

Route::resource('contactCreates', 'ContactCreateController');

Route::resource('contactViews', 'ContactViewController');

Route::resource('contactUpdates', 'ContactUpdateController');

Route::resource('contactDeletes', 'ContactDeleteController');

Route::resource('jobTSGaleryImageCreates', 'JobTSGaleryImageCreateController');

Route::resource('jobTSGaleryImageViews', 'JobTSGaleryImageViewController');

Route::resource('jobTSGaleryImageUpdates', 'JobTSGaleryImageUpdateController');

Route::resource('jobTSGaleryImageDeletes', 'JobTSGaleryImageDeleteController');

Route::get('createCollegeTopic/{id}', ['as' => 'collegeTopics.create', 'uses' => 'CollegeTopicController@create']);

Route::get('createCollegeTopicSection/{id}', ['as' => 'collegeTopicSections.create', 'uses' => 'CollegeTopicSectionController@create']);

Route::get('createCollegeTSFile/{id}', ['as' => 'collegeTSFiles.create', 'uses' => 'CollegeTSFileController@create']);

Route::get('createCollegeTSNote/{id}', ['as' => 'collegeTSNotes.create', 'uses' => 'CollegeTSNoteController@create']);

Route::get('createCollegeTSGalerie/{id}', ['as' => 'collegeTSGaleries.create', 'uses' => 'CollegeTSGalerieController@create']);

Route::get('createCollegeTSTool/{id}', ['as' => 'collegeTSTools.create', 'uses' => 'CollegeTSToolController@create']);

Route::get('createCollegeTSGaleryImage/{id}', ['as' => 'collegeTSGaleryImages.create', 'uses' => 'CollegeTSGaleryImageController@create']);

Route::get('createCollegeTSToolFile/{id}', ['as' => 'collegeTSToolFiles.create', 'uses' => 'CollegeTSToolFileController@create']);

Route::post('/store_college_file', "CollegeTSFileController@store");

Route::post('/store_college_image', "CollegeTSGaleryImageController@store");

Route::post('/store_college_tool', "CollegeTSToolFileController@store");

Route::get('destroyCollegeTSGaleryImage/{id}', ['as' => 'collegeTSGaleryImages.destroy', 'uses' => 'CollegeTSGaleryImageController@destroy']);

Route::get('createUserCollege/{id}', ['as' => 'userColleges.create', 'uses' => 'UserCollegeController@create']);

Route::get('createUserCollegeTopic/{id}', ['as' => 'userCollegeTopics.create', 'uses' => 'UserCollegeTopicController@create']);

Route::get('createUserCollegeTopicSection/{id}', ['as' => 'userCollegeTopicSections.create', 'uses' => 'UserCollegeTopicSectionController@create']);

Route::get('createUserCollegeTSFile/{id}', ['as' => 'userCollegeTSFiles.create', 'uses' => 'UserCollegeTSFileController@create']);

Route::get('createUserCollegeTSNote/{id}', ['as' => 'userCollegeTSNotes.create', 'uses' => 'UserCollegeTSNoteController@create']);

Route::get('createUserCollegeTSGalerie/{id}', ['as' => 'userCollegeTSGaleries.create', 'uses' => 'UserCollegeTSGalerieController@create']);

Route::get('createUserCollegeTSTool/{id}', ['as' => 'userCollegeTSTools.create', 'uses' => 'UserCollegeTSToolController@create']);

Route::get('createUserCollegeTSGaleryImage/{id}', ['as' => 'userCollegeTSGaleryImages.create', 'uses' => 'UserCollegeTSGaleryImageController@create']);

Route::get('createUserCollegeTSToolFile/{id}', ['as' => 'userCollegeTSToolFiles.create', 'uses' => 'UserCollegeTSToolFileController@create']);

Route::get('/UserSearch','UserSearchController@search');

Route::get('/CollegeTopicSearch','CollegeTopicSearchController@search');

Route::get('/CollegeTopicSectionSearch','CollegeTopicSectionSearchController@search');

Route::get('/CollegeTSFileSearch','CollegeTSFileSearchController@search');

Route::get('/CollegeTSNoteSearch','CollegeTSNoteSearchController@search');

Route::get('/CollegeTSGalerySearch','CollegeTSGalerySearchController@search');

Route::get('/CollegeTSToolSearch','CollegeTSToolSearchController@search');

Route::get('/CollegeTSPlaylistSearch','CollegeTSPlaylistSearchController@search');

Route::get('/CollegeTSGaleryImageSearch','CollegeTSGaleryImageSearchController@search');

Route::get('/CollegeTSToolFileSearch','CollegeTSToolFileSearchController@search');

Route::get('createJobTopic/{id}', ['as' => 'jobTopics.create', 'uses' => 'JobTopicController@create']);

Route::get('createJobTopicSection/{id}', ['as' => 'jobTopicSections.create', 'uses' => 'JobTopicSectionController@create']);

Route::get('createJobTSFile/{id}', ['as' => 'jobTSFiles.create', 'uses' => 'JobTSFileController@create']);

Route::get('createJobTSNote/{id}', ['as' => 'jobTSNotes.create', 'uses' => 'JobTSNoteController@create']);

Route::get('createJobTSGalerie/{id}', ['as' => 'jobTSGaleries.create', 'uses' => 'JobTSGalerieController@create']);

Route::get('createJobTSTool/{id}', ['as' => 'jobTSTools.create', 'uses' => 'JobTSToolController@create']);

Route::get('createJobTSGaleryImage/{id}', ['as' => 'jobTSGaleryImages.create', 'uses' => 'JobTSGaleryImageController@create']);

Route::get('createJobTSToolFile/{id}', ['as' => 'jobTSToolFiles.create', 'uses' => 'JobTSToolFileController@create']);

Route::post('/store_job_file', "JobTSFileController@store");

Route::post('/store_job_image', "JobTSGaleryImageController@store");

Route::post('/store_job_tool', "JobTSToolFileController@store");

Route::get('destroyJobTSGaleryImage/{id}', ['as' => 'jobTSGaleryImages.destroy', 'uses' => 'JobTSGaleryImageController@destroy']);

Route::get('createUserJob/{id}', ['as' => 'userJobs.create', 'uses' => 'UserJobController@create']);

Route::get('createUserJobTopic/{id}', ['as' => 'userJobTopics.create', 'uses' => 'UserJobTopicController@create']);

Route::get('createUserJobTopicSection/{id}', ['as' => 'userJobTopicSections.create', 'uses' => 'UserJobTopicSectionController@create']);

Route::get('createUserJobTSFile/{id}', ['as' => 'userJobTSFiles.create', 'uses' => 'UserJobTSFileController@create']);

Route::get('createUserJobTSNote/{id}', ['as' => 'userJobTSNotes.create', 'uses' => 'UserJobTSNoteController@create']);

Route::get('createUserJobTSGalerie/{id}', ['as' => 'userJobTSGaleries.create', 'uses' => 'UserJobTSGalerieController@create']);

Route::get('createUserJobTSTool/{id}', ['as' => 'userJobTSTools.create', 'uses' => 'UserJobTSToolController@create']);

Route::get('createUserJobTSGaleryImage/{id}', ['as' => 'userJobTSGaleryImages.create', 'uses' => 'UserJobTSGaleryImageController@create']);

Route::get('createUserJobTSToolFile/{id}', ['as' => 'userJobTSToolFiles.create', 'uses' => 'UserJobTSToolFileController@create']);

Route::get('/JobTopicSearch','JobTopicSearchController@search');

Route::get('/JobTopicSectionSearch','JobTopicSectionSearchController@search');

Route::get('/JobTSFileSearch','JobTSFileSearchController@search');

Route::get('/JobTSNoteSearch','JobTSNoteSearchController@search');

Route::get('/JobTSGalerySearch','JobTSGalerySearchController@search');

Route::get('/JobTSPlaylistSearch','JobTSPlaylistSearchController@search');

Route::get('/JobTSToolSearch','JobTSToolSearchController@search');

Route::get('/JobTSGaleryImageSearch','JobTSGaleryImageSearchController@search');

Route::get('/JobTSToolFileSearch','JobTSToolFileSearchController@search');

Route::get('createProjectTopic/{id}', ['as' => 'projectTopics.create', 'uses' => 'ProjectTopicController@create']);

Route::get('createProjectTopicSection/{id}', ['as' => 'projectTopicSections.create', 'uses' => 'ProjectTopicSectionController@create']);

Route::get('createProjectTSFile/{id}', ['as' => 'projectTSFiles.create', 'uses' => 'ProjectTSFileController@create']);

Route::get('createProjectTSNote/{id}', ['as' => 'projectTSNotes.create', 'uses' => 'ProjectTSNoteController@create']);

Route::get('createProjectTSGalerie/{id}', ['as' => 'projectTSGaleries.create', 'uses' => 'ProjectTSGalerieController@create']);

Route::get('createProjectTSTool/{id}', ['as' => 'projectTSTools.create', 'uses' => 'ProjectTSToolController@create']);

Route::get('createProjectTSGaleryImage/{id}', ['as' => 'projectTSGaleryImages.create', 'uses' => 'ProjectTSGaleryImageController@create']);

Route::get('createProjectTSToolFile/{id}', ['as' => 'projectTSToolFiles.create', 'uses' => 'ProjectTSToolFileController@create']);

Route::post('/store_project_file', "ProjectTSFileController@store");

Route::post('/store_project_image', "ProjectTSGaleryImageController@store");

Route::post('/store_project_tool', "ProjectTSToolFileController@store");

Route::get('destroyProjectTSGaleryImage/{id}', ['as' => 'projectTSGaleryImages.destroy', 'uses' => 'ProjectTSGaleryImageController@destroy']);

Route::get('createUserProject/{id}', ['as' => 'userProjects.create', 'uses' => 'UserProjectController@create']);

Route::get('createUserProjectTopic/{id}', ['as' => 'userProjectTopics.create', 'uses' => 'UserProjectTopicController@create']);

Route::get('createUserProjectTopicSection/{id}', ['as' => 'userProjectTopicSections.create', 'uses' => 'UserProjectTopicSectionController@create']);

Route::get('createUserProjectTSFile/{id}', ['as' => 'userProjectTSFiles.create', 'uses' => 'UserProjectTSFileController@create']);

Route::get('createUserProjectTSNote/{id}', ['as' => 'userProjectTSNotes.create', 'uses' => 'UserProjectTSNoteController@create']);

Route::get('createUserProjectTSGalerie/{id}', ['as' => 'userProjectTSGaleries.create', 'uses' => 'UserProjectTSGalerieController@create']);

Route::get('createUserProjectTSTool/{id}', ['as' => 'userProjectTSTools.create', 'uses' => 'UserProjectTSToolController@create']);

Route::get('createUserProjectTSGaleryImage/{id}', ['as' => 'userProjectTSGaleryImages.create', 'uses' => 'UserProjectTSGaleryImageController@create']);

Route::get('createUserProjectTSToolFile/{id}', ['as' => 'userProjectTSToolFiles.create', 'uses' => 'UserProjectTSToolFileController@create']);

Route::get('/ProjectTopicSearch','ProjectTopicSearchController@search');

Route::get('/ProjectTopicSectionSearch','ProjectTopicSectionSearchController@search');

Route::get('/ProjectTSFileSearch','ProjectTSFileSearchController@search');

Route::get('/ProjectTSNoteSearch','ProjectTSNoteSearchController@search');

Route::get('/ProjectTSGalerySearch','ProjectTSGalerySearchController@search');

Route::get('/ProjectTSPlaylistSearch','ProjectTSPlaylistSearchController@search');

Route::get('/ProjectTSToolSearch','ProjectTSToolSearchController@search');

Route::get('/ProjectTSGaleryImageSearch','ProjectTSGaleryImageSearchController@search');

Route::get('/ProjectTSToolFileSearch','ProjectTSToolFileSearchController@search');

Route::get('createPersonalDataTopic/{id}', ['as' => 'personalDataTopics.create', 'uses' => 'PersonalDataTopicController@create']);

Route::get('createPersonalDataTopicSection/{id}', ['as' => 'personalDataTopicSections.create', 'uses' => 'PersonalDataTopicSectionController@create']);

Route::get('createPersonalDataTSFile/{id}', ['as' => 'personalDataTSFiles.create', 'uses' => 'PersonalDataTSFileController@create']);

Route::get('createPersonalDataTSNote/{id}', ['as' => 'personalDataTSNotes.create', 'uses' => 'PersonalDataTSNoteController@create']);

Route::get('createPersonalDataTSGalerie/{id}', ['as' => 'personalDataTSGaleries.create', 'uses' => 'PersonalDataTSGalerieController@create']);

Route::get('createPersonalDataTSTool/{id}', ['as' => 'personalDataTSTools.create', 'uses' => 'PersonalDataTSToolController@create']);

Route::get('createPersonalDataTSGaleryImage/{id}', ['as' => 'personalDataTSGaleryImages.create', 'uses' => 'PersonalDataTSGaleryImageController@create']);

Route::get('createPersonalDataTSToolFile/{id}', ['as' => 'personalDataTSToolFiles.create', 'uses' => 'PersonalDataTSToolFileController@create']);

Route::post('/store_personal_data_file', "PersonalDataTSFileController@store");

Route::post('/store_personal_data_image', "PersonalDataTSGaleryImageController@store");

Route::post('/store_personal_data_tool', "PersonalDataTSToolFileController@store");

Route::get('destroyPersonalDataTSGaleryImage/{id}', ['as' => 'personalDataTSGaleryImages.destroy', 'uses' => 'PersonalDataTSGaleryImageController@destroy']);

Route::get('createUserPersonalData/{id}', ['as' => 'userPersonalDatas.create', 'uses' => 'UserPersonalDataController@create']);

Route::get('createUserPersonalDataTopic/{id}', ['as' => 'userPersonalDataTopics.create', 'uses' => 'UserPersonalDataTopicController@create']);

Route::get('createUserPersonalDataTopicSection/{id}', ['as' => 'userPersonalDataTopicSections.create', 'uses' => 'UserPersonalDataTopicSectionController@create']);

Route::get('createUserPersonalDataTSFile/{id}', ['as' => 'userPersonalDataTSFiles.create', 'uses' => 'UserPersonalDataTSFileController@create']);

Route::get('createUserPersonalDataTSNote/{id}', ['as' => 'userPersonalDataTSNotes.create', 'uses' => 'UserPersonalDataTSNoteController@create']);

Route::get('createUserPersonalDataTSGalerie/{id}', ['as' => 'userPersonalDataTSGaleries.create', 'uses' => 'UserPersonalDataTSGalerieController@create']);

Route::get('createUserPersonalDataTSTool/{id}', ['as' => 'userPersonalDataTSTools.create', 'uses' => 'UserPersonalDataTSToolController@create']);

Route::get('createUserPersonalDataTSGaleryImage/{id}', ['as' => 'userPersonalDataTSGaleryImages.create', 'uses' => 'UserPersonalDataTSGaleryImageController@create']);

Route::get('createUserPersonalDataTSToolFile/{id}', ['as' => 'userPersonalDataTSToolFiles.create', 'uses' => 'UserPersonalDataTSToolFileController@create']);

Route::get('/PersonalDataTopicSearch','PersonalDataTopicSearchController@search');

Route::get('/PersonalDataTopicSectionSearch','PersonalDataTopicSectionSearchController@search');

Route::get('/PersonalDataTSFileSearch','PersonalDataTSFileSearchController@search');

Route::get('/PersonalDataTSNoteSearch','PersonalDataTSNoteSearchController@search');

Route::get('/PersonalDataTSGalerySearch','PersonalDataTSGalerySearchController@search');

Route::get('/PersonalDataTSPlaylistSearch','PersonalDataTSPlaylistSearchController@search');

Route::get('/PersonalDataTSToolSearch','PersonalDataTSToolSearchController@search');

Route::get('/PersonalDataTSGaleryImageSearch','PersonalDataTSGaleryImageSearchController@search');

Route::get('/PersonalDataTSToolFileSearch','PersonalDataTSToolFileSearchController@search');

Route::resource('calendarEvents', 'CalendarEventController');

Route::resource('calendarEventCreates', 'CalendarEventCreateController');

Route::resource('calendarEventViews', 'CalendarEventViewController');

Route::resource('calendarEventUpdates', 'CalendarEventUpdateController');

Route::resource('calendarEventDeletes', 'CalendarEventDeleteController');

Route::get('/GetCalendarEvent','HomeController@getEvents');

Route::post('/updateCalendarEvent/{id}', 'CalendarEventController@update');

//Route::post('updateCalendarEvent/{id}', ['as' => 'calendarEvents.update', 'uses' => 'CalendarEventController@update']);

Route::get('destroyCalendarEvent/{id}', ['as' => 'calendarEvents.destroy', 'uses' => 'CalendarEventController@destroy']);

Route::resource('messages', 'MessageController');

Route::resource('messageCreates', 'MessageCreateController');

Route::resource('messageViews', 'MessageViewController');

Route::resource('messageDeletes', 'MessageDeleteController');

Route::get('/MessagerSearch','MessagerSearchController@search');

Route::get('/MessagesSearch','MessagesSearchController@search');

Route::resource('collegeTodolists', 'CollegeTodolistController');

Route::resource('jobTodolists', 'JobTodolistController');

Route::resource('projectTodolists', 'ProjectTodolistController');

Route::resource('personalDataTodolists', 'PersonalDataTodolistController');

Route::resource('collegeTopicTodolists', 'CollegeTopicTodolistController');

Route::resource('jobTopicTodolists', 'JobTopicTodolistController');

Route::resource('projectTopicTodolists', 'ProjectTopicTodolistController');

Route::resource('personalDataTopicTodolists', 'PersonalDataTopicTodolistController');

Route::resource('collegeTopicSectionTodolists', 'CollegeTopicSectionTodolistController');

Route::resource('jobTopicSectionTodolists', 'JobTopicSectionTodolistController');

Route::resource('projectTopicSectionTodolists', 'ProjectTopicSectionTodolistController');

Route::resource('personalDataTSTodolists', 'PersonalDataTSTodolistController');

Route::resource('collegeTSFileTodolists', 'CollegeTSFileTodolistController');

Route::resource('jobTSFileTodolists', 'JobTSFileTodolistController');

Route::resource('projectTSFileTodolists', 'ProjectTSFileTodolistController');

Route::resource('personalDataTSNoteTodolists', 'PersonalDataTSNoteTodolistController');

Route::resource('collegeTSNoteTodolists', 'CollegeTSNoteTodolistController');

Route::resource('jobTSNoteTodolists', 'JobTSNoteTodolistController');

Route::resource('projectTSNoteTodolists', 'ProjectTSNoteTodolistController');

Route::resource('personalDataTSNoteTodolists', 'PersonalDataTSNoteTodolistController');

Route::resource('collegeTSGaleryTodolists', 'CollegeTSGaleryTodolistController');

Route::resource('jobTSGaleryTodolists', 'JobTSGaleryTodolistController');

Route::resource('projectTSGaleryTodolists', 'ProjectTSGaleryTodolistController');

Route::resource('personalDataTSGaleryTodolists', 'PersonalDataTSGaleryTodolistController');

Route::resource('collegeTSToolTodolists', 'CollegeTSToolTodolistController');

Route::resource('jobTSToolTodolists', 'JobTSToolTodolistController');

Route::resource('projectTSToolTodolists', 'ProjectTSToolTodolistController');

Route::resource('personalDataTSToolTodolists', 'PersonalDataTSToolTodolistController');

Route::resource('collegeTSGImageTodolists', 'CollegeTSGImageTodolistController');

Route::resource('jobTSGImageTodolists', 'JobTSGImageTodolistController');

Route::resource('projectTSGImageTodolists', 'ProjectTSGImageTodolistController');

Route::resource('personalDataTSGITodolists', 'PersonalDataTSGITodolistController');

Route::resource('collegeTSToolFileTodolists', 'CollegeTSToolFileTodolistController');

Route::resource('jobTSToolFileTodolists', 'JobTSToolFileTodolistController');

Route::resource('projectTSToolFileTodolists', 'ProjectTSToolFileTodolistController');

Route::resource('personalDataTSTFTodolists', 'PersonalDataTSTFTodolistController');

Route::resource('collegeTodolistCreates', 'CollegeTodolistCreateController');

Route::resource('jobTodolistCreates', 'JobTodolistCreateController');

Route::resource('projectTodolistCreates', 'ProjectTodolistCreateController');

Route::resource('personalDataTodolistCreates', 'PersonalDataTodolistCreateController');

Route::resource('collegeTopicTodolistCreates', 'CollegeTopicTodolistCreateController');

Route::resource('jobTopicTodolistCreates', 'JobTopicTodolistCreateController');

Route::resource('projectTopicTodolistCreates', 'ProjectTopicTodolistCreateController');

Route::resource('personalDataTopicTodolistCreates', 'PersonalDataTopicTodolistCreateController');

Route::resource('collegeTSTodolistCreates', 'CollegeTopicSectionTodolistCreateController');

Route::resource('jobTopicSectionTodolistCreates', 'JobTopicSectionTodolistCreateController');

Route::resource('projectTSTodolistCreates', 'ProjectTopicSectionTodolistCreateController');

Route::resource('personalDataTSTodolistCreates', 'PersonalDataTSTodolistCreateController');

Route::resource('collegeTSFileTodolistCreates', 'CollegeTSFileTodolistCreateController');

Route::resource('jobTSFileTodolistCreates', 'JobTSFileTodolistCreateController');

Route::resource('projectTSFileTodolistCreates', 'ProjectTSFileTodolistCreateController');

Route::resource('personalDataTSNoteTodolistCreates', 'PersonalDataTSNoteTodolistCreateController');

Route::resource('collegeTSNoteTodolistCreates', 'CollegeTSNoteTodolistCreateController');

Route::resource('jobTSNoteTodolistCreates', 'JobTSNoteTodolistCreateController');

Route::resource('projectTSNoteTodolistCreates', 'ProjectTSNoteTodolistCreateController');

Route::resource('collegeTSGaleryTodolistCreates', 'CollegeTSGaleryTodolistCreateController');

Route::resource('jobTSGaleryTodolistCreates', 'JobTSGaleryTodolistCreateController');

Route::resource('projectTSGaleryTodolistCreates', 'ProjectTSGaleryTodolistCreateController');

Route::resource('personalDataTSGTodolistCreates', 'PersonalDataTSGaleryTodolistCreateController');

Route::resource('collegeTSToolTodolistCreates', 'CollegeTSToolTodolistCreateController');

Route::resource('jobTSToolTodolistCreates', 'JobTSToolTodolistCreateController');

Route::resource('projectTSToolTodolistCreates', 'ProjectTSToolTodolistCreateController');

Route::resource('personalDataTSToolTodolistCreates', 'PersonalDataTSToolTodolistCreateController');

Route::resource('collegeTSGImageTodolistCreates', 'CollegeTSGImageTodolistCreateController');

Route::resource('jobTSGImageTodolistCreates', 'JobTSGImageTodolistCreateController');

Route::resource('projectTSGImageTodolistCreates', 'ProjectTSGImageTodolistCreateController');

Route::resource('personalDataTSGITodolistCreates', 'PersonalDataTSGITodolistCreateController');

Route::resource('collegeTSToolFileTodolistCreates', 'CollegeTSToolFileTodolistCreateController');

Route::resource('jobTSToolFileTodolistCreates', 'JobTSToolFileTodolistCreateController');

Route::resource('projectTSToolFileTodolistCreates', 'ProjectTSToolFileTodolistCreateController');

Route::resource('personalDataTSTFTodolistCreates', 'PersonalDataTSTFTodolistCreateController');

Route::resource('collegeTodolistViews', 'CollegeTodolistViewController');

Route::resource('jobTodolistViews', 'JobTodolistViewController');

Route::resource('projectTodolistViews', 'ProjectTodolistViewController');

Route::resource('personalDataTodolistViews', 'PersonalDataTodolistViewController');

Route::resource('collegeTopicTodolistViews', 'CollegeTopicTodolistViewController');

Route::resource('jobTopicTodolistViews', 'JobTopicTodolistViewController');

Route::resource('projectTopicTodolistViews', 'ProjectTopicTodolistViewController');

Route::resource('personalDataTopicTodolistViews', 'PersonalDataTopicTodolistViewController');

Route::resource('collegeTSTodolistViews', 'CollegeTopicSectionTodolistViewController');

Route::resource('jobTopicSectionTodolistViews', 'JobTopicSectionTodolistViewController');

Route::resource('projectTSTodolistViews', 'ProjectTopicSectionTodolistViewController');

Route::resource('personalDataTSTodolistViews', 'PersonalDataTSTodolistViewController');

Route::resource('collegeTSFileTodolistViews', 'CollegeTSFileTodolistViewController');

Route::resource('jobTSFileTodolistViews', 'JobTSFileTodolistViewController');

Route::resource('projectTSFileTodolistViews', 'ProjectTSFileTodolistViewController');

Route::resource('personalDataTSNoteTodolistViews', 'PersonalDataTSNoteTodolistViewController');

Route::resource('collegeTSNoteTodolistViews', 'CollegeTSNoteTodolistViewController');

Route::resource('jobTSNoteTodolistViews', 'JobTSNoteTodolistViewController');

Route::resource('projectTSNoteTodolistViews', 'ProjectTSNoteTodolistViewController');

Route::resource('personalDataTSNoteTodolistViews', 'PersonalDataTSNoteTodolistViewController');

Route::resource('collegeTSGaleryTodolistViews', 'CollegeTSGaleryTodolistViewController');

Route::resource('jobTSGaleryTodolistViews', 'JobTSGaleryTodolistViewController');

Route::resource('projectTSGaleryTodolistViews', 'ProjectTSGaleryTodolistViewController');

Route::resource('personalDataTSGTodolistViews', 'PersonalDataTSGaleryTodolistViewController');

Route::resource('collegeTSToolTodolistViews', 'CollegeTSToolTodolistViewController');

Route::resource('jobTSToolTodolistViews', 'JobTSToolTodolistViewController');

Route::resource('projectTSToolTodolistViews', 'ProjectTSToolTodolistViewController');

Route::resource('personalDataTSToolTodolistViews', 'PersonalDataTSToolTodolistViewController');

Route::resource('collegeTSGImageTodolistViews', 'CollegeTSGImageTodolistViewController');

Route::resource('jobTSGImageTodolistViews', 'JobTSGImageTodolistViewController');

Route::resource('projectTSGImageTodolistViews', 'ProjectTSGImageTodolistViewController');

Route::resource('personalDataTSGITodolistViews', 'PersonalDataTSGITodolistViewController');

Route::resource('collegeTSToolFileTodolistViews', 'CollegeTSToolFileTodolistViewController');

Route::resource('jobTSToolFileTodolistViews', 'JobTSToolFileTodolistViewController');

Route::resource('projectTSToolFileTodolistViews', 'ProjectTSToolFileTodolistViewController');

Route::resource('personalDataTSTFTodolistViews', 'PersonalDataTSTFTodolistViewController');

Route::resource('collegeTodolistUpdates', 'CollegeTodolistUpdateController');

Route::resource('jobTodolistUpdates', 'JobTodolistUpdateController');

Route::resource('projectTodolistUpdates', 'ProjectTodolistUpdateController');

Route::resource('personalDataTodolistUpdates', 'PersonalDataTodolistUpdateController');

Route::resource('collegeTopicTodolistUpdates', 'CollegeTopicTodolistUpdateController');

Route::resource('jobTopicTodolistUpdates', 'JobTopicTodolistUpdateController');

Route::resource('projectTopicTodolistUpdates', 'ProjectTopicTodolistUpdateController');

Route::resource('personalDataTopicTodolistUpdates', 'PersonalDataTopicTodolistUpdateController');

Route::resource('collegeTSTodolistUpdates', 'CollegeTopicSectionTodolistUpdateController');

Route::resource('jobTopicSectionTodolistUpdates', 'JobTopicSectionTodolistUpdateController');

Route::resource('projectTSTodolistUpdates', 'ProjectTopicSectionTodolistUpdateController');

Route::resource('personalDataTSTodolistUpdates', 'PersonalDataTSTodolistUpdateController');

Route::resource('collegeTSFileTodolistUpdates', 'CollegeTSFileTodolistUpdateController');

Route::resource('jobTSFileTodolistUpdates', 'JobTSFileTodolistUpdateController');

Route::resource('projectTSFileTodolistUpdates', 'ProjectTSFileTodolistUpdateController');

Route::resource('personalDataTSNoteTodolistUpdates', 'PersonalDataTSNoteTodolistUpdateController');

Route::resource('collegeTSNoteTodolistUpdates', 'CollegeTSNoteTodolistUpdateController');

Route::resource('jobTSNoteTodolistUpdates', 'JobTSNoteTodolistUpdateController');

Route::resource('projectTSNoteTodolistUpdates', 'ProjectTSNoteTodolistUpdateController');

Route::resource('collegeTSGaleryTodolistUpdates', 'CollegeTSGaleryTodolistUpdateController');

Route::resource('jobTSGaleryTodolistUpdates', 'JobTSGaleryTodolistUpdateController');

Route::resource('projectTSGaleryTodolistUpdates', 'ProjectTSGaleryTodolistUpdateController');

Route::resource('personalDataTSGTodolistUpdates', 'PersonalDataTSGaleryTodolistUpdateController');

Route::resource('collegeTSToolTodolistUpdates', 'CollegeTSToolTodolistUpdateController');

Route::resource('jobTSToolTodolistUpdates', 'JobTSToolTodolistUpdateController');

Route::resource('projectTSToolTodolistUpdates', 'ProjectTSToolTodolistUpdateController');

Route::resource('personalDataTSToolTodolistUpdates', 'PersonalDataTSToolTodolistUpdateController');

Route::resource('collegeTSGImageTodolistUpdates', 'CollegeTSGImageTodolistUpdateController');

Route::resource('jobTSGImageTodolistUpdates', 'JobTSGImageTodolistUpdateController');

Route::resource('projectTSGImageTodolistUpdates', 'ProjectTSGImageTodolistUpdateController');

Route::resource('personalDataTSGITodolistUpdates', 'PersonalDataTSGITodolistUpdateController');

Route::resource('collegeTSToolFileTodolistUpdates', 'CollegeTSToolFileTodolistUpdateController');

Route::resource('jobTSToolFileTodolistUpdates', 'JobTSToolFileTodolistUpdateController');

Route::resource('projectTSToolFileTodolistUpdates', 'ProjectTSToolFileTodolistUpdateController');

Route::resource('personalDataTSTFTodolistUpdates', 'PersonalDataTSTFTodolistUpdateController');

Route::resource('collegeTodolistDeletes', 'CollegeTodolistDeleteController');

Route::resource('jobTodolistDeletes', 'JobTodolistDeleteController');

Route::resource('projectTodolistDeletes', 'ProjectTodolistDeleteController');

Route::resource('personalDataTodolistDeletes', 'PersonalDataTodolistDeleteController');

Route::resource('collegeTopicTodolistDeletes', 'CollegeTopicTodolistDeleteController');

Route::resource('jobTopicTodolistDeletes', 'JobTopicTodolistDeleteController');

Route::resource('projectTopicTodolistDeletes', 'ProjectTopicTodolistDeleteController');

Route::resource('personalDataTopicTodolistDeletes', 'PersonalDataTopicTodolistDeleteController');

Route::resource('collegeTSTodolistDeletes', 'CollegeTopicSectionTodolistDeleteController');

Route::resource('jobTopicSectionTodolistDeletes', 'JobTopicSectionTodolistDeleteController');

Route::resource('projectTSTodolistDeletes', 'ProjectTopicSectionTodolistDeleteController');

Route::resource('personalDataTSTodolistDeletes', 'PersonalDataTSTodolistDeleteController');

Route::resource('collegeTSFileTodolistDeletes', 'CollegeTSFileTodolistDeleteController');

Route::resource('jobTSFileTodolistDeletes', 'JobTSFileTodolistDeleteController');

Route::resource('projectTSFileTodolistDeletes', 'ProjectTSFileTodolistDeleteController');

Route::resource('personalDataTSNoteTodolistDeletes', 'PersonalDataTSNoteTodolistDeleteController');

Route::resource('collegeTSNoteTodolistDeletes', 'CollegeTSNoteTodolistDeleteController');

Route::resource('jobTSNoteTodolistDeletes', 'JobTSNoteTodolistDeleteController');

Route::resource('projectTSNoteTodolistDeletes', 'ProjectTSNoteTodolistDeleteController');

Route::resource('collegeTSGaleryTodolistDeletes', 'CollegeTSGaleryTodolistDeleteController');

Route::resource('jobTSGaleryTodolistDeletes', 'JobTSGaleryTodolistDeleteController');

Route::resource('projectTSGaleryTodolistDeletes', 'ProjectTSGaleryTodolistDeleteController');

Route::resource('personalDataTSGTodolistDeletes', 'PersonalDataTSGaleryTodolistDeleteController');

Route::resource('collegeTSToolTodolistDeletes', 'CollegeTSToolTodolistDeleteController');

Route::resource('jobTSToolTodolistDeletes', 'JobTSToolTodolistDeleteController');

Route::resource('projectTSToolTodolistDeletes', 'ProjectTSToolTodolistDeleteController');

Route::resource('personalDataTSToolTodolistDeletes', 'PersonalDataTSToolTodolistDeleteController');

Route::resource('collegeTSGImageTodolistDeletes', 'CollegeTSGImageTodolistDeleteController');

Route::resource('jobTSGImageTodolistDeletes', 'JobTSGImageTodolistDeleteController');

Route::resource('projectTSGImageTodolistDeletes', 'ProjectTSGImageTodolistDeleteController');

Route::resource('personalDataTSGITodolistDeletes', 'PersonalDataTSGITodolistDeleteController');

Route::resource('collegeTSToolFileTodolistDeletes', 'CollegeTSToolFileTodolistDeleteController');

Route::resource('jobTSToolFileTodolistDeletes', 'JobTSToolFileTodolistDeleteController');

Route::resource('projectTSToolFileTodolistDeletes', 'ProjectTSToolFileTodolistDeleteController');

Route::resource('personalDataTSTFTodolistDeletes', 'PersonalDataTSTFTodolistDeleteController');

Route::resource('recentActivities', 'RecentActivityController');

Route::resource('recentActivityCreates', 'RecentActivityCreateController');

Route::resource('recentActivityViews', 'RecentActivityViewController');

Route::resource('recentActivityUpdates', 'RecentActivityUpdateController');

Route::resource('recentActivityDeletes', 'RecentActivityDeleteController');

Route::resource('collegeTSPlaylists', 'CollegeTSPlaylistController');

Route::resource('collegeTSPlaylistCreates', 'CollegeTSPlaylistCreateController');

Route::resource('collegeTSPlaylistViews', 'CollegeTSPlaylistViewController');

Route::resource('collegeTSPlaylistUpdates', 'CollegeTSPlaylistUpdateController');

Route::resource('collegeTSPlaylistDeletes', 'CollegeTSPlaylistDeleteController');

Route::resource('jobTSPlaylists', 'JobTSPlaylistController');

Route::resource('jobTSPlaylistCreates', 'JobTSPlaylistCreateController');

Route::resource('jobTSPlaylistViews', 'JobTSPlaylistViewController');

Route::resource('jobTSPlaylistUpdates', 'JobTSPlaylistUpdateController');

Route::resource('jobTSPlaylistDeletes', 'JobTSPlaylistDeleteController');

Route::resource('projectTSPlaylists', 'ProjectTSPlaylistController');

Route::resource('projectTSPlaylistCreates', 'ProjectTSPlaylistCreateController');

Route::resource('projectTSPlaylistViews', 'ProjectTSPlaylistViewController');

Route::resource('projectTSPlaylistUpdates', 'ProjectTSPlaylistUpdateController');

Route::resource('projectTSPlaylistDeletes', 'ProjectTSPlaylistDeleteController');

Route::resource('personalDataTSPlaylists', 'PersonalDataTSPlaylistController');

Route::resource('personalDataTSPlaylistCreates', 'PersonalDataTSPlaylistCreateController');

Route::resource('personalDataTSPlaylistViews', 'PersonalDataTSPlaylistViewController');

Route::resource('personalDataTSPlaylistUpdates', 'PersonalDataTSPlaylistUpdateController');

Route::resource('personalDataTSPlaylistDeletes', 'PersonalDataTSPlaylistDeleteController');

Route::get('createCollegeTSPlaylist/{id}', ['as' => 'collegeTSPlaylists.create', 'uses' => 'CollegeTSPlaylistController@create']);

Route::get('createJobTSPlaylist/{id}', ['as' => 'jobTSPlaylists.create', 'uses' => 'JobTSPlaylistController@create']);

Route::get('createProjectTSPlaylist/{id}', ['as' => 'projectTSPlaylists.create', 'uses' => 'ProjectTSPlaylistController@create']);

Route::get('createPersonalDataTSPlaylist/{id}', ['as' => 'personalDataTSPlaylists.create', 'uses' => 'PersonalDataTSPlaylistController@create']);

Route::resource('userCollegeTSPlaylists', 'UserCollegeTSPlaylistController');

Route::resource('uCTSPlaylistCreates', 'UCTSPlaylistCreateController');

Route::resource('uCTSPlaylistUpdates', 'UCTSPlaylistUpdateController');

Route::resource('uCTSPlaylistDeletes', 'UCTSPlaylistDeleteController');

Route::resource('userJobTSPlaylists', 'UserJobTSPlaylistController');

Route::resource('uCTSPlaylistCreates', 'UCTSPlaylistCreateController');

Route::resource('uCTSPlaylistUpdates', 'UCTSPlaylistUpdateController');

Route::resource('uCTSPlaylistDeletes', 'UCTSPlaylistDeleteController');

Route::resource('userProjectTSPlaylists', 'UserProjectTSPlaylistController');

Route::resource('uCTSPlaylistCreates', 'UCTSPlaylistCreateController');

Route::resource('uCTSPlaylistUpdates', 'UCTSPlaylistUpdateController');

Route::resource('uCTSPlaylistDeletes', 'UCTSPlaylistDeleteController');

Route::resource('uCTSPlaylistCreates', 'UCTSPlaylistCreateController');

Route::resource('uCTSPlaylistUpdates', 'UCTSPlaylistUpdateController');

Route::resource('uCTSPlaylistDeletes', 'UCTSPlaylistDeleteController');

Route::resource('userPersonalDataTSPs', 'UserPersonalDataTSPController');

Route::resource('collegeTSPAudios', 'CollegeTSPAudioController');

Route::resource('collegeTSPAudioCreates', 'CollegeTSPAudioCreateController');

Route::resource('collegeTSPAudioViews', 'CollegeTSPAudioViewController');

Route::resource('collegeTSPAudioUpdates', 'CollegeTSPAudioUpdateController');

Route::resource('collegeTSPAudioDeletes', 'CollegeTSPAudioDeleteController');

Route::resource('jobTSPAudios', 'JobTSPAudioController');

Route::resource('jobTSPAudioCreates', 'JobTSPAudioCreateController');

Route::resource('jobTSPAudioViews', 'JobTSPAudioViewController');

Route::resource('jobTSPAudioUpdates', 'JobTSPAudioUpdateController');

Route::resource('jobTSPAudioDeletes', 'JobTSPAudioDeleteController');

Route::resource('projectTSPAudios', 'ProjectTSPAudioController');

Route::resource('projectTSPAudioCreates', 'ProjectTSPAudioCreateController');

Route::resource('projectTSPAudioViews', 'ProjectTSPAudioViewController');

Route::resource('projectTSPAudioUpdates', 'ProjectTSPAudioUpdateController');

Route::resource('projectTSPAudioDeletes', 'ProjectTSPAudioDeleteController');

Route::resource('personalDataTSPAudios', 'PersonalDataTSPAudioController');

Route::resource('pDTSPAudioCreates', 'PDTSPAudioCreateController');

Route::resource('pDTSPAudioViews', 'PDTSPAudioViewController');

Route::resource('pDTSPAudioUpdates', 'PDTSPAudioUpdateController');

Route::resource('pDTSPAudioDeletes', 'PDTSPAudioDeleteController');

Route::resource('collegeTSPTodolists', 'CollegeTSPTodolistController');

Route::resource('collegeTSPTCreates', 'CollegeTSPTCreateController');

Route::resource('collegeTSPTViews', 'CollegeTSPTViewController');

Route::resource('collegeTSPTUpdates', 'CollegeTSPTUpdateController');

Route::resource('collegeTSPTDeletes', 'CollegeTSPTDeleteController');

Route::resource('jobTSPTodolists', 'JobTSPTodolistController');

Route::resource('jobTSPTCreates', 'JobTSPTCreateController');

Route::resource('jobTSPTViews', 'JobTSPTViewController');

Route::resource('jobTSPTUpdates', 'JobTSPTUpdateController');

Route::resource('jobTSPTDeletes', 'JobTSPTDeleteController');

Route::resource('projectTSPTodolists', 'ProjectTSPTodolistController');

Route::resource('projectTSPTCreates', 'ProjectTSPTCreateController');

Route::resource('projectTSPTViews', 'ProjectTSPTViewController');

Route::resource('projectTSPTUpdates', 'ProjectTSPTUpdateController');

Route::resource('projectTSPTDeletes', 'ProjectTSPTDeleteController');

Route::resource('personalDataTSPTodolists', 'PersonalDataTSPTodolistController');

Route::resource('personalDataTSPTCreates', 'PersonalDataTSPTCreateController');

Route::resource('personalDataTSPTViews', 'PersonalDataTSPTViewController');

Route::resource('personalDataTSPTUpdates', 'PersonalDataTSPTUpdateController');

Route::resource('personalDataTSPTDeletes', 'PersonalDataTSPTDeleteController');

Route::get('createCollegeTSPAudio/{id}', ['as' => 'collegeTSPAudios.create', 'uses' => 'CollegeTSPAudioController@create']);

Route::get('createJobTSPAudio/{id}', ['as' => 'jobTSPAudios.create', 'uses' => 'JobTSPAudioController@create']);

Route::get('createProjectTSPAudio/{id}', ['as' => 'projectTSPAudios.create', 'uses' => 'ProjectTSPAudioController@create']);

Route::get('createPersonalDataTSPAudio/{id}', ['as' => 'personalDataTSPAudios.create', 'uses' => 'PersonalDataTSPAudioController@create']);

Route::post('/store_college_audio', "CollegeTSPAudioController@store");

Route::post('/store_job_audio', "JobTSPAudioController@store");

Route::post('/store_project_audio', "ProjectTSPAudioController@store");

Route::post('/store_personal_data_audio', "PersonalDataTSPAudioController@store");

Route::resource('userCollegeTSPAudios', 'UserCollegeTSPAudioController');

Route::resource('uCTSPAudioCreates', 'UCTSPAudioCreateController');

Route::resource('uCTSPAudioUpdates', 'UCTSPAudioUpdateController');

Route::resource('uCTSPAudioDeletes', 'UCTSPAudioDeleteController');

Route::resource('userJobTSPAudios', 'UserJobTSPAudioController');

Route::resource('uJTSPAudioCreates', 'UJTSPAudioCreateController');

Route::resource('uJTSPAudioUpdates', 'UJTSPAudioUpdateController');

Route::resource('uJTSPAudioDeletes', 'UJTSPAudioDeleteController');

Route::resource('userProjectTSPAudios', 'UserProjectTSPAudioController');

Route::resource('uPTSPAudioCreates', 'UPTSPAudioCreateController');

Route::resource('uPTSPAudioUpdates', 'UPTSPAudioUpdateController');

Route::resource('uPTSPAudioDeletes', 'UPTSPAudioDeleteController');

Route::resource('userPDTSPAudios', 'UserPDTSPAudioController');

Route::resource('uPDTSPAudioCreates', 'UPDTSPAudioCreateController');

Route::resource('uPDTSPAudioUpdates', 'UPDTSPAudioUpdateController');

Route::resource('uPDTSPAudioDeletes', 'UPDTSPAudioDeleteController');

Route::get('destroyCollegeTSPAudio/{id}', ['as' => 'collegeTSPAudios.destroy', 'uses' => 'CollegeTSPAudioController@destroy']);

Route::get('createUserCollegeTSPlaylist/{id}', ['as' => 'userCollegeTSPlaylists.create', 'uses' => 'UserCollegeTSPlaylistController@create']);

Route::get('createUserCollegeTSPAudio/{id}', ['as' => 'userCollegeTSPAudios.create', 'uses' => 'UserCollegeTSPAudioController@create']);

Route::get('destroyJobTSPAudio/{id}', ['as' => 'jobTSPAudios.destroy', 'uses' => 'JobTSPAudioController@destroy']);

Route::get('createUserJobTSPlaylist/{id}', ['as' => 'userJobTSPlaylists.create', 'uses' => 'UserJobTSPlaylistController@create']);

Route::get('createUserJobTSPAudio/{id}', ['as' => 'userJobTSPAudios.create', 'uses' => 'UserJobTSPAudioController@create']);

Route::get('destroyProjectTSPAudio/{id}', ['as' => 'projectTSPAudios.destroy', 'uses' => 'ProjectTSPAudioController@destroy']);

Route::get('createUserProjectTSPlaylist/{id}', ['as' => 'userProjectTSPlaylists.create', 'uses' => 'UserProjectTSPlaylistController@create']);

Route::get('createUserProjectTSPAudio/{id}', ['as' => 'userProjectTSPAudios.create', 'uses' => 'UserProjectTSPAudioController@create']);

Route::get('destroyPersonalDataTSPAudio/{id}', ['as' => 'personalDataTSPAudios.destroy', 'uses' => 'PersonalDataTSPAudioController@destroy']);

Route::get('createUserPersonalDataTSP/{id}', ['as' => 'userPersonalDataTSPs.create', 'uses' => 'UserPersonalDataTSPController@create']);

Route::get('createUserPDTSPAudio/{id}', ['as' => 'userPDTSPAudios.create', 'uses' => 'UserPDTSPAudioController@create']);

Route::resource('contactTelephones', 'ContactTelephoneController');

Route::resource('contactTelephoneCreates', 'ContactTelephoneCreateController');

Route::resource('contactTelephoneViews', 'ContactTelephoneViewController');

Route::resource('contactTelephoneUpdates', 'ContactTelephoneUpdatesController');

Route::resource('contactTelephoneDeletes', 'ContactTelephoneDeletesController');

Route::resource('contactEmails', 'ContactEmailController');

Route::resource('contactEmailCreates', 'ContactEmailCreateController');

Route::resource('contactEmailViews', 'ContactEmailViewController');

Route::resource('contactEmailUpdates', 'ContactEmailUpdatesController');

Route::resource('contactEmailDeletes', 'ContactEmailDeletesController');

Route::resource('contactSocials', 'ContactSocialController');

Route::resource('contactSocialCreates', 'ContactSocialCreateController');

Route::resource('contactSocialViews', 'ContactSocialViewController');

Route::resource('contactSocialUpdates', 'ContactSocialUpdatesController');

Route::resource('contactSocialDeletes', 'ContactSocialDeletesController');

Route::resource('contactWebs', 'ContactWebController');

Route::resource('contactWebCreates', 'ContactWebCreateController');

Route::resource('contactWebViews', 'ContactWebViewController');

Route::resource('contactWebUpdates', 'ContactWebUpdatesController');

Route::resource('contactWebDeletes', 'ContactWebDeletesController');

Route::resource('contactWebDeletes', 'ContactWebDeletesController');

Route::resource('contactAddresses', 'ContactAddressController');

Route::resource('contactAddressCreates', 'ContactAddressCreateController');

Route::resource('contactAddressViews', 'ContactAddressViewController');

Route::resource('contactAddressUpdates', 'ContactAddressUpdatesController');

Route::resource('contactAddressDeletes', 'ContactAddressDeletesController');

Route::get('createContactAddress/{id}', ['as' => 'contactAddresses.create', 'uses' => 'ContactAddressController@create']);

Route::get('createContactTelephone/{id}', ['as' => 'contactTelephones.create', 'uses' => 'ContactTelephoneController@create']);

Route::get('createContactEmail/{id}', ['as' => 'contactEmails.create', 'uses' => 'ContactEmailController@create']);

Route::get('createContactSocial/{id}', ['as' => 'contactSocials.create', 'uses' => 'ContactSocialController@create']);

Route::get('createContactWeb/{id}', ['as' => 'contactWebs.create', 'uses' => 'ContactWebController@create']);

Route::resource('userCollegeCreates', 'UserCollegeCController');

Route::resource('userCollegeDeletes', 'UserCollegeDController');

Route::resource('userCollegeUpdates', 'UserCollegeUController');

Route::resource('userCollegeTopicCreates', 'UserCollegeTopicCController');

Route::resource('userCollegeTopicDeletes', 'UserCollegeTopicDController');

Route::resource('userCollegeTopicUpdates', 'UserCollegeTopicUController');

Route::resource('userCollegeTopicSectionCreates', 'UserCollegeTopicSectionCController');

Route::resource('userCollegeTopicSectionDeletes', 'UserCollegeTopicSectionDController');

Route::resource('userCollegeTopicSectionUpdates', 'UserCollegeTopicSectionUController');

Route::resource('userCollegeTSFileCreates', 'UserCollegeTSFileCController');

Route::resource('userCollegeTSFileDeletes', 'UserCollegeTSFileDController');

Route::resource('userCollegeTSFileUpdates', 'UserCollegeTSFileUController');

Route::resource('userCollegeTSNoteCreates', 'UserCollegeTSNoteCController');

Route::resource('userCollegeTSNoteDeletes', 'UserCollegeTSNoteDController');

Route::resource('userCollegeTSNoteUpdates', 'UserCollegeTSNoteUController');

Route::resource('userCollegeTSGaleryCreates', 'UserCollegeTSGalerieCController');

Route::resource('userCollegeTSGaleryDeletes', 'UserCollegeTSGalerieDController');

Route::resource('userCollegeTSGaleryUpdates', 'UserCollegeTSGalerieUController');

Route::resource('userCollegeTSGaleryImageCreates', 'UserCollegeTSGaleryImageCController');

Route::resource('userCollegeTSGaleryImageDeletes', 'UserCollegeTSGaleryImageDController');

Route::resource('userCollegeTSGaleryImageUpdates', 'UserCollegeTSGaleryImageUController');

Route::resource('userCollegeTSPlaylistCreates', 'UCTSPlaylistCreateController');

Route::resource('userCollegeTSPlaylistDeletes', 'UCTSPlaylistDeleteController');

Route::resource('userCollegeTSPlaylistUpdates', 'UCTSPlaylistUpdateController');

Route::resource('userCollegeTSPAudioCreates', 'UCTSPAudioCreateController');

Route::resource('userCollegeTSPAudioDeletes', 'UCTSPAudioDeleteController');

Route::resource('userCollegeTSPAudioUpdates', 'UCTSPAudioUpdateController');

Route::resource('userCollegeTSToolCreates', 'UserCollegeTSToolCController');

Route::resource('userCollegeTSToolDeletes', 'UserCollegeTSToolDController');

Route::resource('userCollegeTSToolUpdates', 'UserCollegeTSToolUController');

Route::resource('userCollegeTSToolFileCreates', 'UserCollegeTSToolFileCController');

Route::resource('userCollegeTSToolFileDeletes', 'UserCollegeTSToolFileDController');

Route::resource('userCollegeTSToolFileUpdates', 'UserCollegeTSToolFileUController');

Route::resource('userJobCreates', 'UserJobCController');

Route::resource('userJobDeletes', 'UserJobDController');

Route::resource('userJobUpdates', 'UserJobUController');

Route::resource('userJobTopicCreates', 'UserJobTopicCController');

Route::resource('userJobTopicDeletes', 'UserJobTopicDController');

Route::resource('userJobTopicUpdates', 'UserJobTopicUController');

Route::resource('userJobTopicSectionCreates', 'UserJobTopicSectionCController');

Route::resource('userJobTopicSectionDeletes', 'UserJobTopicSectionDController');

Route::resource('userJobTopicSectionUpdates', 'UserJobTopicSectionUController');

Route::resource('userJobTSFileCreates', 'UserJobTSFileCController');

Route::resource('userJobTSFileDeletes', 'UserJobTSFileDController');

Route::resource('userJobTSFileUpdates', 'UserJobTSFileUController');

Route::resource('userJobTSNoteCreates', 'UserJobTSNoteCController');

Route::resource('userJobTSNoteDeletes', 'UserJobTSNoteDController');

Route::resource('userJobTSNoteUpdates', 'UserJobTSNoteUController');

Route::resource('userJobTSGaleryCreates', 'UserJobTSGalerieCController');

Route::resource('userJobTSGaleryDeletes', 'UserJobTSGalerieDController');

Route::resource('userJobTSGaleryUpdates', 'UserJobTSGalerieUController');

Route::resource('userJobTSGaleryImageCreates', 'UserJobTSGaleryImageCController');

Route::resource('userJobTSGaleryImageDeletes', 'UserJobTSGaleryImageDController');

Route::resource('userJobTSGaleryImageUpdates', 'UserJobTSGaleryImageUController');

Route::resource('userJobTSPlaylistCreates', 'UJTSPlaylistCreateController');

Route::resource('userJobTSPlaylistDeletes', 'UJTSPlaylistDeleteController');

Route::resource('userJobTSPlaylistUpdates', 'UJTSPlaylistUpdateController');

Route::resource('userJobTSPAudioCreates', 'UJTSPAudioCreateController');

Route::resource('userJobTSPAudioDeletes', 'UJTSPAudioDeleteController');

Route::resource('userJobTSPAudioUpdates', 'UJTSPAudioUpdateController');

Route::resource('userJobTSToolCreates', 'UserJobTSToolCController');

Route::resource('userJobTSToolDeletes', 'UserJobTSToolDController');

Route::resource('userJobTSToolUpdates', 'UserJobTSToolUController');

Route::resource('userJobTSToolFileCreates', 'UserJobTSToolFileCController');

Route::resource('userJobTSToolFileDeletes', 'UserJobTSToolFileDController');

Route::resource('userJobTSToolFileUpdates', 'UserJobTSToolFileUController');

Route::resource('userProjectCreates', 'UserProjectCController');

Route::resource('userProjectDeletes', 'UserProjectDController');

Route::resource('userProjectUpdates', 'UserProjectUController');

Route::resource('userProjectTopicCreates', 'UserProjectTopicCController');

Route::resource('userProjectTopicDeletes', 'UserProjectTopicDController');

Route::resource('userProjectTopicUpdates', 'UserProjectTopicUController');

Route::resource('userProjectTopicSectionCreates', 'UserProjectTopicSectionCController');

Route::resource('userProjectTopicSectionDeletes', 'UserProjectTopicSectionDController');

Route::resource('userProjectTopicSectionUpdates', 'UserProjectTopicSectionUController');

Route::resource('userProjectTSFileCreates', 'UserProjectTSFileCController');

Route::resource('userProjectTSFileDeletes', 'UserProjectTSFileDController');

Route::resource('userProjectTSFileUpdates', 'UserProjectTSFileUController');

Route::resource('userProjectTSNoteCreates', 'UserProjectTSNoteCController');

Route::resource('userProjectTSNoteDeletes', 'UserProjectTSNoteDController');

Route::resource('userProjectTSNoteUpdates', 'UserProjectTSNoteUController');

Route::resource('userProjectTSGaleryCreates', 'UserProjectTSGalerieCController');

Route::resource('userProjectTSGaleryDeletes', 'UserProjectTSGalerieDController');

Route::resource('userProjectTSGaleryUpdates', 'UserProjectTSGalerieUController');

Route::resource('userProjectTSGaleryImageCreates', 'UserProjectTSGaleryImageCController');

Route::resource('userProjectTSGaleryImageDeletes', 'UserProjectTSGaleryImageDController');

Route::resource('userProjectTSGaleryImageUpdates', 'UserProjectTSGaleryImageUController');

Route::resource('userProjectTSPlaylistCreates', 'UPTSPlaylistCreateController');

Route::resource('userProjectTSPlaylistDeletes', 'UPTSPlaylistDeleteController');

Route::resource('userProjectTSPlaylistUpdates', 'UPTSPlaylistUpdateController');

Route::resource('userProjectTSPAudioCreates', 'UPTSPAudioCreateController');

Route::resource('userProjectTSPAudioDeletes', 'UPTSPAudioDeleteController');

Route::resource('userProjectTSPAudioUpdates', 'UPTSPAudioUpdateController');

Route::resource('userProjectTSToolCreates', 'UserProjectTSToolCController');

Route::resource('userProjectTSToolDeletes', 'UserProjectTSToolDController');

Route::resource('userProjectTSToolUpdates', 'UserProjectTSToolUController');

Route::resource('userProjectTSToolFileCreates', 'UserProjectTSToolFileCController');

Route::resource('userProjectTSToolFileDeletes', 'UserProjectTSToolFileDController');

Route::resource('userProjectTSToolFileUpdates', 'UserProjectTSToolFileUController');

Route::resource('userPersonalDataCreates', 'UserPersonalDataCController');

Route::resource('userPersonalDataDeletes', 'UserPersonalDataDController');

Route::resource('userPersonalDataUpdates', 'UserPersonalDataUController');

Route::resource('userPersonalDataTopicCreates', 'UserPersonalDataTopicCController');

Route::resource('userPersonalDataTopicDeletes', 'UserPersonalDataTopicDController');

Route::resource('userPersonalDataTopicUpdates', 'UserPersonalDataTopicUController');

Route::resource('userPersonalDataTSCreates', 'UserPersonalDataTopicSectionCController');

Route::resource('userPersonalDataTSDeletes', 'UserPersonalDataTopicSectionDController');

Route::resource('userPersonalDataTSUpdates', 'UserPersonalDataTopicSectionUController');

Route::resource('userPersonalDataTSFileCreates', 'UserPersonalDataTSFileCController');

Route::resource('userPersonalDataTSFileDeletes', 'UserPersonalDataTSFileDController');

Route::resource('userPersonalDataTSFileUpdates', 'UserPersonalDataTSFileUController');

Route::resource('userPersonalDataTSNoteCreates', 'UserPersonalDataTSNoteCController');

Route::resource('userPersonalDataTSNoteDeletes', 'UserPersonalDataTSNoteDController');

Route::resource('userPersonalDataTSNoteUpdates', 'UserPersonalDataTSNoteUController');

Route::resource('userPersonalDataTSGaleryCreates', 'UserPersonalDataTSGalerieCController');

Route::resource('userPersonalDataTSGaleryDeletes', 'UserPersonalDataTSGalerieDController');

Route::resource('userPersonalDataTSGaleryUpdates', 'UserPersonalDataTSGalerieUController');

Route::resource('userPersonalDataTSGImageCreates', 'UserPersonalDataTSGaleryImageCController');

Route::resource('userPersonalDataTSGImageDeletes', 'UserPersonalDataTSGaleryImageDController');

Route::resource('userPersonalDataTSGImageUpdates', 'UserPersonalDataTSGaleryImageUController');

Route::resource('userPersonalDataTSPlaylistCreates', 'UPDTSPlaylistCreateController');

Route::resource('userPersonalDataTSPlaylistDeletes', 'UPDTSPlaylistDeleteController');

Route::resource('userPersonalDataTSPlaylistUpdates', 'UPDTSPlaylistUpdateController');

Route::resource('userPersonalDataTSPAudioCreates', 'UPDTSPAudioCreateController');

Route::resource('userPersonalDataTSPAudioDeletes', 'UPDTSPAudioDeleteController');

Route::resource('userPersonalDataTSPAudioUpdates', 'UPDTSPAudioUpdateController');

Route::resource('userPersonalDataTSToolCreates', 'UserPersonalDataTSToolCController');

Route::resource('userPersonalDataTSToolDeletes', 'UserPersonalDataTSToolDController');

Route::resource('userPersonalDataTSToolUpdates', 'UserPersonalDataTSToolUController');

Route::resource('userPersonalDataTSToolFileCreates', 'UserPersonalDataTSToolFileCController');

Route::resource('userPersonalDataTSToolFileDeletes', 'UserPersonalDataTSToolFileDController');

Route::resource('userPersonalDataTSToolFileUpdates', 'UserPersonalDataTSToolFileUController');

Route::post('/store_college_tool_file_data', 'CollegeTSToolFileController@store'); // Crear Controlador

Route::resource('users', 'UserController');

Route::post('/update_user/{id}', 'UserController@update');

Route::resource('generalSearches', 'GeneralSearchController');

Route::resource('publicFiles', 'PublicFileController');

Route::resource('publicNotes', 'PublicNoteController');

Route::resource('publicImages', 'PublicImageController');

Route::resource('publicAudios', 'PublicAudioController');

Route::resource('publicVideos', 'PublicVideoController');

Route::resource('publicAdvertisements', 'PublicAdvertisementController');

Route::resource('publicFileComments', 'PublicFileCommentController');

Route::resource('publicFileCommentResponses', 'PublicFileCommentResponseController');

Route::resource('publicFileLikes', 'PublicFileLikeController');

Route::resource('publicNoteComments', 'PublicNoteCommentController');

Route::resource('publicNoteCommentResponses', 'PublicNoteCommentResponseController');

Route::resource('publicNoteLikes', 'PublicNoteLikeController');

Route::resource('publicImageComments', 'PublicImageCommentController');

Route::resource('publicImageCommentResponses', 'PublicImageCommentResponseController');

Route::resource('publicImageLikes', 'PublicImageLikeController');

Route::resource('publicAudioComments', 'PublicAudioCommentController');

Route::resource('publicAudioCommentResponses', 'PublicAudioCommentResponseController');

Route::resource('publicAudioLikes', 'PublicAudioLikeController');

Route::resource('publicVideoComments', 'PublicVideoCommentController');

Route::resource('publicVideoCommentResponses', 'PublicVideoCommentResponseController');

Route::resource('publicVideoLikes', 'PublicVideoLikeController');

Route::resource('publicAdvertisementComments', 'PublicAdvertisementCommentController');

Route::resource('publicAdvertisementCResponses', 'PublicAdvertisementCResponseController');

Route::resource('publicAdvertisementLikes', 'PublicAdvertisementLikeController');

Route::post('/annotateCollegeNote/{id}', 'CollegeTSNoteController@annotateImage');

Route::post('/annotateJobNote/{id}', 'JobTSNoteController@annotateImage');

Route::post('/annotateProjectNote/{id}', 'ProjectTSNoteController@annotateImage');

Route::post('/annotatePersonalDataNote/{id}', 'PersonalDataTSNoteController@annotateImage');

Route::post('/annotatePublicNote/{id}', 'PublicNoteController@annotateImage');

Route::post('/annotateSharedProfileNote/{id}', 'SharedProfileNoteController@annotateImage');

Route::post('/store_public_file', "PublicFileController@store");

Route::post('/store_public_image', "PublicImageController@store");

Route::post('/store_public_audio', "PublicAudioController@store");

Route::post('/store_public_video', "PublicVideoController@store");

Route::post('/store_public_advertisement', "PublicAdvertisementController@store");

Route::get('destroyPublicImage/{id}', ['as' => 'publicImages.destroy', 'uses' => 'PublicImageController@destroy']);

Route::post('/store_public_file_comment', "PublicFileCommentController@store");

Route::post('/store_public_note_comment', "PublicNoteCommentController@store");

Route::post('/store_public_image_comment', "PublicImageCommentController@store");

Route::post('/store_public_audio_comment', "PublicAudioCommentController@store");

Route::post('/store_public_video_comment', "PublicVideoCommentController@store");

Route::post('/store_public_advertisement_comment', "PublicAdvertisementCommentController@store");

Route::post('/store_public_file_comment_response', "PublicFileCommentResponseController@store");

Route::post('/store_public_note_comment_response', "PublicNoteCommentResponseController@store");

Route::post('/store_public_image_comment_response', "PublicImageCommentResponseController@store");

Route::post('/store_public_audio_comment_response', "PublicAudioCommentResponseController@store");

Route::post('/store_public_video_comment_response', "PublicVideoCommentResponseController@store");

Route::post('/store_public_advertisement_c_response', "PublicAdvertisementCResponseController@store");

Route::resource('publicAdvUpdateControllers', 'PublicAdvertisementUpdateControllerController');

Route::resource('publicFileUpdates', 'PublicFileUpdateController');

Route::resource('publicNoteUpdates', 'PublicNoteUpdateController');

Route::resource('publicImageUpdates', 'PublicImageUpdateController');

Route::resource('publicAudioUpdates', 'PublicAudioUpdateController');

Route::resource('publicVideoUpdates', 'PublicVideoUpdateController');

Route::resource('publicAdvertisementUpdates', 'PublicAdvertisementUpdateController');

Route::resource('publicFileViews', 'PublicFileViewController');

Route::resource('publicNoteViews', 'PublicNoteViewController');

Route::resource('publicImageViews', 'PublicImageViewController');

Route::resource('publicAudioViews', 'PublicAudioViewController');

Route::resource('publicVideoViews', 'PublicVideoViewController');

Route::resource('publicAdvertisementViews', 'PublicAdvertisementViewController');

Route::post('users/{id}', ['as' => 'users.update_image', 'uses' => 'UserController@update_image']);

Route::resource('userCalendarEvents', 'UserCalendarEventController');

Route::resource('userCalendarEventCreates', 'UserCalendarEventCreateController');

Route::resource('userCalendarEventUpdates', 'UserCalendarEventUpdateController');

Route::resource('userCalendarEventDeletes', 'UserCalendarEventDeleteController');

Route::get('createUserCalendarEvent/{id}', ['as' => 'userCalendarEvents.create', 'uses' => 'UserCalendarEventController@create']);

Route::resource('sharedProfileFiles', 'SharedProfileFileController');

Route::resource('sharedProfileNotes', 'SharedProfileNoteController');

Route::resource('sharedProfileImages', 'SharedProfileImageController');

Route::resource('sharedProfileAudios', 'SharedProfileAudioController');

Route::resource('sharedProfileVideos', 'SharedProfileVideoController');

Route::resource('sharedProfileFileCs', 'SharedProfileFileCController');

Route::resource('sharedProfileFileCResponses', 'SharedProfileFileCResponseController');

Route::resource('sharedProfileFileLikes', 'SharedProfileFileLikeController');

Route::resource('sharedProfileNoteCs', 'SharedProfileNoteCController');

Route::resource('sharedProfileNoteCResponses', 'SharedProfileNoteCResponseController');

Route::resource('sharedProfileNoteLikes', 'SharedProfileNoteLikeController');

Route::resource('sharedProfileImageCs', 'SharedProfileImageCController');

Route::resource('sharedProfileImageCResponses', 'SharedProfileImageCResponseController');

Route::resource('sharedProfileImageLikes', 'SharedProfileImageLikeController');

Route::resource('sharedProfileAudioCs', 'SharedProfileAudioCController');

Route::resource('sharedProfileAudioCResponses', 'SharedProfileAudioCResponseController');

Route::resource('sharedProfileAudioLikes', 'SharedProfileAudioLikeController');

Route::resource('sharedProfileVideoCs', 'SharedProfileVideoCController');

Route::resource('sharedProfileVideoCResponses', 'SharedProfileVideoCResponseController');

Route::resource('sharedProfileVideoLikes', 'SharedProfileVideoLikeController');

Route::resource('sharedProfileFileViews', 'SharedProfileFileViewController');

Route::resource('sharedProfileNoteViews', 'SharedProfileNoteViewController');

Route::resource('sharedProfileImageViews', 'SharedProfileImageViewController');

Route::resource('sharedProfileAudioViews', 'SharedProfileAudioViewController');

Route::resource('sharedProfileVideoViews', 'SharedProfileVideoViewController');

Route::resource('sharedProfileFileUpdates', 'SharedProfileFileUpdateController');

Route::resource('sharedProfileNoteUpdates', 'SharedProfileNoteUpdateController');

Route::resource('sharedProfileImageUpdates', 'SharedProfileImageUpdateController');

Route::resource('sharedProfileAudioUpdates', 'SharedProfileAudioUpdateController');

Route::resource('sharedProfileVideoUpdates', 'SharedProfileVideoUpdateController');



Route::post('/store_shared_profile_file', "SharedProfileFileController@store");

Route::post('/store_shared_profile_image', "SharedProfileImageController@store");

Route::post('/store_shared_profile_audio', "SharedProfileAudioController@store");

Route::post('/store_shared_profile_video', "SharedProfileVideoController@store");

Route::get('destroySharedProfileImage/{id}', ['as' => 'sharedProfileImages.destroy', 'uses' => 'SharedProfileImageController@destroy']);

Route::post('/store_shared_profile_file_comment', "SharedProfileFileCController@store");

Route::post('/store_shared_profile_note_comment', "SharedProfileNoteCController@store");

Route::post('/store_shared_profile_image_comment', "SharedProfileImageCController@store");

Route::post('/store_shared_profile_audio_comment', "SharedProfileAudioCController@store");

Route::post('/store_shared_profile_video_comment', "SharedProfileVideoCController@store");

Route::post('/store_shared_profile_file_comment_response', "SharedProfileFileCResponseController@store");

Route::post('/store_shared_profile_note_comment_response', "SharedProfileNoteCResponseController@store");

Route::post('/store_shared_profile_image_comment_response', "SharedProfileImageCResponseController@store");

Route::post('/store_shared_profile_audio_comment_response', "SharedProfileAudioCResponseController@store");

Route::post('/store_shared_profile_video_comment_response', "SharedProfileVideoCResponseController@store");

Route::resource('userSharedProfiles', 'UserSharedProfileController');

Route::resource('userSharedProfileCreates', 'UserSharedProfileCreateController');

Route::resource('userSharedProfileUpdates', 'UserSharedProfileUpdateController');

Route::resource('userSharedProfileDeletes', 'UserSharedProfileDeleteController');

Route::get('createUserSharedProfile/{id}', ['as' => 'userSharedProfiles.create', 'uses' => 'UserSharedProfileController@create']);

Route::resource('cube', 'CubeController');