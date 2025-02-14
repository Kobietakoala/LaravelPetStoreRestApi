<div class="md:flex mb-6">
    <div class="md:w-1/3">
        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for={{$id}}>
            {{$label}}
        </label>
    </div>
    <div class="md:w-2/3">
        <input class="form-input block w-full focus:bg-white" id={{$id}} name={{$name}} type="text" value="">
        @isset($description)
            <p class="py-2 text-sm text-gray-600">{{$description}}</p>
        @endisset
    </div>
</div>