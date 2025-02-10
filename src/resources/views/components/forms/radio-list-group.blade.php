<div class="md:flex mb-6">
    <div class="md:w-1/3">
        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for={{$id}}>
            {{$label}}
        </label>
    </div>
    <div class="md:w-2/3">
        <div class="mt-2">
            @foreach ($optionsArray as $option)
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio text-indigo-600" id={{$id}} name={{$name}} value='{{$option['value']}}'>
                    <span class="ml-2">{{$option['name']}}</span>
                </label>
            @endforeach
        </div>
        @isset($description)
            <p class="py-2 text-sm text-gray-600">{{$description}}</p>
        @endisset
    </div>
</div>