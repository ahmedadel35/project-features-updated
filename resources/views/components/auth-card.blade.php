<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
    <div class="hidden sm:block md:col-span-2 bg-gray-900">
        <img src="http://images.test/photo-1558637845-c8b7ead71a3e.jpeg" class="object-cover w-full h-full" alt="animate-bg" />
    </div>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-20 card-bg">
        <div>
            {{ $logo }}
        </div>
    
        <div class="w-full mx-auto p-3">
            {{ $slot }}
        </div>
    </div>    
</div>