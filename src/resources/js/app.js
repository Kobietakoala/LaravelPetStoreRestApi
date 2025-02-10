import './bootstrap';
import './components/pet-list'
import { loadPetToForm, clearForm } from './components/form';
import { createOrUpdatePet } from './services/petService';

document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('sendPet');
    if (btn) {
        btn.addEventListener('click', createOrUpdatePet);
    }

    const cancelBtn = document.getElementById('cancel');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', clearForm);
    }
});

window.loadPetToForm = loadPetToForm