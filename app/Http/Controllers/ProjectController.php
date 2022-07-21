<?php

namespace App\Http\Controllers;

use App\Enums\ProjectTab;
use App\Models\Category;
use App\Models\Project;
use App\Models\Todo;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Auth;
use Blade;
use DB;
use Hashids;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use View;

class ProjectController extends Controller
{
    const VALIDATION_RULES = [
        'name' => 'required|string|max:255',
        'cost' => 'required|numeric|min:1.00',
        'info' => 'required|string|max:255',
    ];

    public function __construct(Request $request)
    {
        $this->authorizeResource(Project::class, 'project');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectTab $projectTab)
    {
        SEOTools::setTitle(
            __('project.tabs.' . $projectTab->value) . ' ' . __('nav.projects')
        );

        $categories = $invitedToProjects = [];

        if (
            $projectTab === ProjectTab::All ||
            $projectTab === ProjectTab::Mine
        ) {
            $categories = Category::whereUserId(Auth::id())
                ->get(['id'])
                ->pluck('id');
        }

        if (
            $projectTab === ProjectTab::All ||
            $projectTab === ProjectTab::Invited
        ) {
            $invitedToProjects = DB::table('project_user')
                ->where('user_id', Auth::id())
                ->get('project_id')
                ->pluck('project_id');
        }

        $projects = QueryBuilder::for(Project::class)
            ->with('team', 'category')
            ->orWhere(
                fn($q) => $q
                    ->whereIn('id', $invitedToProjects)
                    ->orWhereIn('category_id', $categories)
            )
            ->defaultSort('-updated_at')
            ->allowedFilters([AllowedFilter::exact('completed')])
            ->allowedSorts('name', 'cost', 'updated_at')
            ->simplePaginate()
            ->appends(request()->query());

        return view('project.index', [
            'projects' => $projects,
            'category' => null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(?Category $category = null)
    {
        SEOTools::setTitle(__('nav.create_project'));

        $categories = [];
        if ($category === null) {
            $categories = Category::whereUserId(Auth::id())->get([
                'slug',
                'title',
            ]);

            if ($categories->isEmpty()) {
                // redirect to category create page
                session()->flash('notify', __('project.category_first'));
                return redirect()->route('categories.index');
            }
        }

        return view('project.create', compact('category', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $proj = $category
            ->projects()
            ->create(request()->validate(self::VALIDATION_RULES));

        return redirect()->route('projects.show', [
            $category->slug,
            $proj->slug,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Category $category, Project $project)
    {
        SEOTools::setTitle($project->name . ' ' . __('nav.todos'));

        return view('task.index', compact('category', 'project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, Project $project)
    {
        SEOTools::setTitle(__('nav.edit_project') . ' ' . $project->name);

        return view('project.edit', compact('category', 'project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(
        Request $request,
        Category $category,
        Project $project
    ) {
        $project->update(request()->validate(self::VALIDATION_RULES));

        return redirect()->route('projects.show', [
            $category->slug,
            $project->slug,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Project $project)
    {
        $project->delete();

        return response()->noContent();
    }

    public function invite(Category $category, Project $project)
    {
        $req = request()->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::firstWhere('email', '=', $req['email']);

        if (!$project->addToTeam($user)) {
            // user already member of this team
            return response()->json(
                [
                    'message' => __('project.is_team'),
                ],
                422
            );
        }

        $html = file_get_contents(View::getFinder()->find('components.avatar'));

        return Blade::render(
            str_replace(
                ["@props(['src', 'title', 'id' => 'a' . random_int(1, 6999)])"],
                '',
                $html
            ),
            [
                'src' => $user->avatar,
                'id' => 'a' . random_int(1, 9999),
                'title' => $user->name,
                'attributes' => "alt='" . $user->name . " avatar'",
            ]
        );
    }

    /**
     * allow user to refuse invitaion to project
     *
     * @param Category $category
     * @param Project $project
     * @return void
     */
    public function refuse(
        Category $category,
        Project $project,
        ?string $user_id = null
    ) {
        if (null !== $user_id) {
            // assert this is project owner
            $this->authorize('update', $project);

            // decode hashed user id
            $id = Hashids::decode($user_id);

            if (empty($id)) {
                // this hash was wrong
                return null;
            }

            // remove user from team
            $project->removeFromTeam(User::findOrFail($id[0]));

            return response()->noContent();
        }

        $project->removeFromTeam(Auth::user());

        return response()->noContent();
    }
}
