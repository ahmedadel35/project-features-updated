@include('project.form-page', [
    'putMethod' => true,
    'title' => 'update',
    'url' => route('projects.update', [$category->slug, $project->slug]),
    'category' => $category,
    'fake_slug' => 'category-placeholder-slug',
    'categories' => [],
    'vals' => [
        'name' => $project->name,
        'cost' => $project->cost,
        'info' => $project->info,
    ]
])