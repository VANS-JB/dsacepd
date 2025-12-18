<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Attestation CEPD</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .attestation { border: 2px solid #000; padding: 30px; }
        h1 { text-align: center; text-transform: uppercase; margin-bottom: 30px; }
        .info { margin: 12px 0; font-size: 16px; }
        .footer { margin-top: 50px; text-align: right; font-size: 16px; }
    </style>
</head>
<body onload="window.print()">
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