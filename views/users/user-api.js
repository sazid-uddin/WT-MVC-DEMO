window.onload = function () {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/mvc/api/users", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var users = JSON.parse(xhr.responseText);
            console.log("Users data:", users);
            loadUsersIntoTable(users);
        }
    };
    xhr.send();
};

function loadUsersIntoTable(users) {
    var tbody = document.getElementById("users-table-body");
    var countElement = document.getElementById("users-count");

    if (!users || users.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-center text-muted">No users found</td></tr>';
        countElement.innerHTML = "Total users: <strong>0</strong>";
        return;
    }

    tbody.innerHTML = "";

    users.forEach(function (user) {
        var row = document.createElement("tr");

        // ID column
        var idCell = document.createElement("td");
        idCell.innerHTML = '<span class="badge bg-secondary">' + escapeHtml(user.id) + "</span>";
        row.appendChild(idCell);

        // Name column
        var nameCell = document.createElement("td");
        nameCell.innerHTML = "<strong>" + escapeHtml(user.name) + "</strong>";
        row.appendChild(nameCell);

        // Email column
        var emailCell = document.createElement("td");
        emailCell.innerHTML = '<a href="mailto:' + escapeHtml(user.email) + '" class="text-decoration-none">' + escapeHtml(user.email) + "</a>";
        row.appendChild(emailCell);

        // Phone column
        var phoneCell = document.createElement("td");
        if (user.phone && user.phone.trim() !== "") {
            phoneCell.innerHTML = '<a href="tel:' + escapeHtml(user.phone) + '" class="text-decoration-none">' + escapeHtml(user.phone) + "</a>";
        } else {
            phoneCell.innerHTML = '<span class="text-muted">Not provided</span>';
        }
        row.appendChild(phoneCell);

        // Created At column
        var createdCell = document.createElement("td");
        createdCell.innerHTML = '<small class="text-muted">' + formatDate(user.created_at) + "</small>";
        row.appendChild(createdCell);

        tbody.appendChild(row);
    });

    countElement.innerHTML = "Total users: <strong>" + users.length + "</strong>";
}

function escapeHtml(text) {
    var div = document.createElement("div");
    div.textContent = text;
    return div.innerHTML;
}

function formatDate(dateString) {
    var date = new Date(dateString);
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var month = months[date.getMonth()];
    var day = date.getDate();
    var year = date.getFullYear();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? "PM" : "AM";
    hours = hours % 12;
    hours = hours ? hours : 12;
    minutes = minutes < 10 ? "0" + minutes : minutes;

    return month + " " + day + ", " + year + " at " + hours + ":" + minutes + " " + ampm;
}
