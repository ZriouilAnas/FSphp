const showData = document.getElementById('showData')
// les buttons
const inpID =  document.getElementById('inpID');
const addBTN =  document.getElementById('addBTN');
const putBTN =  document.getElementById('putBTN');
const showBTN =  document.getElementById('showBTN');
const delBTN =  document.getElementById('delBTN');
const showOneBTN =  document.getElementById('showOneBTN');
//test
const jsonBTN =  document.getElementById('jsonBTN');

// divs containers
const showAllData = document.getElementById('showAllData');
const showOneData = document.getElementById('showOneData');
const comboBox = document.getElementById('produitComboBox');

// inputs
const delID = document.getElementById('delID');

const newNom = document.getElementById('newNom').value
const newDesc = document.getElementById('newDesc').value
const newPrix = document.getElementById('newPrix').value
const newDate = document.getElementById('newDate').value
const upId = document.getElementById('upId').value
const upNom = document.getElementById('upNom').value
const upDesc = document.getElementById('upDesc').value
const upPrix = document.getElementById('upPrix').value


// event listners des buttons
//test

//test
addBTN.addEventListener("click" , createProduit )

putBTN.addEventListener("click" , updateProduit )

  showBTN.addEventListener("click" , getProduits )
  
  
  delBTN.addEventListener("click" , deleteProduit )

  showOneBTN.addEventListener("click" , getProduit
     )
     comboBox.addEventListener('change', showProductDetails);



  // functions

  function getProduits()   {
    const url = `http://localhost/LabREST_03/api/v1.0/produit/list`;
    fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Parse the JSON from the response
            })
            .then(data => {
                console.log(data); // Log the data to the console
                // You can update your HTML here with the product data
                //showAllData.innerText = JSON.stringify(data, null, 2);
                showAllData.innerText = "Les produits ont ete afficher avec success "
                const allData = JSON.stringify(data, null, 2);
                const fianlData = data.flat();
                console.log(fianlData)
                displayProduits(fianlData);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
 
  }

  function getProduit() {
    const productId = inpID.value; // Change this ID to fetch different products
    const url = `http://localhost/LabREST_03/api/v1.0/produit/listone/${productId}`;
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Parse the JSON from the response
        })
        .then(data => {
            console.log(data); // Log the data to the console
            // You can update your HTML here with the product data
            const produitJson = JSON.stringify(data, null, 2);
            displayObjectAsTable(data)
            //showOneData.innerText = produitJson;
            //showData.innerText = JSON.stringify(data, null, 2);

        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    
console.log('addBTN is clicked!')
  }


  function deleteProduit() {
      // Change this ID to delete a different product
      const id = delID.value;
    const url = `http://localhost/LabREST_03/api/v1.0/produit/delete/${id}`;

    fetch(url, {
        method: 'DELETE' // Specify the request method as DELETE
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Parse the JSON from the response
    })
    .then(data => {
        console.log(data); // Log the response data
        // You can update your HTML here to notify the user
        showData.innerText = data.message;
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
        showData.innerText = 'Error deleting product';
    });
}

function createProduit() {
    const newProduct = {
        nom: newNom,
        description: newDesc ,
        prix: newPrix,
        
    };
    showData.innerText = newProduct.nom;

    // Send the POST request to create the product
    fetch('http://localhost/LabREST_03/api/v1.0/produit/new/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(newProduct) // Convert the object to JSON
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        showData.innerText = data.message; // Display success message
    })
    .catch(error => {
        console.error('Error:', error);
        showData.innerText = 'Error creating product.';
    });
}


function updateProduit() {
    const updatedProduct = {
    id: upId,
    nom: upNom,
    description: upDesc,
    prix: upPrix
};

    // Send the PUT request to update the product
    fetch(`http://localhost/LabREST_03/api/v1.0/produit/update/${updatedProduct.id}/`, {
    method: 'PUT',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(updatedProduct) // Convert the object to JSON  
    })
    .then(response => {
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json();
    })
    .then(data => {
    showData.innerText = data.message; // Display success message
    })
    .catch(error => {
    console.error('Error:', error);
    showData.innerText = 'Error updating product.';
    });
};

function displayProduits(data) {
    
            
            
        const comboBox = document.getElementById('produitComboBox');
        const productDetails = document.getElementById('productDetails');
        productDetails.style.display = "block"
        data.forEach(product => {
            const option = document.createElement('option');
            option.value = product.id;
            option.text = product.nom; // Display product name
            option.setAttribute('data-description', product.description);
            option.setAttribute('data-prix', product.prix);
            option.setAttribute('data-date', product.date_creation);
            comboBox.appendChild(option);
        });
    
        }
        function showProductDetails() {
            
            const selectedOption = comboBox.options[comboBox.selectedIndex];

            // Only display details if a valid product is selected (not the default option)
            if (selectedOption.value !== "") {
                document.getElementById('nom').textContent = selectedOption.text;
                document.getElementById('description').textContent = selectedOption.getAttribute('data-description');
                document.getElementById('prix').textContent = selectedOption.getAttribute('data-prix');
                document.getElementById('date_creation').textContent = selectedOption.getAttribute('data-date');
            } else {
                // Clear details if no product is selected
                document.getElementById('nom').textContent = "";
                document.getElementById('description').textContent = "";
                document.getElementById('prix').textContent = "";
                document.getElementById('date_creation').textContent = "";
            }
        }

        // Add event listener to the combo box
        
        
        function displayObjectAsTable(produit) {
            const tableBody = document.querySelector("#produitTable tbody");

            // Loop through the object keys and values
            for (const [key, value] of Object.entries(produit)) {
                // Create a new row
                const row = document.createElement("tr");

                // Create a cell for the key (property name)
                const keyCell = document.createElement("td");
                keyCell.textContent = key;
                row.appendChild(keyCell);

                // Create a cell for the value
                const valueCell = document.createElement("td");
                valueCell.textContent = value;
                row.appendChild(valueCell);

                // Append the row to the table body
                tableBody.appendChild(row);
               
            }
            br = document.createElement("hr")
            tableBody.appendChild(br);
        }
        
        
