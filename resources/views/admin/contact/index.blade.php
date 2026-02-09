@extends('layouts.app')

@section('content')
<h1>Messages de contact</h1>

@if(session('success'))
    <div style="color:green;">{{ session('success') }}</div>
@endif

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse($messages as $msg)
            <tr>
                <td>{{ $msg->id }}</td>
                <td>{{ $msg->name }}</td>
                <td>{{ $msg->email }}</td>
                <td>{{ $msg->message }}</td>
                <td>{{ $msg->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Aucun message reçu.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $messages->links() }} <!-- pagination -->
@endsection

<style>
/* Titre */
h1 {
    
    margin-bottom: 25px;
    color: #1e293b;
    font-size: 26px;
}

/* Message succès */
.alert-success {
    background: #ecfdf5;
    color: #065f46;
    padding: 12px 16px;
    border-left: 4px solid #10b981;
    border-radius: 6px;
    margin-bottom: 20px;
}

/* Table wrapper */
.table-wrapper {
    background: #ffffff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

thead {
    background:linear-gradient(135deg, #1e40af, #1e3a8a);
    color: #ffffff;
}

thead th {
    padding: 12px;
    text-align: left;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    background:linear-gradient(135deg, #1e40af, #1e3a8a);
    color: #ffffff;
}

tbody td {
    padding: 12px;
    border-bottom: 1px solid #e5e7eb;
    vertical-align: top;
}

/* Ligne hover */
tbody tr:hover {
    background: #f1f5f9;
}

/* Message long */
tbody td:nth-child(4) {
    max-width: 300px;
    white-space: normal;
    line-height: 1.5;
}

/* Aucun message */
tbody tr td[colspan] {
    text-align: center;
    color: #64748b;
    padding: 20px;
}

/* Pagination Laravel */
.pagination {
    margin-top: 25px;
    display: flex;
    justify-content: center;
    gap: 6px;
}

.pagination a,
.pagination span {
    padding: 8px 12px;
    border-radius: 6px;
    border: 1px solid #cbd5e1;
    text-decoration: none;
    font-size: 13px;
    color: #1e293b;
}

.pagination .active span {
    background: #2563eb;
    color: #ffffff;
    border-color: #2563eb;
}

.pagination a:hover {
    background: #e0e7ff;
}

/* Responsive */
@media (max-width: 768px) {
    table {
        font-size: 13px;
    }

    thead {
        display: none;
    }

    tbody tr {
        display: block;
        margin-bottom: 15px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 10px;
    }

    tbody td {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border: none;
    }

    tbody td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #475569;
    }
}
</style>