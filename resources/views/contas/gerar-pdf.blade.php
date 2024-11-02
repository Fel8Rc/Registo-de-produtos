<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Contas</title>
</head>
<body style="font-size: 12px">
    <h2 style="text-align: center">Contas</h2>

    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #adb5bd ">
                <th style="border: 1px solid #ccc;">ID</th>
                <th style="border: 1px solid #ccc;">Nome</th>
                <th style="border: 1px solid #ccc;">Valor</th>
                <th style="border: 1px solid #ccc;">Vencimento</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($contas as $conta)
                <tr>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $conta->id }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $conta->nome }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $conta->valor }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $conta->vencimento }}</td>
                </tr>
            @empty
            <tr>
                <td colspan="4">Nenhuma Conta Encontrada</td>
            </tr>
            @endforelse
            <tr>
                <td  style="border: 1px solid #ccc; border-top: none;">total</td>
                <td colspan="3"  style="border: 1px solid #ccc; border-top: none;">{{ number_format($totalValor, 2, ',', '.') . 'Kz' }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>