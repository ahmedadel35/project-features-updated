@include('project.form-page', [
    'title' => 'create',
    'url' => route('projects.store', $category->slug),
    'category' => $category,
    'vals' => [
        'name' => old('name'),
        'cost' => old('cost'),
        'info' => old('info'),
    ]
])