<div class="flex items-center justify-center w-full pt-6 md:pt-2">
    <div class="border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
            {{debug($category)}}
            @php
                $tabs = [
                    [
                        'icon' => 'table-cells',
                        'value' => 'all',
                        'text' => __('project.tabs.all'),
                        'url_addon' => \App\Enums\ProjectTab::All->value,
                    ],
                    [
                        'icon' => 'user',
                        'value' => 'mine',
                        'text' => __('project.tabs.mine'),
                        'url_addon' => \App\Enums\ProjectTab::Mine->value,
                    ],
                    [
                        'icon' => 'feather',
                        'value' => 'invited',
                        'text' => __('project.tabs.invited'),
                        'url_addon' => \App\Enums\ProjectTab::Invited->value,
                    ],
                ];
            @endphp
            @foreach ($tabs as $tab)
                @php $tab = (object)$tab; @endphp
                <li class="mr-2">
                    <a href="{{ url()->current() === route('projects.index', $tab->url_addon) ? '#' : route('projects.index', $tab->url_addon) }}"
                        x-data="{
                            busy: false,
                            active: {{url()->current() === route('projects.index', $tab->url_addon) ? 1 : 0}},
                            goTo: function(){
                                if (this.active) return false;

                                this.busy = true;
                            },
                        }"
                        x-on:click="goTo"
                        class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent group @if (url()->current() === route('projects.index', $tab->url_addon)) text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500 @else hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 @endif">
                        <span x-show="!busy">
                            @svg('fas-' . $tab->icon)
                        </span>
                        <x-btn-spinner x-show='busy' style="color: blue;" />
                        {{ $tab->text }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
