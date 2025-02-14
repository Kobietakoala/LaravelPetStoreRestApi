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
            <x-forms.blockquote
                text="Select your pet on left to update or create one with this form. Cancel to clear form." />

            <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <form id="pet-form">
                    <input type="hidden" id="id" name="id">
                    <x-forms.text-field label="Pet Name:" name="name" id="name" />
                    <x-forms.text-field id="photo_urls" name="photoUrls" label="Photo URLs (comma separated):"
                        description="http://yundt.com/tempora.html" />
                    <x-forms.radio-list-group id="pet_category" label="Pet category:" name="category"
                        optionListName="petCategories" />
                    <x-forms.checkbox-list-group id="pet_tags" label="Tags:" name="tags" optionListName="petTags" />
                    <x-forms.radio-list-group id="pet_status" label="Pet status:" name="status"
                        optionListName="petStatuses" />
                    <div class="pt-8">
                        <x-forms.buttons.basic id="sendPet" />
                        <x-forms.buttons.additonal id="cancel" textType='1' />
                    </div>
                </form>
            </div>

        </section>


        <div class="fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 backdrop-blur-sm hidden"
            id="modal-loading" data-backdrop="static">
            <div class="relative m-4 p-4 w-2/5 min-w-[40%] max-w-[40%] rounded-lg bg-white shadow-sm">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div class="loading-spinner mb-2"></div>
                        <div>Loading</div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>