@extends('templates.crud')

@section('styles')
    <style>
        body{
    background-color: black;
}

.container{
    /*margin: 10px;
    padding-left: 500px;
    padding-top: 20px;
    margin-bottom: 30px;*/
    text-align: center;
    margin: 10px;
    margin-left: 90px;
    border: 10px;
    color: lightgray;
    text-shadow: 1px 1px 20px gray;
}

.responsive{
    display: flex;
    justify-content: center;
}

.containerObjects{
    /*margin: 10px;
    margin-left: 600px;
    /*padding-left: 500px;
    padding-top: 20px;*/
    text-align: center;
    margin: auto;
    opacity: 70%;
    border: 10px;
    border-radius: 15px;
    background-color: rgb(245, 248, 249);
    height: 500px;
    width: 300px;
    box-shadow: 1px 1px 20px gray;
}

.forms{
    margin: 10px;
}

.btn-outline-primary{
    margin: auto;
    margin-top: 20px;
}

.btn-outline-danger{
    margin: auto;
    margin-top: 20px;
}

input{
    border-radius: 10px;
    box-shadow: 1px 1px 10px gray;
}

    </style>
    @endsection
@section('body')
<main role="main">
        <h1 class="container">Práctica JSON Dinámico</h1>
        <div class="container">
            <div class="responsive">
                <form class="containerObjects">
                    <label class="forms" for="key">Key:</label><br>
                    <input class="forms" id="key" type="text"><br>
                    <label class="forms" for="value">Value:</label><br>
                    <input class="forms" id="value" type="text"><br>
                    
                    <select class="forms" id="selectObject" onchange="displayObjectData()">
                        <option class="forms" value="Selecciona una opción">Selecciona una opción</option>
                    </select><br>

                    <button type="button" class="btn btn-outline-primary" onclick="addToTable()">Agregar datos al objeto</button>
                    <button type="button" class="btn btn-outline-danger" onclick="createToTable()">Crear objeto</button>
                </form>
            </div>

            <h2 class="container">Datos del objeto seleccionado</h2>
            <div class="table-container">
                <table class="table table-dark table-striped" id="datatable">
                    <thead>
                        <tr>
                            <th scope="col">Key</th>
                            <th scope="col">Value</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </main>
    @endsection

    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="/js/jsjsondinamico.js"></script>
    <script>
        let object = [];
        let currentObjectIndex = -1;

        function addToTable() {
            const key = document.getElementById('key').value;
            const value = document.getElementById('value').value;

            if (key && value) {
                if (currentObjectIndex !== -1) {
                    object[currentObjectIndex][key] = value;
                    document.getElementById('key').value = "";
                    document.getElementById('value').value = "";
                    displayObjectData();
                }
            }
        }

        function createToTable() {
            const newObject = {};
            object.push(newObject);
            currentObjectIndex = object.length - 1;
            updateObjectSelector();
            displayObjectData();
        }

        function updateObjectSelector() {
            const select = document.getElementById('selectObject');
            select.innerHTML = '';
            object.forEach((obj, index) => {
                const option = document.createElement('option');
                option.value = index;
                option.textContent = `Objeto ${index + 1}`;
                select.appendChild(option);
            });
            select.value = currentObjectIndex;
        }

        function displayObjectData() {
            const select = document.getElementById('selectObject');
            currentObjectIndex = select.value;

            const tbody = document.getElementById('datatable').getElementsByTagName('tbody')[0];
            tbody.innerHTML = '';

            const selectedObject = object[currentObjectIndex];
            for (const key in selectedObject) {
                const row = tbody.insertRow();
                const cellKey = row.insertCell(0);
                const cellValue = row.insertCell(1);
                cellKey.textContent = key;
                cellValue.textContent = selectedObject[key];
            }
        }
    </script>
    @endsection
