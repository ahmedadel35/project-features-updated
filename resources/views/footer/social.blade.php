<div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0" dir="ltr">
    @php
        $links = [
            (object) [
                'href' => 'https://github.com/abo3adel',
                'icon' => 'github',
                'sr_text' => 'Github Page'
            ],
            (object) [
                'href' => 'https://www.linkedin.com/in/ahmed-adel-30a932119/',
                'icon' => 'linkedin',
                'sr_text' => 'linkedin Page'
            ],
            (object) [
                'href' => 'https://fb.com/a7md200',
                'icon' => 'facebook',
                'sr_text' => 'facebook Page'
            ],
            (object) [
                'href' => 'https://wa.me/201143647417',
                'icon' => 'whatsapp',
                'sr_text' => 'whatsapp Page'
            ],
        ];
    @endphp

    @foreach ($links as $link)
    <a href="{{$link->href}}" target='_blank' class="text-gray-200 hover:text-gray-900 dark:hover:text-white">
        @svg('fab-' . $link->icon)
        <span class="sr-only">{{$link->sr_text}}</span>
    </a>
            
    @endforeach
</div>