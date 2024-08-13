<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listas') }}
            <a href="{{ route('listas.create') }}" class="btn btn-info btn-sm float-right">Nova Lista</a>
        </h2>
    </x-slot>

    <div class="container mt-5">
        <!-- Flash Messages -->
        <x-flash-message/>

        <div class="container mt-5">
            <h1 class="text-center mb-4">Detalhes da Lista</h1>

            <div class="card mb-4">
                <div class="card-header">
                    {{ $lista->name }}
                    <div class="float-right">
                        <a href="{{ route('listas.edit', $lista->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('listas.destroy', $lista->id) }}" method="POST"
                              style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Tem certeza que deseja deletar esta lista?')">Deletar
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Descrição</th>
                            <th>Quantidade</th>
                            <th>Valor Unitário</th>
                            <th>Valor Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($lista->items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->descricao }}</td>
                                <td>{{ $item->quantidade }}</td>
                                <td>{{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                                <td>{{ number_format($item->quantidade * $item->preco_unitario, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Total de itens</th>
                            <th>{{ $lista->items->sum('quantidade') }}</th>
                            <th></th>
                            <th>Valor Final</th>
                            <th>{{ number_format($lista->items->sum(function($item) { return $item->quantidade * $item->preco_unitario; }), 2, ',', '.') }}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <a href="{{ route('listas.index') }}" class="btn btn-secondary">Voltar para Listas</a>
        </div>
    </div>

</x-app-layout>
