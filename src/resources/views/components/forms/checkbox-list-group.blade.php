<div class="md:flex mb-6">
    <div class="md:w-1/3">
        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for={{$id}}>
            {{$label}}
        </label>
    </div>
    <div id={{$id}} class="md:w-2/3">
        @foreach ($optionsArray as $option)
        <div>
            <label class="inline-flex items-center">
                <input name={{$name}} type="checkbox" class="form-checkbox text-indigo-600" value="{{$option->value}}">
                <span class="ml-2">{{$option->value}}</span>
            </label>
        </div>
        @endforeach
        
        @isset ($description)
            <p class="py-2 text-sm text-gray-600">{{$description}}</p>
        @endisset
    </div>
</div>