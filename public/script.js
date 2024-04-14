document.getElementById('congeForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    fetch('submit_conge.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Congé ajouté avec succès');
            location.reload(); // Pour actualiser le calendrier
        } else {
            alert('Erreur lors de l\'ajout du congé');
        }
    })
    .catch(error => {
        alert('Erreur: ' + error);
    });
});
