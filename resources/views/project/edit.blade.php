@include('project.form-page', [
    'putMethod' => true,
    'title' => 'update',
    'url' => route('projects.update', [$category->slug, $project->slug]),
    'category' => $category,
    'vals' => [
        'name' => $project->name,
        'cost' => $project->cost,
        'info' => $project->info,
    ]
])