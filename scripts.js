document.getElementById('countrySelect').addEventListener('change', function() {
    const countryId = this.value;
    const citiesTable = document.getElementById('citiesTable');
    const citiesTableBody = document.getElementById('citiesTableBody');


    citiesTableBody.innerHTML = '';
    citiesTable.classList.remove('show');

    if (countryId) {

        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_cities.php?countryId=' + countryId, true);


        xhr.onload = function() {
            if (xhr.status === 200) {
                const cities = JSON.parse(xhr.responseText);


                if (cities.length > 0) {
                    cities.forEach(city => {
                        const row = document.createElement('tr');
                        const cell = document.createElement('td');
                        cell.textContent = city.city;
                        row.appendChild(cell);
                        citiesTableBody.appendChild(row);
                    });
                    citiesTable.classList.add('show');


                    setTimeout(() => {
                        citiesTable.classList.remove('show');
                    }, 3000);
                } else {
                    citiesTable.classList.remove('show');
                }
            }
        };


        xhr.send();
    } else {
        citiesTable.classList.remove('show');
    }
});