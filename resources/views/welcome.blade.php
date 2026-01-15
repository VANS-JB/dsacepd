@extends('layouts.site')

@section('title', 'Accueil - Services DSA')

@section('content')

   
    <h1>Bienvenue sur la plateforme officielle de demande d'attestations de CEPD</h1>
    
    <div class="services">
        <div class="service-box">
            <h3>Faire une demande</h3>
            <p>Soumettez votre relevé et acte de naissance pour demander votre attestation.</p>
            <a href="{{ route('demandeur.demande') }}">Commencer</a>
        </div>

        <div class="service-box">
            <h3>Suivre ma demande</h3>
            <p>Consultez le statut de votre demande en temps réel.</p>
            <a href="{{ route('demandeur.suivi') }}">Suivre</a>
        </div>

        <div class="service-box">
            <h3>Faire une réclamation</h3>
            <p>Signalez un problème ou une erreur concernant votre demande.</p>
            {{-- Si $demande existe, on passe l'id ; sinon on propose un lien de secours (inscription) --}}
            @if(isset($demande) && $demande)
                <a href="{{ route('demandeur.reclamation', ['demandeId' => $demande->id]) }}">Réclamer</a>
            @else
                <a href="{{ route('register') }}">Réclamer</a>
            @endif
        </div>
    </div>

    <h2>Comment ça marche ?</h2>
    <ol>
        <li>Faire la demande</li>
        <li>Traitement</li>
        <li>Validation</li>
        <li>Récupération</li>
    </ol>

    <h2>Questions - Réponses</h2>
   <ul class="faq-list">
    <li onclick="openModal('temps')">⏱ Combien de temps faut-il pour obtenir mon attestation ?</li>
    <li onclick="openModal('pieces')">📄 Dois-je fournir des pièces justificatives ?</li>
    <li onclick="openModal('suivi')">🔍 Comment puis-je suivre ma demande ?</li>
    <li onclick="openModal('probleme')">❗ Que faire s’il y a un problème avec ma demande ?</li>
</ul>
<div id="faqModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3 id="modalTitle"></h3>
        <p id="modalText"></p>
    </div>
</div>
<script>
function openModal(type) {
    let title = '';
    let text = '';

    switch(type) {
        case 'temps':
            title = "⏱ Délai d'obtention";
            text = "Le délai moyen pour obtenir votre attestation est de 3 à 5 jours ouvrables après validation de votre demande.";
            break;

        case 'pieces':
            title = "📄 Pièces justificatives";
            text = "Oui, vous devez fournir un acte de naissance et le relevé de notes en version scannée.";
            break;

        case 'suivi':
            title = "🔍 Suivi de la demande";
            text = "Vous pouvez suivre l'état de votre demande depuis votre espace personnel dans la rubrique « Mes demandes ».";
            break;

        case 'probleme':
            title = "❗ Problème avec la demande";
            text = "En cas de problème, veuillez déposer une réclamation ou contacter le service concerné via le formulaire de contact.";
            break;
    }

    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalText').innerText = text;
    document.getElementById('faqModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('faqModal').style.display = 'none';
}
</script>


<style>
.faq-list li {
    cursor: pointer;
    padding: 10px;
    margin-bottom: 6px;
    background: #f5f5f5;
    border-radius: 6px;
}
.faq-list li:hover {
    background: #e9ecef;
}

.modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: white;
    padding: 20px;
    width: 90%;
    max-width: 500px;
    border-radius: 8px;
    animation: fadeIn 0.3s ease;
}

.close {
    float: right;
    font-size: 22px;
    cursor: pointer;
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}
</style>


   
@endsection