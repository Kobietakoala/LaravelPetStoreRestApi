import { apiRoutes, apiRequest } from '../api';
import { updatePetsList } from '../components/pet-list';
import { addPetToStorage } from './localStorage/petsLocalStorage';

export async function createOrUpdatePet(event) {
    event.preventDefault();

    const form = event.target.closest('form');
    const formData = new FormData(form);
    const petData = Object.fromEntries(formData.entries());

    petData['photoUrls'] = formData.get('photoUrls').split(',').map(url => url.trim());
    petData['tags'] = formData.getAll('tags').map((tag) => { return { 'id': 0, 'name': tag }; });
    petData['category'] = formData.get('category') ? {
        'id': 0,
        'name': formData.get('category')
    } : null;

    try {
        document.getElementById('modal-loading').classList.remove('hidden')
        const response = await apiRequest(
            petData.id ? apiRoutes.updatePet(petData.id) : apiRoutes.createPet(),
            petData.id ? 'PUT' : 'POST',
            petData
        );
        addPetToStorage(response)
        updatePetsList()
        document.getElementById('modal-loading').classList.add('hidden')
    } catch (error) {
        console.error('Błąd podczas tworzenia pet:', JSON.stringify(error));
    }
}