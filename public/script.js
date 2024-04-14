document.getElementById('congeForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    fetch('submit_conge.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.success) {
            $('#calendar').fullCalendar('refetchEvents'); // Rafraîchit les événements au lieu de recharger la page
        }
    })
    .catch(error => {
        alert('Erreur: ' + error);
    });
});
