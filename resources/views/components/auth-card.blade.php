<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 auth-card">
    <div class="relative hidden bg-gray-900 sm:block md:col-span-2">
        <img src="https://images.unsplash.com/photo-1502640403806-cf2ac7a5d37a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" class="object-cover w-full h-full" alt="cover-bg" title="Photo by Flying Carpet on Unsplash" onload="lazyLoadIt('cover-bg-99')" />

        <div class="absolute px-2 py-1 font-semibold text-white bg-gray-900 rounded bottom-5 ltr:left-0 rtl:right-0 bg-opacity-70">
            Photo by <a href="https://unsplash.com/@flying_carpet_tours?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Flying Carpet</a> on <a href="https://unsplash.com/s/photos/egypt?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
        </div>
    </div>
    <div class="flex flex-col items-center min-h-screen pt-20 sm:justify-center card-bg">
        <div class="logo">
            {{ $logo }}
        </div>
    
        <div class="w-full p-3 mx-auto">
            {{ $slot }}
        </div>
    </div>    
</div>