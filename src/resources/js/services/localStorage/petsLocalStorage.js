export function addPetToStorage(newPet) {
    const petsJson = localStorage.getItem('pets')
    let pets = petsJson === null ? [] : JSON.parse(petsJson)

    newPet.photoUrls = newPet.photoUrls.join(', ')
    if (newPet.tags) {
        newPet.tags = newPet.tags.map((tag) => { return tag.name })
    }

    if (pets.length === 0 || !getPetFromStorage(newPet.id)) {
        pets.push({
            id: newPet.id,
            name: newPet.name
        })
    } else {
        pets = pets.map((pet) => {
            if (pet.id === newPet.id) {
                return {
                    id: newPet.id,
                    name: newPet.name
                }
            }
            return {
                id: pet.id,
                name: pet.name
            };
        })
    }

    localStorage.setItem('pets', JSON.stringify(pets))
}

export function getPetFromStorage(pet_id) {
    const petListJson = localStorage.getItem('pets');

    if (!petListJson) {
        console.warn('Brak danych petList w localStorage.');
        return;
    }

    let petList;
    try {
        petList = JSON.parse(petListJson);
    } catch (error) {
        console.error('Błąd podczas parsowania danych petList z localStorage:', error);
        return;
    }

    if (!Array.isArray(petList)) {
        console.error('Dane petList nie są tablicą.');
        return;
    }

    return petList.filter((value) => { return value.id === pet_id }, petList)[0];
}