<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listas') }}
            <a href="{{ route('listas.create') }}" class="btn btn-info btn-sm float-right">Nova Lista</a>
        </h2>
    </x-slot>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Listas Cadastradas</h1>

        <!-- Flash Messages -->
        <x-flash-message/>

        @if ($listas->isEmpty())
            <div class="alert alert-warning text-center">
                Nenhuma lista cadastrada.
            </div>
        @else
            <table class="table table-striped table-bordered text-center">
                <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Itens</th>
                    <th>Valor Total</th>
                    <th>Cadastro</th>
                    <th>Ultíma Alteração</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($listas as $lista)
                    <tr>
                        <td>{{ $lista->id }}</td>
                        <td>{{ $lista->name }}</td>
                        <td>{{ $lista->items->count() }}</td>
                        <td>{{ number_format($lista->items->sum(function($item) { return $item->quantidade * $item->preco_unitario; }), 2, ',', '.') }}</td>
                        <td>{{ $lista->created_at->format('d/m/Y') }}</td>
                        <td>{{ $lista->updated_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('listas.show', $lista->id) }}" class="btn btn-info btn-sm">Detalhes</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

</x-app-layout>
