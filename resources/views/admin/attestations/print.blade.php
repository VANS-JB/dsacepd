<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Attestation CEPD</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attestation du C.E.P.D</title>

    <style>
        body {
            font-family: "Times New Roman", serif;
            background: #f5f5f5;
        }

        .page {
            width: 27cm;
            min-height: 18.7cm;
            margin: 20px auto;
            padding: 2.5cm;
            background: rgba(17, 233, 100, 0.79);
            color: #000;
        }

        .top {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            line-height: 1.4;
        }

        .top-left {
            text-align: left;
            width: 45%;
        }

        .top-right {
            text-align: right;
            width: 45%;
        }

        .numero {
            margin-top: 10px;
            font-size: 13px;
        }

        .title {
            text-align: center;
            margin: 30px 0 10px;
            font-size: 26px;
            font-weight: bold;
            text-decoration: underline;
        }

        .subtitle {
            text-align: center;
            font-size: 16px;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .content {
            font-size: 15px;
            line-height: 1.8;
            text-align: justify;
        }

        .content strong {
            font-weight: bold;
        }

        .signature {
            margin-top: 60px;
            text-align: center;
            font-size: 14px;
        }

        .signature .lieu-date {
            text-align: right;
            margin-bottom: 40px;
        }

        .cachet {
            margin-top: 20px;
            font-weight: bold;
        }

        .note {
            font-size: 11px;
            margin-top: 30px;
        }
    </style>

</head>
<body onload="window.print()">
   <div class="page">

    {{-- EN-TÊTE --}}
    <div class="top">
        <div class="top-left">
            MINISTÈRE DES ENSEIGNEMENTS<br>
            PRIMAIRE, SECONDAIRE TECHNIQUE<br>
            ET DE L’ARTISANAT<br>
            <strong>CABINET</strong><br>
            SECRÉTARIAT GÉNÉRAL<br>
            DIRECTION DES EXAMENS CONCOURS ET<br>
            CERTIFICATIONS<br>
            DIRECTION RÉGIONALE DE L’ÉDUCATION<br>
            GRAND LOMÉ
        </div>

        <div class="top-right">
            <strong>RÉPUBLIQUE TOGOLAISE</strong><br>
            Travail - Liberté - Patrie
        </div>
    </div>

    <div class="numero">
        N° <strong>{{ $attestation->numero_table }}</strong>/{{ $attestation->session }}/GOL/IEPP/{{ $attestation->numero_registre }}
    </div>

    {{-- TITRE --}}
    <div class="title">
        ATTESTATION DU C.E.P.D
    </div>

    <div class="subtitle">
        CERTIFICAT DE FIN D’ÉTUDES DE L’ENSEIGNEMENT DU PREMIER DEGRÉ
    </div>

    {{-- CONTENU --}}
    <div class="content">
        L’Inspecteur des Enseignements Préscolaire et Primaire
        <strong>{{ $attestation->iepp }}</strong>, soussigné,<br>

        Atteste que le (la) nommé(e) :
        <strong>{{ $attestation->nom_complet }}</strong>,
        Sexe <strong>{{ $attestation->sexe }}</strong><br>

        Né(e) le :
        <strong>{{ \Carbon\Carbon::parse($attestation->date_naissance)->format('d F Y') }}</strong>
                             à <strong>{{ $attestation->lieu_naissance }}</strong><br>

        Élève de l’école :
        <strong>{{ $attestation->ecole }}</strong><br>
        A été déclaré(e) admis(e) au
        <strong>CERTIFICAT DE FIN D’ÉTUDES DE L’ENSEIGNEMENT DU PREMIER DEGRÉ (C.E.P.D)</strong><br>
        Session des :
        <strong>{{ $attestation->session }}</strong>
        &nbsp;&nbsp;&nbsp;Au Centre d’écrit de :
        <strong>{{ $attestation->centre }}</strong><br>

        Sous le N° Table :
        <strong>{{ $attestation->numero_table }}</strong>
        &nbsp;&nbsp;&nbsp;d’Anonymat :
        <strong>{{ $attestation->anonymat }}GBTH445</strong>
        &nbsp;&nbsp;&nbsp;du Registre N° :
        <strong>{{ $attestation->numero_registre }}</strong><br>

        En foi de quoi, la présente attestation lui est délivrée pour servir et valoir ce que de droit.
    </div>

    {{-- SIGNATURE --}}
    <div class="signature">
        <div class="lieu-date">
            Fait à <strong>Lomé</strong>, le
            <strong>{{ \Carbon\Carbon::parse($attestation->date_delivrance)->format('d M Y') }}</strong>
        </div>

        <strong>
            LE CHEF D’INSPECTION DES ENSEIGNEMENTS<br>
            PRÉSCOLAIRE ET PRIMAIRE
        </strong>

        <div class="cachet">
            {{ $attestation->inspecteur }}
        </div>
    </div>

    {{-- NOTE --}}
    <div class="note">
        NB : Il n’est délivré qu’une seule attestation.<br>
        La candidate doit faire des authentifications légales
        par le Maire, le Commissaire de police ou le Préfet.
    </div>

</div>

<style>
.attestation {
    max-width: 800px;
    margin: 0 auto;
    padding: 40px;
    border: 2px solid #000;
    background: #fff;
    font-family: "Times New Roman", serif;
    line-height: 1.6;
}
.attestation .header {
    text-align: center;
    margin-bottom: 20px;
}
.attestation .title {
    text-align: center;
    font-size: 26px;
    font-weight: bold;
    margin: 20px 0 10px;
    text-transform: uppercase;
}
.attestation .subtitle {
    text-align: center;
    font-size: 18px;
    margin-bottom: 30px;
}
.attestation .body {
    font-size: 16px;
    text-align: justify;
    margin-bottom: 40px;
}
.attestation .footer {
    text-align: right;
    margin-top: 40px;
}
.attestation .signature {
    margin-top: 60px;
}
</style>


</body>
</html>