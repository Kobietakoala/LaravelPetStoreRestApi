<div class="w-full lg:w-1/5 px-6 text-xl text-gray-800 leading-normal">
    <p class="text-base font-bold py-2 lg:pb-6 text-gray-700">Pets</p>
    <div class="w-full sticky inset-0 hidden max-h-64 lg:h-auto overflow-x-hidden overflow-y-auto lg:overflow-y-hidden lg:block mt-0 my-2 lg:my-0 border border-gray-400 lg:border-transparent bg-white shadow lg:shadow-none lg:bg-transparent z-20" style="top:6em;" id="menu-content">
        <ul class="list-reset py-2 md:py-0">
            @foreach ($petList as $pet)
                <li class="py-1 md:my-2 hover:bg-yellow-100 lg:hover:bg-transparent border-l-4 border-transparent font-bold border-yellow-600">
                    <a href='' class="block pl-4 align-middle text-gray-700 no-underline hover:text-yellow-600">
                        <span class="pb-1 md:pb-0 text-sm">{{$pet['name']}}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>