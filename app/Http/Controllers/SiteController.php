<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Proposal;
use App\Notifications\NewProposal;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $latest_project = Project::latest('id')->paginate(2);

            return view('site.parts.latest_projects', compact('latest_project'))->render();
        }


        $top_cats = Category::with('projects')->withCount('projects')->orderBy('projects_count', 'desc')->take(4)->get();

        $latest_project = Project::latest('id')->paginate(2);

        // dd($top_cats);

        return view('site.index', compact('top_cats', 'latest_project'));
    }

    public function category(Category $category)
    // public function category($slug)
    {
        // $category = Category::where('slug', $slug)->firstOrFail();
        $category->load('projects');
        // dd($category);

        $projects = $category->projects()->paginate(2);



        return view('site.jobs', compact('category', 'projects'));
    }

    public function project(Project $project)
    {
        return view('site.project', compact('project'));
    }

    public function apply_now(Project $project)
    {
        // Send Notification To Project Owner
        $user = $project->user;
        // dd($user);
        if($user->channel_type) {
            $msg = "There is new Proposal Submitted to '".$project->trans_name."'";
            $url = route('site.project', $project->slug);
            $user->notify(new NewProposal($msg, $url));
        }

        return view('site.apply_now', compact('project'));
    }

    public function apply_now_data(Request $request, Project $project)
    {
        // dd($slug);
        $request->validate([
            'cost' => 'required',
            'time' => 'required',
            'content' => 'required',
        ]);

        Proposal::create([
            'employee_id' => $request->employee_id,
            'project_id' => $request->project_id,
            'content' => $request->content,
            'time' => $request->time,
            'cost' => str_replace('$', '', $request->cost)
        ]);




        return redirect()->route('site.project', $project->slug);
    }

    public function delete_proposal($id)
    {
        Proposal::destroy($id);

        return redirect()->back();
    }

    public function user_profile()
    {
        return view('site.user_profile');
    }

    public function read_notify($id)
    {
        // dd( Auth::user()->notifications->find($id) );
        // dd( DatabaseNotification::find($id) );
        // DatabaseNotification::find($id)->update([
        //     'read_at' => now()
        // ]);

        $notify = DatabaseNotification::find($id);
        // dd($notify->data['url']);
        $notify->markAsRead();

        return redirect($notify->data['url']);
    }
}
