<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listas') }}
            <a href="{{ route('listas.index') }}" class="btn btn-secondary btn-sm float-right">Voltar para Listas</a>
        </h2>
    </x-slot>

    <div class="container mt-5">

        <!-- Flash Messages -->
        <x-flash-message/>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let itemIndex = {{ count($lista->items) }};

                document.getElementById('add-item').addEventListener('click', function () {
                    const itemsContainer = document.getElementById('items-container');
                    const newItem = `
                    <div class="form-row mb-3" id="item-${itemIndex}">
                        <div class="col">
                            <input type="text" class="form-control" name="items[${itemIndex}][descricao]" placeholder="Descrição do Produto" required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="items[${itemIndex}][quantidade]" placeholder="Quantidade" required>
                        </div>
                        <div class="col">
                            <input type="number" step="0.01" class="form-control" name="items[${itemIndex}][preco_unitario]" placeholder="Valor Unitário" required>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-danger remove-item" data-index="${itemIndex}">Remover</button>
                        </div>
                    </div>
                `;
                    itemsContainer.insertAdjacentHTML('beforeend', newItem);
                    itemIndex++;
                });

                document.getElementById('items-container').addEventListener('click', function (e) {
                    if (e.target.classList.contains('remove-item')) {
                        const index = e.target.dataset.index;
                        document.getElementById(`item-${index}`).remove();
                    }
                });

                // Preencher os campos com os dados existentes
                @foreach ($lista->items as $index => $item)
                document.getElementById('items-container').insertAdjacentHTML('beforeend', `
                    <div class="form-row mb-3" id="item-{{ $index }}">
                        <div class="col">
                            <input type="text" class="form-control" name="items[{{ $index }}][descricao]" value="{{ $item->descricao }}" placeholder="Descrição do Produto" required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="items[{{ $index }}][quantidade]" value="{{ $item->quantidade }}" placeholder="Quantidade" required>
                        </div>
                        <div class="col">
                            <input type="number" step="0.01" class="form-control" name="items[{{ $index }}][preco_unitario]" value="{{ $item->preco_unitario }}" placeholder="Valor Unitário" required>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-danger remove-item" data-index="{{ $index }}">Remover</button>
                        </div>
                    </div>
                `);
                @endforeach
            });
        </script>

        <div class="container mt-5">
            <h1 class="text-center mb-4">Editar Lista de Compras</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-body">
                        <form action="{{ route('listas.update', $lista->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nome da Lista</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $lista->name }}"
                                       required>
                            </div>
                            <div id="items-container"></div>
                            <button type="button" class="btn btn-secondary mt-3" id="add-item">Adicionar Item</button>
                            <button type="submit" class="btn btn-info btn mt-3">Salvar Alterações</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
