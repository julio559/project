<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adote um Pet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .pet-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .pet {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px;
            width: 200px;
            text-align: center;
            border-radius: 10px;
            background-color: #fff;
            transition: transform 0.3s ease;
        }

        .pet:hover {
            transform: translateY(-10px);
        }

        .pet img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button-container button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin: 0 10px;
        }

        .button-container button:hover {
            background-color: #45a049;
        }
        #btnAddPet{

margin-left: 50rem;
border-radius: 2rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Adote um Pet</h1>
        <div class="pet-container" id="pet-container"></div>
        <div class="button-container">
       
            <button id="btnAddPet">+</button>
        </div>
    </div>
    <script>

const pets = [
    {
        name: "theodoro",
        species: "Dog",
        age: 3,
        image: "download1.jpeg"
    },
    {
        name: "titica",
        species: "Cat",
        age: 2,
        image: "https://via.placeholder.com/150"
    },
    {
        name: "greg",
        species: "Rabbit",
        age: 1,
        image: "https://via.placeholder.com/150"
    }
];

const petContainer = document.getElementById('pet-container');

pets.forEach(pet => {
    const petDiv = document.createElement('div');
    petDiv.classList.add('pet');
    petDiv.innerHTML = `
        <img src="${pet.image}" alt="${pet.name}">
        <h2>${pet.name}</h2>
        <p>${pet.species}</p>
        <p>Age: ${pet.age} years old</p>
    `;
    petContainer.appendChild(petDiv);
});

const adoptButton = document.getElementById('btnAdopt');
adoptButton.addEventListener('click', () => {
    alert('Parabéns! Você adotou um pet!');
});

    </script>
</body>

</html>
