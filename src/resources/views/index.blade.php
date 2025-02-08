<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Store</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <style>
        .max-h-64 {
            max-height: 16rem;
        }

        .form-input,
        .form-textarea,
        .form-select,
        .form-multiselect {
            background-color: #edf2f7;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-900 tracking-wider leading-normal">

    <div class="container w-full flex flex-wrap mx-auto px-2 pt-8 lg:pt-16 mt-16">
        <x-pet-list />

        <section class="w-full lg:w-4/5">
            <x-forms.blockquote text="Select your pet on left to update or create one with this form."/>

            <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

                <form action="api/pet">
                    @method('POST')

                    <x-forms.text-field id="name" label="Pet Name:"/>
                    <x-forms.text-field id="photo_urls" label="Photo URLs (comma separated):" description="http://somePhoto.com" />
                    <x-forms.radio-list-group id="pet_category" label="Pet category:" name="pet_category" optionListName="petCategories"/>
                    <x-forms.checkbox-list-group id="pet_tags" label="Tags:" name="pet_tags"  optionListName="petTags"/>
                    <x-forms.radio-list-group id="pet_statua" label="Pet status:" name="pet_status" optionListName="petStatuses"/>
                    <div class="pt-8">
                        <x-forms.buttons.basic />
                        <x-forms.buttons.additonal textType='1'/>
                    </div>
                </form>

            </div>
        </section>
</body>

</html>