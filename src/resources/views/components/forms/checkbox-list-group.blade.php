<div class="md:flex mb-6">
    <div class="md:w-1/3">
        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-checkbox">
            {{$label}}
        </label>
    </div>
    <div class="md:w-2/3">
        @foreach ($options as $option)
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox text-indigo-600">
                <span class="ml-2">{{$option['name']}}</span>
            </label>
        </div>
        @endforeach
        
        @isset ($description)
            <p class="py-2 text-sm text-gray-600">{{$description}}</p>
        @endisset
    </div>
</div>