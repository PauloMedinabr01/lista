<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Criar Nova Lista') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Criar Lista de Compras</h1>

        <!-- Flash Messages -->
        <x-flash-message/>

        <form action="{{ route('listas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome da Lista</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
            </div>
            <div id="items-container"></div>
            <button type="button" class="btn btn-secondary mt-3" id="add-item">Adicionar Item</button>
            <button type="submit" class="btn btn-primary mt-3">Salvar Lista</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let itemIndex = 0;
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
        });
    </script>

</x-app-layout>
