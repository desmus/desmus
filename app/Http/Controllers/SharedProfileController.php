<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Auth;

class SharedProfileController extends Controller
{
    public function __construct()
    {
    }
    
    public function index()
    {
        $now = Carbon::now();
        
        if(isset(Auth::user()->id))
        {
            $user_id = Auth::user()->id;
            $user = DB::table('users')->where('id', '=', $user_id)->get();
        
            $files = DB::table('shared_profile_file')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(100, ['*'], 'file_p');
            $notes = DB::table('shared_profile_note')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(100, ['*'], 'note_p');
            $images = DB::table('shared_profile_image')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(100, ['*'], 'image_p');
            $audios = DB::table('shared_profile_audio')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(100, ['*'], 'audio_p');
            $videos = DB::table('shared_profile_video')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(100, ['*'], 'video_p');
            
            $shared_profile_file_comments_list = DB::table('shared_profile_file_c')->join('shared_profile_file', 'shared_profile_file.id', '=', 'shared_profile_file_c.s_p_f_id')->select('shared_profile_file.id', 'shared_profile_file.name', 'shared_profile_file_c.content', 'shared_profile_file_c.created_at')->where('shared_profile_file_c.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_file_c.deleted_at', '=', null);})->orderBy('shared_profile_file_c.created_at', 'desc')->paginate(50, ['*'], 'file_comment_list_p');
            $shared_profile_file_comment_responses_list = DB::table('shared_profile_file_c_response')->join('shared_profile_file_c', 'shared_profile_file_c.id', '=', 'shared_profile_file_c_response.s_p_f_c_id')->join('shared_profile_file', 'shared_profile_file.id', '=', 'shared_profile_file_c.s_p_f_id')->select('shared_profile_file.id', 'shared_profile_file.name', 'shared_profile_file_c_response.content', 'shared_profile_file_c_response.created_at')->where('shared_profile_file_c_response.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_file_c_response.deleted_at', '=', null);})->orderBy('shared_profile_file_c_response.created_at', 'desc')->paginate(50, ['*'], 'file_comment_response_list_p');
            $shared_profile_file_likes_list_c = DB::table('shared_profile_file_like')->join('shared_profile_file', 'shared_profile_file.id', '=', 'shared_profile_file_like.s_p_f_id')->select('shared_profile_file.id', 'shared_profile_file.name', 'shared_profile_file_like.created_at')->where('shared_profile_file_like.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_file_like.deleted_at', '=', null);})->orderBy('shared_profile_file_like.created_at', 'desc')->paginate(50, ['*'], 'file_like_list_p');
    
            $shared_profile_file_comments_list_count = DB::table('shared_profile_file_c')->join('shared_profile_file', 'shared_profile_file.id', '=', 'shared_profile_file_c.s_p_f_id')->where('shared_profile_file_c.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_file_c.deleted_at', '=', null);})->count();
            $shared_profile_file_comment_responses_list_count = DB::table('shared_profile_file_c_response')->join('shared_profile_file_c', 'shared_profile_file_c.id', '=', 'shared_profile_file_c_response.s_p_f_c_id')->join('shared_profile_file', 'shared_profile_file.id', '=', 'shared_profile_file_c.s_p_f_id')->where('shared_profile_file_c_response.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_file_c_response.deleted_at', '=', null);})->count();
            $shared_profile_file_likes_list_count = DB::table('shared_profile_file_like')->join('shared_profile_file', 'shared_profile_file.id', '=', 'shared_profile_file_like.s_p_f_id')->where('shared_profile_file_like.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_file_like.deleted_at', '=', null);})->count();
        
            $shared_profile_note_comments_list = DB::table('shared_profile_note_c')->join('shared_profile_note', 'shared_profile_note.id', '=', 'shared_profile_note_c.s_p_n_id')->select('shared_profile_note.id', 'shared_profile_note.name', 'shared_profile_note_c.content', 'shared_profile_note_c.created_at')->where('shared_profile_note_c.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_note_c.deleted_at', '=', null);})->orderBy('shared_profile_note_c.created_at', 'desc')->paginate(50, ['*'], 'note_comment_list_p');
            $shared_profile_note_comment_responses_list = DB::table('shared_profile_note_c_response')->join('shared_profile_note_c', 'shared_profile_note_c.id', '=', 'shared_profile_note_c_response.s_p_n_c_id')->join('shared_profile_note', 'shared_profile_note.id', '=', 'shared_profile_note_c.s_p_n_id')->select('shared_profile_note.id', 'shared_profile_note.name', 'shared_profile_note_c_response.content', 'shared_profile_note_c_response.created_at')->where('shared_profile_note_c_response.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_note_c_response.deleted_at', '=', null);})->orderBy('shared_profile_note_c_response.created_at', 'desc')->paginate(50, ['*'], 'note_comment_response_list_p');
            $shared_profile_note_likes_list_c = DB::table('shared_profile_note_like')->join('shared_profile_note', 'shared_profile_note.id', '=', 'shared_profile_note_like.s_p_n_id')->select('shared_profile_note.id', 'shared_profile_note.name', 'shared_profile_note_like.created_at')->where('shared_profile_note_like.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_note_like.deleted_at', '=', null);})->orderBy('shared_profile_note_like.created_at', 'desc')->paginate(50, ['*'], 'note_like_list_p');
    
            $shared_profile_note_comments_list_count = DB::table('shared_profile_note_c')->join('shared_profile_note', 'shared_profile_note.id', '=', 'shared_profile_note_c.s_p_n_id')->where('shared_profile_note_c.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_note_c.deleted_at', '=', null);})->count();
            $shared_profile_note_comment_responses_list_count = DB::table('shared_profile_note_c_response')->join('shared_profile_note_c', 'shared_profile_note_c.id', '=', 'shared_profile_note_c_response.s_p_n_c_id')->join('shared_profile_note', 'shared_profile_note.id', '=', 'shared_profile_note_c.s_p_n_id')->where('shared_profile_note_c_response.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_note_c_response.deleted_at', '=', null);})->count();
            $shared_profile_note_likes_list_count = DB::table('shared_profile_note_like')->join('shared_profile_note', 'shared_profile_note.id', '=', 'shared_profile_note_like.s_p_n_id')->where('shared_profile_note_like.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_note_like.deleted_at', '=', null);})->count();
            
            $shared_profile_image_comments_list = DB::table('shared_profile_image_c')->join('shared_profile_image', 'shared_profile_image.id', '=', 'shared_profile_image_c.s_p_i_id')->select('shared_profile_image.id', 'shared_profile_image.name', 'shared_profile_image_c.content', 'shared_profile_image_c.created_at')->where('shared_profile_image_c.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_image_c.deleted_at', '=', null);})->orderBy('shared_profile_image_c.created_at', 'desc')->paginate(50, ['*'], 'image_comment_list_p');
            $shared_profile_image_comment_responses_list = DB::table('shared_profile_image_c_response')->join('shared_profile_image_c', 'shared_profile_image_c.id', '=', 'shared_profile_image_c_response.s_p_i_c_id')->join('shared_profile_image', 'shared_profile_image.id', '=', 'shared_profile_image_c.s_p_i_id')->select('shared_profile_image.id', 'shared_profile_image.name', 'shared_profile_image_c_response.content', 'shared_profile_image_c_response.created_at')->where('shared_profile_image_c_response.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_image_c_response.deleted_at', '=', null);})->orderBy('shared_profile_image_c_response.created_at', 'desc')->paginate(50, ['*'], 'image_comment_response_list_p');
            $shared_profile_image_likes_list_c = DB::table('shared_profile_image_like')->join('shared_profile_image', 'shared_profile_image.id', '=', 'shared_profile_image_like.s_p_i_id')->select('shared_profile_image.id', 'shared_profile_image.name', 'shared_profile_image_like.created_at')->where('shared_profile_image_like.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_image_like.deleted_at', '=', null);})->orderBy('shared_profile_image_like.created_at', 'desc')->paginate(50, ['*'], 'image_like_list_p');
    
            $shared_profile_image_comments_list_count = DB::table('shared_profile_image_c')->join('shared_profile_image', 'shared_profile_image.id', '=', 'shared_profile_image_c.s_p_i_id')->where('shared_profile_image_c.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_image_c.deleted_at', '=', null);})->count();
            $shared_profile_image_comment_responses_list_count = DB::table('shared_profile_image_c_response')->join('shared_profile_image_c', 'shared_profile_image_c.id', '=', 'shared_profile_image_c_response.s_p_i_c_id')->join('shared_profile_image', 'shared_profile_image.id', '=', 'shared_profile_image_c.s_p_i_id')->where('shared_profile_image_c_response.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_image_c_response.deleted_at', '=', null);})->count();
            $shared_profile_image_likes_list_count = DB::table('shared_profile_image_like')->join('shared_profile_image', 'shared_profile_image.id', '=', 'shared_profile_image_like.s_p_i_id')->where('shared_profile_image_like.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_image_like.deleted_at', '=', null);})->count();

            $shared_profile_audio_comments_list = DB::table('shared_profile_audio_c')->join('shared_profile_audio', 'shared_profile_audio.id', '=', 'shared_profile_audio_c.s_p_a_id')->select('shared_profile_audio.id', 'shared_profile_audio.name', 'shared_profile_audio_c.content', 'shared_profile_audio_c.created_at')->where('shared_profile_audio_c.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_audio_c.deleted_at', '=', null);})->orderBy('shared_profile_audio_c.created_at', 'desc')->paginate(50, ['*'], 'audio_comment_list_p');
            $shared_profile_audio_comment_responses_list = DB::table('shared_profile_audio_c_response')->join('shared_profile_audio_c', 'shared_profile_audio_c.id', '=', 'shared_profile_audio_c_response.s_p_a_c_id')->join('shared_profile_audio', 'shared_profile_audio.id', '=', 'shared_profile_audio_c.s_p_a_id')->select('shared_profile_audio.id', 'shared_profile_audio.name', 'shared_profile_audio_c_response.content', 'shared_profile_audio_c_response.created_at')->where('shared_profile_audio_c_response.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_audio_c_response.deleted_at', '=', null);})->orderBy('shared_profile_audio_c_response.created_at', 'desc')->paginate(50, ['*'], 'audio_comment_response_list_p');
            $shared_profile_audio_likes_list_c = DB::table('shared_profile_audio_like')->join('shared_profile_audio', 'shared_profile_audio.id', '=', 'shared_profile_audio_like.s_p_a_id')->select('shared_profile_audio.id', 'shared_profile_audio.name', 'shared_profile_audio_like.created_at')->where('shared_profile_audio_like.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_audio_like.deleted_at', '=', null);})->orderBy('shared_profile_audio_like.created_at', 'desc')->paginate(50, ['*'], 'audio_like_list_p');
    
            $shared_profile_audio_comments_list_count = DB::table('shared_profile_audio_c')->join('shared_profile_audio', 'shared_profile_audio.id', '=', 'shared_profile_audio_c.s_p_a_id')->where('shared_profile_audio_c.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_audio_c.deleted_at', '=', null);})->count();
            $shared_profile_audio_comment_responses_list_count = DB::table('shared_profile_audio_c_response')->join('shared_profile_audio_c', 'shared_profile_audio_c.id', '=', 'shared_profile_audio_c_response.s_p_a_c_id')->join('shared_profile_audio', 'shared_profile_audio.id', '=', 'shared_profile_audio_c.s_p_a_id')->where('shared_profile_audio_c_response.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_audio_c_response.deleted_at', '=', null);})->count();
            $shared_profile_audio_likes_list_count = DB::table('shared_profile_audio_like')->join('shared_profile_audio', 'shared_profile_audio.id', '=', 'shared_profile_audio_like.s_p_a_id')->where('shared_profile_audio_like.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_audio_like.deleted_at', '=', null);})->count();

            $shared_profile_video_comments_list = DB::table('shared_profile_video_c')->join('shared_profile_video', 'shared_profile_video.id', '=', 'shared_profile_video_c.s_p_v_id')->select('shared_profile_video.id', 'shared_profile_video.name', 'shared_profile_video_c.content', 'shared_profile_video_c.created_at')->where('shared_profile_video_c.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_video_c.deleted_at', '=', null);})->orderBy('shared_profile_video_c.created_at', 'desc')->paginate(50, ['*'], 'video_comment_list_p');
            $shared_profile_video_comment_responses_list = DB::table('shared_profile_video_c_response')->join('shared_profile_video_c', 'shared_profile_video_c.id', '=', 'shared_profile_video_c_response.s_p_v_c_id')->join('shared_profile_video', 'shared_profile_video.id', '=', 'shared_profile_video_c.s_p_v_id')->select('shared_profile_video.id', 'shared_profile_video.name', 'shared_profile_video_c_response.content', 'shared_profile_video_c_response.created_at')->where('shared_profile_video_c_response.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_video_c_response.deleted_at', '=', null);})->orderBy('shared_profile_video_c_response.created_at', 'desc')->paginate(50, ['*'], 'video_comment_response_list_p');
            $shared_profile_video_likes_list_c = DB::table('shared_profile_video_like')->join('shared_profile_video', 'shared_profile_video.id', '=', 'shared_profile_video_like.s_p_v_id')->select('shared_profile_video.id', 'shared_profile_video.name', 'shared_profile_video_like.created_at')->where('shared_profile_video_like.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_video_like.deleted_at', '=', null);})->orderBy('shared_profile_video_like.created_at', 'desc')->paginate(50, ['*'], 'video_like_list_p');
    
            $shared_profile_video_comments_list_count = DB::table('shared_profile_video_c')->join('shared_profile_video', 'shared_profile_video.id', '=', 'shared_profile_video_c.s_p_v_id')->where('shared_profile_video_c.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_video_c.deleted_at', '=', null);})->count();
            $shared_profile_video_comment_responses_list_count = DB::table('shared_profile_video_c_response')->join('shared_profile_video_c', 'shared_profile_video_c.id', '=', 'shared_profile_video_c_response.s_p_v_c_id')->join('shared_profile_video', 'shared_profile_video.id', '=', 'shared_profile_video_c.s_p_v_id')->where('shared_profile_video_c_response.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_video_c_response.deleted_at', '=', null);})->count();
            $shared_profile_video_likes_list_count = DB::table('shared_profile_video_like')->join('shared_profile_video', 'shared_profile_video.id', '=', 'shared_profile_video_like.s_p_v_id')->where('shared_profile_video_like.user_id', '=', $user_id)->where(function ($query) {$query->where('shared_profile_video_like.deleted_at', '=', null);})->count();
        
            $shared_profile_files = DB::table('shared_profile_file')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'shared_profile_file_p');
            $shared_profile_notes = DB::table('shared_profile_note')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'shared_profile_note_p');
            $shared_profile_images = DB::table('shared_profile_image')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'shared_profile_image_p');
            $shared_profile_audios = DB::table('shared_profile_audio')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'shared_profile_audio_p');
            $shared_profile_videos = DB::table('shared_profile_video')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'shared_profile_video_p');
            
            $shared_profiles = DB::table('user_shared_profile')->join('users', 'user_shared_profile.user_id', '=', 'users.id')->where('shared_user_id', '=', $user_id)->where(function ($query) {$query->where('user_shared_profile.deleted_at', '=', null);})->orderBy('user_shared_profile.created_at', 'desc')->get();
            
            $i = 0;
            
            $shared_profile_file_lists = null;
            $shared_profile_note_lists = null;
            $shared_profile_image_lists = null;
            $shared_profile_audio_lists = null;
            $shared_profile_video_lists = null;
            
            if(isset($shared_profiles))
            {
                foreach($shared_profiles as $shared_profile)
                {
                    $shared_profile_file_lists[$i] = DB::table('shared_profile_file')->where('user_id', '=', $shared_profile -> user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $shared_profile_note_lists[$i] = DB::table('shared_profile_note')->where('user_id', '=', $shared_profile -> user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $shared_profile_image_lists[$i] = DB::table('shared_profile_image')->where('user_id', '=', $shared_profile -> user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $shared_profile_audio_lists[$i] = DB::table('shared_profile_audio')->where('user_id', '=', $shared_profile -> user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $shared_profile_video_lists[$i] = DB::table('shared_profile_video')->where('user_id', '=', $shared_profile -> user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $i += 1;
                }
            }
            
            $i = 0;
            $j = 0;
    
            $shared_profile_file_list_users = null;
            
            if(isset($shared_profile_file_lists[0]))
            {
                foreach($shared_profile_file_lists as $shared_profile_file_list)
                {
                    if(isset($shared_profile_file_list[0]))
                    {
                        $shared_profile_file_list_users[$i] = DB::table('shared_profile_file')->join('users', 'shared_profile_file.user_id', '=', 'users.id')->where('shared_profile_file.id', '=', $shared_profile_file_list[0] -> id)->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('shared_profile_file.created_at', 'desc')->paginate(2, ['*'], 'file_user_p');
                        $i += 1;
                    }
                }
            }
            
            $i = 0;
            $j = 0;
    
            $shared_profile_note_list_users = null;
            
            if(isset($shared_profile_note_lists[0]))
            {
                foreach($shared_profile_note_lists as $shared_profile_note_list)
                {
                    if(isset($shared_profile_note_list[0]))
                    {
                        $shared_profile_note_list_users[$i] = DB::table('shared_profile_note')->join('users', 'shared_profile_note.user_id', '=', 'users.id')->where('shared_profile_note.id', '=', $shared_profile_note_list[0] -> id)->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('shared_profile_note.created_at', 'desc')->paginate(2, ['*'], 'note_user_p');
                        $i += 1;
                    }
                }
            }
            
            $i = 0;
            $j = 0;
    
            $shared_profile_image_list_users = null;
            
            if(isset($shared_profile_image_lists[0]))
            {
                foreach($shared_profile_image_lists as $shared_profile_image_list)
                {
                    if(isset($shared_profile_image_list[0]))
                    {
                        $shared_profile_image_list_users[$i] = DB::table('shared_profile_image')->join('users', 'shared_profile_image.user_id', '=', 'users.id')->where('shared_profile_image.id', '=', $shared_profile_image_list[0] -> id)->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('shared_profile_image.created_at', 'desc')->paginate(2, ['*'], 'image_user_p');
                        $i += 1;
                    }
                }
            }
            
            $i = 0;
            $j = 0;
    
            $shared_profile_audio_list_users = null;
            
            if(isset($shared_profile_audio_lists[0]))
            {
                foreach($shared_profile_audio_lists as $shared_profile_audio_list)
                {
                    if(isset($shared_profile_audio_list[0]))
                    {
                        $shared_profile_audio_list_users[$i] = DB::table('shared_profile_audio')->join('users', 'shared_profile_audio.user_id', '=', 'users.id')->where('shared_profile_audio.id', '=', $shared_profile_audio_list[0] -> id)->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('shared_profile_audio.created_at', 'desc')->paginate(2, ['*'], 'audio_user_p');
                        $i += 1;
                    }
                }
            }
            
            $i = 0;
            $j = 0;
    
            $shared_profile_video_list_users = null;
            
            if(isset($shared_profile_video_lists[0]))
            {
                foreach($shared_profile_video_lists as $shared_profile_video_list)
                {
                    if(isset($shared_profile_video_list[0]))
                    {
                        $shared_profile_video_list_users[$i] = DB::table('shared_profile_video')->join('users', 'shared_profile_video.user_id', '=', 'users.id')->where('shared_profile_video.id', '=', $shared_profile_video_list[0] -> id)->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('shared_profile_video.created_at', 'desc')->paginate(2, ['*'], 'video_user_p');
                        $i += 1;
                    }
                }
            }
            
            $i = 0;
            $j = 0;
    
            $shared_profile_file_users = null;
            $shared_profile_file_comments = null;
            $shared_profile_file_comment_counts = null;
            $shared_profile_file_comment_users = null;
            $shared_profile_file_likes = null;
            
            if(isset($shared_profile_files[0]))
            {
                foreach($shared_profile_files as $shared_profile_file)
                {
                    $shared_profile_file_users[$i] = DB::table('shared_profile_file')->join('users', 'shared_profile_file.user_id', '=', 'users.id')->where('shared_profile_file.id', '=', $shared_profile_file -> id)->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('shared_profile_file.created_at', 'desc')->paginate(2, ['*'], 'file_user_p');
                    $shared_profile_file_comments[$i] = DB::table('shared_profile_file_c')->where('s_p_f_id', '=', $shared_profile_file -> id)->where(function ($query) {$query->where('shared_profile_file_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(2, ['*'], 'file_comment_p');
                    $shared_profile_file_comment_counts[$i] = DB::table('shared_profile_file_c')->where('s_p_f_id', '=', $shared_profile_file -> id)->where(function ($query) {$query->where('shared_profile_file_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $shared_profile_file_comment_users[$i] = DB::table('shared_profile_file_c')->join('users', 'shared_profile_file_c.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_file_c.user_id', 'shared_profile_file_c.id')->where('shared_profile_file_c.s_p_f_id', '=', $shared_profile_file -> id)->where(function ($query) {$query->where('shared_profile_file_c.deleted_at', '=', null);})->orderBy('shared_profile_file_c.created_at', 'desc')->paginate(2, ['*'], 'file_comment_user_p');
                    $shared_profile_file_likes[$i] = DB::table('shared_profile_file_like')->where('s_p_f_id', '=', $shared_profile_file -> id)->where(function ($query) {$query->where('shared_profile_file_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $i += 1;
                }
            }
            
            $shared_profile_file_comment_responses = null;
            $shared_profile_file_comment_response_users = null;
            
            if(isset($shared_profile_file_comments[0]))
            {
                foreach($shared_profile_file_comments as $shared_profile_file_comment_array)
                {
                    foreach($shared_profile_file_comment_array as $shared_profile_file_comment)
                    {
                        $shared_profile_file_comment_responses[$j] = DB::table('shared_profile_file_c_response')->where('s_p_f_c_id', '=', $shared_profile_file_comment -> id)->where(function ($query) {$query->where('shared_profile_file_c_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(1, ['*'], 'file_comment_response_p');
                        $shared_profile_file_comment_response_users[$j] = DB::table('shared_profile_file_c_response')->join('users', 'shared_profile_file_c_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_file_c_response.user_id', 'shared_profile_file_c_response.id')->where('shared_profile_file_c_response.s_p_f_c_id', '=', $shared_profile_file_comment -> id)->where(function ($query) {$query->where('shared_profile_file_c_response.deleted_at', '=', null);})->orderBy('shared_profile_file_c_response.created_at', 'desc')->paginate(1, ['*'], 'file_comment_response_user_p');
                        $j += 1;
                    }
                }
            }
            
            $i = 0;
            $j = 0;
            
            $shared_profile_note_users = null;
            $shared_profile_note_comments = null;
            $shared_profile_note_comment_counts = null;
            $shared_profile_note_comment_users = null;
            $shared_profile_note_likes = null;
            
            if(isset($shared_profile_notes[0]))
            {
                foreach($shared_profile_notes as $shared_profile_note)
                {
                    $shared_profile_note_users[$i] = DB::table('shared_profile_note')->join('users', 'shared_profile_note.user_id', '=', 'users.id')->where('shared_profile_note.id', '=', $shared_profile_note -> id)->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('shared_profile_note.created_at', 'desc')->paginate(2, ['*'], 'note_user_p');
                    $shared_profile_note_comments[$i] = DB::table('shared_profile_note_c')->where('s_p_n_id', '=', $shared_profile_note -> id)->where(function ($query) {$query->where('shared_profile_note_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(2, ['*'], 'note_comment_p');
                    $shared_profile_note_comment_counts[$i] = DB::table('shared_profile_note_c')->where('s_p_n_id', '=', $shared_profile_note -> id)->where(function ($query) {$query->where('shared_profile_note_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $shared_profile_note_comment_users[$i] = DB::table('shared_profile_note_c')->join('users', 'shared_profile_note_c.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_note_c.user_id', 'shared_profile_note_c.id')->where('shared_profile_note_c.s_p_n_id', '=', $shared_profile_note -> id)->where(function ($query) {$query->where('shared_profile_note_c.deleted_at', '=', null);})->orderBy('shared_profile_note_c.created_at', 'desc')->paginate(2, ['*'], 'note_comment_user_p');
                    $shared_profile_note_likes[$i] = DB::table('shared_profile_note_like')->where('s_p_n_id', '=', $shared_profile_note -> id)->where(function ($query) {$query->where('shared_profile_note_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $i += 1;
                }
            }
            
            $shared_profile_note_comment_responses = null;
            $shared_profile_note_comment_response_users = null;
            
            if(isset($shared_profile_note_comments[0]))
            {
                foreach($shared_profile_note_comments as $shared_profile_note_comment_array)
                {
                    foreach($shared_profile_note_comment_array as $shared_profile_note_comment)
                    {
                        $shared_profile_note_comment_responses[$j] = DB::table('shared_profile_note_c_response')->where('s_p_n_c_id', '=', $shared_profile_note_comment -> id)->where(function ($query) {$query->where('shared_profile_note_c_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(1, ['*'], 'note_comment_response_p');
                        $shared_profile_note_comment_response_users[$j] = DB::table('shared_profile_note_c_response')->join('users', 'shared_profile_note_c_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_note_c_response.user_id', 'shared_profile_note_c_response.id')->where('shared_profile_note_c_response.s_p_n_c_id', '=', $shared_profile_note_comment -> id)->where(function ($query) {$query->where('shared_profile_note_c_response.deleted_at', '=', null);})->orderBy('shared_profile_note_c_response.created_at', 'desc')->paginate(1, ['*'], 'note_comment_response_user_p');
                        $j += 1;
                    }
                }
            }
            
            $i = 0;
            $j = 0;
            
            $shared_profile_image_users = null;
            $shared_profile_image_comments = null;
            $shared_profile_image_comment_counts = null;
            $shared_profile_image_comment_users = null;
            $shared_profile_image_likes = null;
            
            if(isset($shared_profile_images[0]))
            {
                foreach($shared_profile_images as $shared_profile_image)
                {
                    $shared_profile_image_users[$i] = DB::table('shared_profile_image')->join('users', 'shared_profile_image.user_id', '=', 'users.id')->where('shared_profile_image.id', '=', $shared_profile_image -> id)->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('shared_profile_image.created_at', 'desc')->paginate(2, ['*'], 'image_user_p');
                    $shared_profile_image_comments[$i] = DB::table('shared_profile_image_c')->where('s_p_i_id', '=', $shared_profile_image -> id)->where(function ($query) {$query->where('shared_profile_image_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(2, ['*'], 'image_comment_p');
                    $shared_profile_image_comment_counts[$i] = DB::table('shared_profile_image_c')->where('s_p_i_id', '=', $shared_profile_image -> id)->where(function ($query) {$query->where('shared_profile_image_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $shared_profile_image_comment_users[$i] = DB::table('shared_profile_image_c')->join('users', 'shared_profile_image_c.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_image_c.user_id', 'shared_profile_image_c.id')->where('shared_profile_image_c.s_p_i_id', '=', $shared_profile_image -> id)->where(function ($query) {$query->where('shared_profile_image_c.deleted_at', '=', null);})->orderBy('shared_profile_image_c.created_at', 'desc')->paginate(2, ['*'], 'image_comment_user_p');
                    $shared_profile_image_likes[$i] = DB::table('shared_profile_image_like')->where('s_p_i_id', '=', $shared_profile_image -> id)->where(function ($query) {$query->where('shared_profile_image_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $i += 1;
                }
            }
            
            $shared_profile_image_comment_responses = null;
            $shared_profile_image_comment_response_users = null;
            
            if(isset($shared_profile_image_comments[0]))
            {
                foreach($shared_profile_image_comments as $shared_profile_image_comment_array)
                {
                    foreach($shared_profile_image_comment_array as $shared_profile_image_comment)
                    {
                        $shared_profile_image_comment_responses[$j] = DB::table('shared_profile_image_c_response')->where('s_p_i_c_id', '=', $shared_profile_image_comment -> id)->where(function ($query) {$query->where('shared_profile_image_c_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(1, ['*'], 'image_comment_response_p');
                        $shared_profile_image_comment_response_users[$j] = DB::table('shared_profile_image_c_response')->join('users', 'shared_profile_image_c_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_image_c_response.user_id', 'shared_profile_image_c_response.id')->where('shared_profile_image_c_response.s_p_i_c_id', '=', $shared_profile_image_comment -> id)->where(function ($query) {$query->where('shared_profile_image_c_response.deleted_at', '=', null);})->orderBy('shared_profile_image_c_response.created_at', 'desc')->paginate(1, ['*'], 'image_comment_response_user_p');
                        $j += 1;
                    }
                }
            }
            
            $i = 0;
            $j = 0;
            
            $shared_profile_audio_users = null;
            $shared_profile_audio_comments = null;
            $shared_profile_audio_comment_counts = null;
            $shared_profile_audio_comment_users = null;
            $shared_profile_audio_likes = null;
            
            if(isset($shared_profile_audios[0]))
            {
                foreach($shared_profile_audios as $shared_profile_audio)
                {
                    $shared_profile_audio_users[$i] = DB::table('shared_profile_audio')->join('users', 'shared_profile_audio.user_id', '=', 'users.id')->where('shared_profile_audio.id', '=', $shared_profile_audio -> id)->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('shared_profile_audio.created_at', 'desc')->paginate(2, ['*'], 'audio_user_p');
                    $shared_profile_audio_comments[$i] = DB::table('shared_profile_audio_c')->where('s_p_a_id', '=', $shared_profile_audio -> id)->where(function ($query) {$query->where('shared_profile_audio_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(2, ['*'], 'audio_comment_p');
                    $shared_profile_audio_comment_counts[$i] = DB::table('shared_profile_audio_c')->where('s_p_a_id', '=', $shared_profile_audio -> id)->where(function ($query) {$query->where('shared_profile_audio_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $shared_profile_audio_comment_users[$i] = DB::table('shared_profile_audio_c')->join('users', 'shared_profile_audio_c.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_audio_c.user_id', 'shared_profile_audio_c.id')->where('shared_profile_audio_c.s_p_a_id', '=', $shared_profile_audio -> id)->where(function ($query) {$query->where('shared_profile_audio_c.deleted_at', '=', null);})->orderBy('shared_profile_audio_c.created_at', 'desc')->paginate(2, ['*'], 'audio_comment_user_p');
                    $shared_profile_audio_likes[$i] = DB::table('shared_profile_audio_like')->where('s_p_a_id', '=', $shared_profile_audio -> id)->where(function ($query) {$query->where('shared_profile_audio_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $i += 1;
                }
            }
            
            $shared_profile_audio_comment_responses = null;
            $shared_profile_audio_comment_response_users = null;
            
            if(isset($shared_profile_audio_comments[0]))
            {
                foreach($shared_profile_audio_comments as $shared_profile_audio_comment_array)
                {
                    foreach($shared_profile_audio_comment_array as $shared_profile_audio_comment)
                    {
                        $shared_profile_audio_comment_responses[$j] = DB::table('shared_profile_audio_c_response')->where('s_p_a_c_id', '=', $shared_profile_audio_comment -> id)->where(function ($query) {$query->where('shared_profile_audio_c_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(1, ['*'], 'audio_comment_response_p');
                        $shared_profile_audio_comment_response_users[$j] = DB::table('shared_profile_audio_c_response')->join('users', 'shared_profile_audio_c_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_audio_c_response.user_id', 'shared_profile_audio_c_response.id')->where('shared_profile_audio_c_response.s_p_a_c_id', '=', $shared_profile_audio_comment -> id)->where(function ($query) {$query->where('shared_profile_audio_c_response.deleted_at', '=', null);})->orderBy('shared_profile_audio_c_response.created_at', 'desc')->paginate(1, ['*'], 'audio_comment_response_user_p');
                        $j += 1;
                    }
                }
            }
            
            $i = 0;
            $j = 0;
            
            $shared_profile_video_users = null;
            $shared_profile_video_comments = null;
            $shared_profile_video_comment_counts = null;
            $shared_profile_video_comment_users = null;
            $shared_profile_video_likes = null;
            
            if(isset($shared_profile_videos[0]))
            {
                foreach($shared_profile_videos as $shared_profile_video)
                {
                    $shared_profile_video_users[$i] = DB::table('shared_profile_video')->join('users', 'shared_profile_video.user_id', '=', 'users.id')->where('shared_profile_video.id', '=', $shared_profile_video -> id)->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('shared_profile_video.created_at', 'desc')->paginate(2, ['*'], 'video_user_p');
                    $shared_profile_video_comments[$i] = DB::table('shared_profile_video_c')->where('s_p_v_id', '=', $shared_profile_video -> id)->where(function ($query) {$query->where('shared_profile_video_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(2, ['*'], 'video_comment_p');
                    $shared_profile_video_comment_counts[$i] = DB::table('shared_profile_video_c')->where('s_p_v_id', '=', $shared_profile_video -> id)->where(function ($query) {$query->where('shared_profile_video_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $shared_profile_video_comment_users[$i] = DB::table('shared_profile_video_c')->join('users', 'shared_profile_video_c.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_video_c.user_id', 'shared_profile_video_c.id')->where('shared_profile_video_c.s_p_v_id', '=', $shared_profile_video -> id)->where(function ($query) {$query->where('shared_profile_video_c.deleted_at', '=', null);})->orderBy('shared_profile_video_c.created_at', 'desc')->paginate(2, ['*'], 'video_comment_user_p');
                    $shared_profile_video_likes[$i] = DB::table('shared_profile_video_like')->where('s_p_v_id', '=', $shared_profile_video -> id)->where(function ($query) {$query->where('shared_profile_video_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $i += 1;
                }
            }
            
            $shared_profile_video_comment_responses = null;
            $shared_profile_video_comment_response_users = null;
            
            if(isset($shared_profile_video_comments[0]))
            {
                foreach($shared_profile_video_comments as $shared_profile_video_comment_array)
                {
                    foreach($shared_profile_video_comment_array as $shared_profile_video_comment)
                    {
                        $shared_profile_video_comment_responses[$j] = DB::table('shared_profile_video_c_response')->where('s_p_v_c_id', '=', $shared_profile_video_comment -> id)->where(function ($query) {$query->where('shared_profile_video_c_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(1, ['*'], 'video_comment_response_p');
                        $shared_profile_video_comment_response_users[$j] = DB::table('shared_profile_video_c_response')->join('users', 'shared_profile_video_c_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_video_c_response.user_id', 'shared_profile_video_c_response.id')->where('shared_profile_video_c_response.s_p_v_c_id', '=', $shared_profile_video_comment -> id)->where(function ($query) {$query->where('shared_profile_video_c_response.deleted_at', '=', null);})->orderBy('shared_profile_video_c_response.created_at', 'desc')->paginate(1, ['*'], 'video_comment_response_user_p');
                        $j += 1;
                    }
                }
            }
            
            $shared_profile_files_list = DB::table('shared_profile_file')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(100, ['*'], 'shared_profile_file_list_p');
            $shared_profile_notes_list = DB::table('shared_profile_note')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(100, ['*'], 'shared_profile_note_list_p');
            $shared_profile_images_list = DB::table('shared_profile_image')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(100, ['*'], 'shared_profile_image_list_p');
            $shared_profile_audios_list = DB::table('shared_profile_audio')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(100, ['*'], 'shared_profile_audio_list_p');
            $shared_profile_videos_list = DB::table('shared_profile_video')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(100, ['*'], 'shared_profile_video_list_p');
            
            $i = 0;
            $j = 0;
    
            $shared_profile_file_users_list = null;
            $shared_profile_file_likes_list = null;
    
            if(isset($shared_profile_files_list[0]))
            {
                foreach($shared_profile_files_list as $shared_profile_file_list)
                {
                    $shared_profile_file_users_list[$i] = DB::table('shared_profile_file')->join('users', 'shared_profile_file.user_id', '=', 'users.id')->where('shared_profile_file.id', '=', $shared_profile_file_list -> id)->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('shared_profile_file.created_at', 'desc')->paginate(100, ['*'], 'file_user_list_p');
                    $shared_profile_file_likes_list[$i] = DB::table('shared_profile_file_like')->where('s_p_f_id', '=', $shared_profile_file_list -> id)->where(function ($query) {$query->where('shared_profile_file_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $i += 1;
                }
            }
            
            $i = 0;
            $j = 0;
            
            $shared_profile_note_users_list = null;
            $shared_profile_note_likes_list = null;
    
            if(isset($shared_profile_notes_list[0]))
            {
                foreach($shared_profile_notes_list as $shared_profile_note_list)
                {
                    $shared_profile_note_users_list[$i] = DB::table('shared_profile_note')->join('users', 'shared_profile_note.user_id', '=', 'users.id')->where('shared_profile_note.id', '=', $shared_profile_note_list -> id)->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('shared_profile_note.created_at', 'desc')->paginate(100, ['*'], 'note_user_list_p');
                    $shared_profile_note_likes_list[$i] = DB::table('shared_profile_note_like')->where('s_p_n_id', '=', $shared_profile_note_list -> id)->where(function ($query) {$query->where('shared_profile_note_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $i += 1;
                }
            }
            
            $i = 0;
            $j = 0;
            
            $shared_profile_image_users_list = null;
            $shared_profile_image_likes_list = null;
            
            if(isset($shared_profile_images_list[0]))
            {
                foreach($shared_profile_images_list as $shared_profile_image_list)
                {
                    $shared_profile_image_users_list[$i] = DB::table('shared_profile_image')->join('users', 'shared_profile_image.user_id', '=', 'users.id')->where('shared_profile_image.id', '=', $shared_profile_image_list -> id)->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('shared_profile_image.created_at', 'desc')->paginate(100, ['*'], 'image_user_list_p');
                    $shared_profile_image_likes_list[$i] = DB::table('shared_profile_image_like')->where('s_p_i_id', '=', $shared_profile_image_list -> id)->where(function ($query) {$query->where('shared_profile_image_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $i += 1;
                }
            }
            
            $i = 0;
            $j = 0;
            
            $shared_profile_audio_users_list = null;
            $shared_profile_audio_likes_list = null;
            
            if(isset($shared_profile_audios_list[0]))
            {
                foreach($shared_profile_audios_list as $shared_profile_audio_list)
                {
                    $shared_profile_audio_users_list[$i] = DB::table('shared_profile_audio')->join('users', 'shared_profile_audio.user_id', '=', 'users.id')->where('shared_profile_audio.id', '=', $shared_profile_audio_list -> id)->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('shared_profile_audio.created_at', 'desc')->paginate(100, ['*'], 'audio_user_list_p');
                    $shared_profile_audio_likes_list[$i] = DB::table('shared_profile_audio_like')->where('s_p_a_id', '=', $shared_profile_audio_list -> id)->where(function ($query) {$query->where('shared_profile_audio_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $i += 1;
                }
            }
            
            $i = 0;
            $j = 0;
            
            $shared_profile_video_users_list = null;
            $shared_profile_video_likes_list = null;
            
            if(isset($shared_profile_videos_list[0]))
            {
                foreach($shared_profile_videos_list as $shared_profile_video_list)
                {
                    $shared_profile_video_users_list[$i] = DB::table('shared_profile_video')->join('users', 'shared_profile_video.user_id', '=', 'users.id')->where('shared_profile_video.id', '=', $shared_profile_video_list -> id)->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('shared_profile_video.created_at', 'desc')->paginate(100, ['*'], 'video_user_p');
                    $shared_profile_video_likes_list[$i] = DB::table('shared_profile_video_like')->where('s_p_v_id', '=', $shared_profile_video_list -> id)->where(function ($query) {$query->where('shared_profile_video_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                    $i += 1;
                }
            }
            
            $i = 0;
            $j = 0;
            
            $files_list = DB::table('shared_profile_file')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('created_at', 'desc')->limit(10)->get();
            $notes_list = DB::table('shared_profile_note')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('created_at', 'desc')->limit(10)->get();
            $images_list = DB::table('shared_profile_image')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('created_at', 'desc')->limit(10)->get();
            $audios_list = DB::table('shared_profile_audio')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('created_at', 'desc')->limit(10)->get();
            $videos_list = DB::table('shared_profile_video')->where('user_id', $user_id)->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('created_at', 'desc')->limit(10)->get();
        
            return view('sharedProfile')
                ->with('user', $user)
                ->with('files', $files)
                ->with('notes', $notes)
                ->with('images', $images)
                ->with('audios', $audios)
                ->with('videos', $videos)
                ->with('sharedProfiles', $shared_profiles)
                ->with('sharedProfileFiles', $shared_profile_files)
                ->with('sharedProfileNotes', $shared_profile_notes)
                ->with('sharedProfileImages', $shared_profile_images)
                ->with('sharedProfileAudios', $shared_profile_audios)
                ->with('sharedProfileVideos', $shared_profile_videos)
                ->with('sharedProfileFileUsers', $shared_profile_file_users)
                ->with('sharedProfileNoteUsers', $shared_profile_note_users)
                ->with('sharedProfileImageUsers', $shared_profile_image_users)
                ->with('sharedProfileAudioUsers', $shared_profile_audio_users)
                ->with('sharedProfileVideoUsers', $shared_profile_video_users)
                ->with('sharedProfileFileComments', $shared_profile_file_comments)
                ->with('sharedProfileNoteComments', $shared_profile_note_comments)
                ->with('sharedProfileImageComments', $shared_profile_image_comments)
                ->with('sharedProfileAudioComments', $shared_profile_audio_comments)
                ->with('sharedProfileVideoComments', $shared_profile_video_comments)
                ->with('sharedProfileFileCommentUsers', $shared_profile_file_comment_users)
                ->with('sharedProfileNoteCommentUsers', $shared_profile_note_comment_users)
                ->with('sharedProfileImageCommentUsers', $shared_profile_image_comment_users)
                ->with('sharedProfileAudioCommentUsers', $shared_profile_audio_comment_users)
                ->with('sharedProfileVideoCommentUsers', $shared_profile_video_comment_users)
                ->with('sharedProfileFileCommentCounts', $shared_profile_file_comment_counts)
                ->with('sharedProfileNoteCommentCounts', $shared_profile_note_comment_counts)
                ->with('sharedProfileImageCommentCounts', $shared_profile_image_comment_counts)
                ->with('sharedProfileAudioCommentCounts', $shared_profile_audio_comment_counts)
                ->with('sharedProfileVideoCommentCounts', $shared_profile_video_comment_counts)
                ->with('sharedProfileFileLikes', $shared_profile_file_likes)
                ->with('sharedProfileNoteLikes', $shared_profile_note_likes)
                ->with('sharedProfileImageLikes', $shared_profile_image_likes)
                ->with('sharedProfileAudioLikes', $shared_profile_audio_likes)
                ->with('sharedProfileVideoLikes', $shared_profile_video_likes)
                ->with('sharedProfileFileCommentResponses', $shared_profile_file_comment_responses)
                ->with('sharedProfileNoteCommentResponses', $shared_profile_note_comment_responses)
                ->with('sharedProfileImageCommentResponses', $shared_profile_image_comment_responses)
                ->with('sharedProfileAudioCommentResponses', $shared_profile_audio_comment_responses)
                ->with('sharedProfileVideoCommentResponses', $shared_profile_video_comment_responses)
                ->with('sharedProfileFileCommentResponseUsers', $shared_profile_file_comment_response_users)
                ->with('sharedProfileNoteCommentResponseUsers', $shared_profile_note_comment_response_users)
                ->with('sharedProfileImageCommentResponseUsers', $shared_profile_image_comment_response_users)
                ->with('sharedProfileAudioCommentResponseUsers', $shared_profile_audio_comment_response_users)
                ->with('sharedProfileVideoCommentResponseUsers', $shared_profile_video_comment_response_users)
                ->with('now', $now)
                ->with('user_id', $user_id)
                ->with('files_list', $files_list)
                ->with('notes_list', $notes_list)
                ->with('images_list', $images_list)
                ->with('audios_list', $audios_list)
                ->with('videos_list', $videos_list)
                ->with('sharedProfileFilesList', $shared_profile_files_list)
                ->with('sharedProfileNotesList', $shared_profile_notes_list)
                ->with('sharedProfileImagesList', $shared_profile_images_list)
                ->with('sharedProfileAudiosList', $shared_profile_audios_list)
                ->with('sharedProfileVideosList', $shared_profile_videos_list)
                ->with('sharedProfileFileUsersList', $shared_profile_file_users_list)
                ->with('sharedProfileNoteUsersList', $shared_profile_note_users_list)
                ->with('sharedProfileImageUsersList', $shared_profile_image_users_list)
                ->with('sharedProfileAudioUsersList', $shared_profile_audio_users_list)
                ->with('sharedProfileVideoUsersList', $shared_profile_video_users_list)
                ->with('sharedProfileFileLikesList', $shared_profile_file_likes_list)
                ->with('sharedProfileNoteLikesList', $shared_profile_note_likes_list)
                ->with('sharedProfileImageLikesList', $shared_profile_image_likes_list)
                ->with('sharedProfileAudioLikesList', $shared_profile_audio_likes_list)
                ->with('sharedProfileVideoLikesList', $shared_profile_video_likes_list)
                ->with('sharedProfileFileCommentsList', $shared_profile_file_comments_list)
                ->with('sharedProfileFileCommentResponsesList', $shared_profile_file_comment_responses_list)
                ->with('sharedProfileFileLikesListC', $shared_profile_file_likes_list_c)
                ->with('sharedProfileFileCommentsListCount', $shared_profile_file_comments_list_count)
                ->with('sharedProfileFileCommentResponsesListCount', $shared_profile_file_comment_responses_list_count)
                ->with('sharedProfileFileLikesListCount', $shared_profile_file_likes_list_count)
                ->with('sharedProfileNoteCommentsList', $shared_profile_note_comments_list)
                ->with('sharedProfileNoteCommentResponsesList', $shared_profile_note_comment_responses_list)
                ->with('sharedProfileNoteLikesListC', $shared_profile_note_likes_list_c)
                ->with('sharedProfileNoteCommentsListCount', $shared_profile_note_comments_list_count)
                ->with('sharedProfileNoteCommentResponsesListCount', $shared_profile_note_comment_responses_list_count)
                ->with('sharedProfileNoteLikesListCount', $shared_profile_note_likes_list_count)
                ->with('sharedProfileImageCommentsList', $shared_profile_image_comments_list)
                ->with('sharedProfileImageCommentResponsesList', $shared_profile_image_comment_responses_list)
                ->with('sharedProfileImageLikesListC', $shared_profile_image_likes_list_c)
                ->with('sharedProfileImageCommentsListCount', $shared_profile_image_comments_list_count)
                ->with('sharedProfileImageCommentResponsesListCount', $shared_profile_image_comment_responses_list_count)
                ->with('sharedProfileImageLikesListCount', $shared_profile_image_likes_list_count)
                ->with('sharedProfileAudioCommentsList', $shared_profile_audio_comments_list)
                ->with('sharedProfileAudioCommentResponsesList', $shared_profile_audio_comment_responses_list)
                ->with('sharedProfileAudioLikesListC', $shared_profile_audio_likes_list_c)
                ->with('sharedProfileAudioCommentsListCount', $shared_profile_audio_comments_list_count)
                ->with('sharedProfileAudioCommentResponsesListCount', $shared_profile_audio_comment_responses_list_count)
                ->with('sharedProfileAudioLikesListCount', $shared_profile_audio_likes_list_count)
                ->with('sharedProfileVideoCommentsList', $shared_profile_video_comments_list)
                ->with('sharedProfileVideoCommentResponsesList', $shared_profile_video_comment_responses_list)
                ->with('sharedProfileVideoLikesListC', $shared_profile_video_likes_list_c)
                ->with('sharedProfileVideoCommentsListCount', $shared_profile_video_comments_list_count)
                ->with('sharedProfileVideoCommentResponsesListCount', $shared_profile_video_comment_responses_list_count)
                ->with('sharedProfileVideoLikesListCount', $shared_profile_video_likes_list_count)
                ->with('shared_profile_file_lists', $shared_profile_file_lists)
                ->with('shared_profile_note_lists', $shared_profile_note_lists)
                ->with('shared_profile_image_lists', $shared_profile_image_lists)
                ->with('shared_profile_audio_lists', $shared_profile_audio_lists)
                ->with('shared_profile_video_lists', $shared_profile_video_lists)
                ->with('sharedProfileFileListUsers', $shared_profile_file_list_users)
                ->with('sharedProfileNoteListUsers', $shared_profile_note_list_users)
                ->with('sharedProfileImageListUsers', $shared_profile_image_list_users)
                ->with('sharedProfileAudioListUsers', $shared_profile_audio_list_users)
                ->with('sharedProfileVideoListUsers', $shared_profile_video_list_users);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}