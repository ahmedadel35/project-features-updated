@include('project.form-page', [
    'title' => 'create',
    'url' => route('projects.store', $category?->slug ?? 'category-placeholder-slug'),
    'fake_slug' => 'category-placeholder-slug',
    'category' => $category,
    'categories' => $categories,
    'vals' => [
        'name' => old('name'),
        'cost' => old('cost'),
        'info' => old('info'),
    ]
])