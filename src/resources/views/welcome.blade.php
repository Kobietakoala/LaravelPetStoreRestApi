<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Store</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<script>
    
let categoryId = 1; // Automatyczne ID dla kategorii
let tagId = 1; // Automatyczne ID dla tagów

// Funkcja obsługująca wysyłanie danych AJAX
async function sendForm(event, formId, method, url) {
    event.preventDefault(); // Zapobiega przeładowaniu strony
    const form = document.getElementById(formId);
    const formData = new FormData(form);

    // Konwersja danych formularza do JSON
    const data = Object.fromEntries(formData.entries());

    // Obsługa opcji "No Status"
    if (data.status === 'none') {
        data.status = null; // Przypisanie wartości null
    }

    // Przekształcenie `category` i `tags`:
    data.category = null;
    data.tags = null;
    if (data.categoryName) {
        data.category = { id: categoryId++, name: data.categoryName };
       
    }

    if (data.tagNames) {
        const tagNamesArray = data.tagNames.split(',').map(name => name.trim());
        data.tags = tagNamesArray.map(name => ({ id: tagId++, name }));
        
    }

    delete data.categoryName;
    delete data.tagNames;
    // Przekształcenie `photoUrls`:
    if (data.photoUrls) {
        data.photoUrls = data.photoUrls.split(',').map(url => url.trim());
    }

    try {
        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();
        alert(`Success: ${JSON.stringify(result)}`);
    } catch (error) {
        alert(`Error: ${error.message}`);
    }
}

function sendGetRequest() {
    const petId = document.getElementById('showId').value;

    if (!petId) {
        alert('Please provide a Pet ID.');
        return;
    }

    // Budujemy URL
    const url = `api/pet/${petId}`;

    // Wysyłamy żądanie GET
    fetch(url, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
    })
        .then(async (response) => {
            if (response.ok) {
                const result = await response.json();
                alert(`Pet data: ${JSON.stringify(result)}`);
            } else {
                alert(`Error: ${response.status}`);
            }
        })
        .catch((error) => {
            alert(`Error: ${error.message}`);
        });
}
</script>

<body>
    <h1>Pet Store Form</h1>

    <!-- Formularz dla metody STORE -->
    <form id="storeForm">
        <label for="storeName">Name:</label>
        <input type="text" id="storeName" name="name" required>
        <br>

        <label for="storePhotoUrls">Photo URLs (comma separated):</label>
        <input type="text" id="storePhotoUrls" name="photoUrls" required>
        <br>

        <label for="storeCategoryName">Category Name:</label>
        <input type="text" id="storeCategoryName" name="categoryName" >
        <br>

        <label for="storeStatus">Status:</label>
        <select id="storeStatus" name="status" >
            <option value="none" selected>Choose a status</option>
            <option value="available">Available</option>
            <option value="pending">Pending</option>
            <option value="sold">Sold</option>
        </select>
        <br>

        <label for="storeTagNames">Tags (comma separated, e.g. Friendly, Playful):</label>
        <input type="text" id="storeTagNames" name="tagNames">
        <br>

        <button type="button" onclick="sendForm(event, 'storeForm', 'POST', 'api/pet')">Add Pet</button>
    </form>

    <hr>

    <!-- Formularz dla metody UPDATE -->
    <form id="updateForm">
        <label for="updateId">Pet ID:</label>
        <input type="number" id="updateId" name="id" required>
        <br>

        <label for="updateName">Name:</label>
        <input type="text" id="updateName" name="name" required>
        <br>

        <label for="updatePhotoUrls">Photo URLs (comma separated):</label>
        <input type="text" id="updatePhotoUrls" name="photoUrls" required>
        <br>

        <label for="updateCategoryName">Category Name:</label>
        <input type="text" id="updateCategoryName" name="categoryName" >
        <br>

        <label for="updateStatus">Status:</label>
        <select id="updateStatus" name="status" >
            <option value="none" selected>Choose a status</option>
            <option value="available">Available</option>
            <option value="pending">Pending</option>
            <option value="sold">Sold</option>
        </select>
        <br>

        <label for="updateTagNames">Tags (comma separated, e.g. Friendly, Playful):</label>
        <input type="text" id="updateTagNames" name="tagNames">
        <br>

        <button type="button" onclick="sendForm(event, 'updateForm', 'PUT', `api/pet/${document.getElementById('updateId').value}`)">Update Pet</button>
    </form>

    <hr>

    <!-- Formularz dla metody DESTROY -->
    <form id="destroyForm">
        <label for="destroyId">Pet ID:</label>
        <input type="number" id="destroyId" name="id" required>
        <br>

        <button type="button" onclick="sendDeleteRequest()">Delete Pet</button>
    </form>

    <hr>

    <!-- Formularz dla metody SHOW -->
    <form id="showForm">
        <label for="showId">Pet ID:</label>
        <input type="number" id="showId" name="id" required>
        <br>

        <button type="button" onclick="sendGetRequest()">Show Pet</button>
    </form>
</body>
</html>
