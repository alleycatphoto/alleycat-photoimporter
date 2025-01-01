<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlleyCat PhotoStation</title>
    <style>
        body {
            background-color: black;
            color: lightgrey;
            font-family: Arial, sans-serif;
        }
        .button {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .button:hover {
            background-color: darkred;
        }
        .label {
            color: white;
        }
        .editable {
            background: black;
            color: lightgrey;
            border: 1px solid grey;
            padding: 5px;
        }
        .progress {
            width: 100%;
            background-color: grey;
        }
        .progress-bar {
            width: 0%;
            height: 20px;
            background-color: red;
        }
    </style>
</head>
<body>
    <h1 class="label">AlleyCat PhotoStation</h1>
    <button id="scanButton" class="button">Scan Now</button>
    <button id="importButton" class="button" style="display:none;">Import Now</button>
    <div id="output"></div>
    <div class="progress" id="progressContainer" style="display:none;">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <script>
        const scanButton = document.getElementById('scanButton');
        const importButton = document.getElementById('importButton');
        const outputDiv = document.getElementById('output');
        const progressBar = document.getElementById('progressBar');
        const progressContainer = document.getElementById('progressContainer');

        let jsonData = [];

        scanButton.addEventListener('click', () => {
            fetch('scan.php')
                .then(response => response.json())
                .then(data => {
                    jsonData = data;
                    outputDiv.innerHTML = generateEditableTable(data);
                    scanButton.style.display = 'none';
                    importButton.style.display = 'inline-block';
                })
                .catch(err => console.error(err));
        });

        importButton.addEventListener('click', () => {
            progressContainer.style.display = 'block';
            let completed = 0;
            jsonData.forEach((file, index) => {
                fetch('import.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(file)
                }).then(() => {
                    completed++;
                    progressBar.style.width = ((completed / jsonData.length) * 100) + '%';
                }).catch(err => console.error(err));
            });
        });

        function generateEditableTable(data) {
            let html = '<table>';
            data.forEach((file, index) => {
                html += `
                    <tr>
                        <td><img src="${file.path}" width="100" /></td>
                        <td><input class="editable" value="${file.category}" /></td>
                        <td><input class="editable" value="${file.time}" /></td>
                    </tr>`;
            });
            html += '</table>';
            return html;
        }
    </script>
</body>
</html>
