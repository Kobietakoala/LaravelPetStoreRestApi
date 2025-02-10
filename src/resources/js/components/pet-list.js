
document.addEventListener('DOMContentLoaded', () => {
    updatePetsList()
});


export function updatePetsList() {
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

    const petListContainer = document.getElementById('pet-list-ul');
    if (!petListContainer) {
        console.error('Nie znaleziono elementu #pet-list-ul.');
        return;
    }

    const listItemsHtml = petList.map(pet => {
        return `
            <li onclick= "loadPetToForm('${pet.id}')" class="py-1 md:my-2 hover:bg-yellow-100 lg:hover:bg-transparent border-l-4 border-transparent font-bold border-yellow-600">
                <a href="#" class="block pl-4 align-middle text-gray-700 no-underline hover:text-yellow-600">
                    <span class="pb-1 md:pb-0 text-sm">${pet.name}</span>
                </a>
            </li>
        `;
    }).join('');

    petListContainer.innerHTML = listItemsHtml;
}

