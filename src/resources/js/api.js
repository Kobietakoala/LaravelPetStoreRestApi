const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || 'http://localhost:80/api'

export const apiRoutes = {
    getPets: () => `${API_BASE_URL}/pet`,
    createPet: () => `${API_BASE_URL}/pet`,
    updatePet: (id) => `${API_BASE_URL}/pet/${id}`,
    getPet: (id) => `${API_BASE_URL}/pet/${id}`,
    deletePet: (id) => `${API_BASE_URL}/pet/${id}`,
};

export async function apiRequest(endpoint, method, data = null) {
    const options = {
        method,
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'cache': 'no-cache'
        },
    };

    if (data) {
        options.headers['Content-Type'] = 'application/json';
        options.body = JSON.stringify(data)
    }
    
    try {
        const res = await fetch(endpoint, options);
        if (!res.ok) {
            const errorData = await res.json();
            throw new Error(errorData.message || 'Wystąpił błąd podczas zapytania API');
        }

        return res.json();
    } catch (error) {
        console.error('Błąd w apiRequest:', error);
        throw error;
    }
}