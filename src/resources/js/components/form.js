import { getPetFromStorage } from "../services/localStorage/petsLocalStorage";

export function clearForm() {
    document.getElementById('id').setAttribute('value', '')
    document.getElementById('name').setAttribute('value', '')
    document.getElementById('photo_urls').setAttribute('value', '')

    let inputs = document.getElementsByName('category');
    inputs.forEach((input) => {
        input.checked = false
    })

    inputs = document.getElementsByName('tags');
    inputs.forEach((input) => {
        input.checked = false
    })

    inputs = document.getElementsByName('status');
    inputs.forEach((input) => {
        input.checked = false
    })

    // button text update
    document.getElementById('sendPet').innerHTML = 'Create';
}


export function loadPetToForm(id) {
    const pet = getPetFromStorage(id)
    clearForm()

    document.getElementById('id').setAttribute('value', pet.id)
    document.getElementById('name').setAttribute('value', pet.name)
    document.getElementById('photo_urls').setAttribute('value', pet.photoUrls)

    if (pet.category) {
        const inputs = document.getElementsByName('category');
        inputs.forEach((input) => {
            if (input.value === pet.category.name) {
                input.checked = true
            }
        })
    }

    if (pet.tags) {
        const inputs = document.getElementsByName('tags');
        inputs.forEach((input) => {
            if ((pet.tags).includes(input.value)) {
                input.checked = true
            }
        })
    }

    if (pet.status) {
        const inputs = document.getElementsByName('status');
        inputs.forEach((input) => {
            if (input.value === pet.status) {
                input.checked = true
            }
        })
    }

    // button text update
    document.getElementById('sendPet').innerHTML = 'Update';
}