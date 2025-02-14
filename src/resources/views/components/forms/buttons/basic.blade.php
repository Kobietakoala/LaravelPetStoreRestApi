
    <button 
    id={{$id}}
        class="shadow bg-yellow-700 hover:bg-yellow-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded mr-4" 
        
    >
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
