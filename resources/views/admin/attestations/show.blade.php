<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Attestation CEPD</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .attestation { border: 2px solid #000; padding: 20px; }
        h1 { text-align: center; text-transform: uppercase; }
        .info { margin: 15px 0; }
        .footer { margin-top: 40px; text-align: right; }
        .btn-print { margin-bottom: 20px; }
    </style>
</head>
<body>
    <button class="btn-print" onclick="window.print()">🖨️ Imprimer</button>

    <div class="attestation">
        <h1>Attestation de Réussite CEPD</h1>

        <div class="info"><strong>Nom complet :</strong> {{ $attestation->nom_complet }}</div>
        <div class="info"><strong>Date de naissance :</strong> {{ $attestation->date_naissance }}</div>
        <div class="info"><strong>Lieu de naissance :</strong> {{ $attestation->lieu_naissance }}</div>
        <div class="info"><strong>École :</strong> {{ $attestation->ecole }}</div>
        <div class="info"><strong>Numéro de table :</strong> {{ $attestation->numero_table }}</div>
        <div class="info"><strong>Session :</strong> {{ $attestation->session }}</div>
        <div class="info"><strong>Centre :</strong> {{ $attestation->centre }}</div>
        <div class="info"><strong>Numéro registre :</strong> {{ $attestation->numero_registre }}</div>

        <div class="footer">
            <p>Fait à Lomé, le {{ now()->format('d/m/Y') }}</p>
            <p><strong>Signature de l’agent</strong></p>
        </div>
    </div>
</body>
</html>