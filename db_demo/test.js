// Define the REST API endpoint URL and access token
const url = 'https://d7a28deb-6666-4314-9584-01ed5d2c5b69-asia-south1.apps.astra.datastax.com/api/rest/v2/keyspaces/test/users/rows';
const token = 'AstraCS:nMFywxEBGfZHlpXqBKAbtbQn:74cfd0b1913e2033cc672e3201d56a03f0641bbd6d82f8fca259463b46915410';

// Get a reference to the table body
const tableBody = document.querySelector('#userstable tbody');

fetch(url, {
  method: 'GET',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'X-Cassandra-Token': token,
  },
})
  .then(response => response.json())
  .then(parsedData => {
    data = parsedData.data;
    console.log(data);
    // Iterate over the user data and create table rows
    data.forEach(row => {
      const tableRow = document.createElement('tr');

      const nameCell = document.createElement('td');
      nameCell.textContent = row.name;
      tableRow.appendChild(nameCell);

      const emailCell = document.createElement('td');
      emailCell.textContent = row.email;
      tableRow.appendChild(emailCell);

      const departmentsCell = document.createElement('td');
      departmentsCell.textContent = row.departments;
      tableRow.appendChild(departmentsCell);

      const usersCell = document.createElement('td');
      usersCell.textContent = row.users;
      tableRow.appendChild(usersCell);

      tableBody.appendChild(tableRow);
    });
  })
  .catch(error => console.error(error.message));