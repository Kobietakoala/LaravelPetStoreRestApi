<button id={{$id}} class="shadow bg-yellow-100 hover:bg-yellow-200 focus:shadow-outline focus:outline-none text-gray-700 font-bold py-2 px-4 rounded mr-4" type="button" >
    @switch($textType)
           @case(0)
               Create
               @break
           @case(1)
               Cancel
               @break
           @default
               Button type not found
    @endswitch
</button>