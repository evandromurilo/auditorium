<table class="table table-bordered">
    <tr>
        <th class="text-center">Auditório</th>
        <th class="text-center">Data do Agendameto</th>
        <th class="text-center">Status</th>
    </tr>

    @foreach ($requests as $request)
        <tr>
            <td style="vertical-align:middle;">{{ $request->auditorium->name }}</td>
            <td style="vertical-align:middle;">{{ $request->dateC->format('d/m/Y') }}</td>

            @if ($request->status == 0)
                </td></td>
                <td align="center" style="vertical-align:middle;">
                    <span class="pendente">
                        Pendente
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                    </span>
                </td>
            @elseif ($request->status == 1)
                <td align="center" style="vertical-align:middle;">
                    <span class="indisponivel">
                        Rejeitado
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </span>
                </td>
            @else
                <td align="center" style="vertical-align:middle;">
                    <span class="disponivel">
                        Aceito
                        <i class="fa fa-check-square" aria-hidden="true"></i>
                    </span>
                </td>
            @endif

            <td align="center">
                <button style="margin: auto; color: #fff;"
                        type="button"
                        class="btn btn-primary btn-xs"
                        data-toggle="modal"
                        href="{{ route('requests.modal', $request->id) }}"
                        data-remote="{{ route('requests.modal', $request->id) }}"
                        data-target="#modal-super">
                        Visualizar
                </button>
            </td>
        </tr>
    @endforeach
</table>
{{ $requests->links() }}
