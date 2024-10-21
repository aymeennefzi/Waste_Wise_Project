<!-- CSS pour toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Pusher -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    // Activer le log dans la console pour Pusher
    Pusher.logToConsole = true;

    // Initialiser Pusher avec votre clé et le cluster
    var pusher = new Pusher('d384ed014b78d9e69093', {
        cluster: 'eu', // Mettez à jour avec le cluster que vous utilisez
        forceTLS: true
    });

    // S'abonner au canal
    var channel = pusher.subscribe('waste-tips-channel');

    // Écouter l'événement de création de WasteTip
    channel.bind('waste-tip-created', function(data) {
        // Vérifier si les données sont valides
        if (data && data.post && data.post.author && data.post.title) {
            // Afficher la notification de succès avec Toastr
            toastr.success('New Waste Tip Created', 'Author: ' + data.post.author + '<br>Title: ' + data.post.title, {
                timeOut: 5000,  // Durée d'affichage de la notification
                extendedTimeOut: 2000,  // Durée d'affichage de la notification à l'extension
            });
        } else {
            console.error('Invalid data structure received:', data);
        }
    });
</script>
