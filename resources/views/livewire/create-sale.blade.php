<div>
    <h1 class="mb-4">Ajouter une vente</h1>

    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="card p-3 mb-3">
            <label for="sale_date" class="form-label">Date de la vente</label>
            <input type="date" wire:model="sale_date" class="form-control" required>
        </div>

        @foreach($items as $index => $item)
            <div class="card p-3 mb-3" id="sale-item-{{ $index }}">
                <div class="mb-2">
                    <label>Produit</label>
                    <select wire:model="items.{{ $index }}.product_id" class="form-select">
                        <option value="">-- Choisir --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} - {{ number_format($product->price, 2) }} €</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label>Quantité</label>
                    <input type="number" wire:model="items.{{ $index }}.quantity" class="form-control" min="1">
                </div>

                <div class="mb-2">
                    <label>Prix unitaire (€)</label>
                    <input type="text" class="form-control" value="{{ number_format($item['unit_price'], 2) }}" disabled>
                </div>

                <div class="mb-2">
                    <label>Total (€)</label>
                    <input type="text" class="form-control" value="{{ number_format($item['total_price'], 2) }}" disabled>
                </div>

                <button type="button" wire:click="removeItem({{ $index }})" class="btn btn-danger btn-sm">Retirer</button>
            </div>

            @if ($errors->has('items'))
                <div class="alert alert-danger">
                    {{ $errors->first('items') }}
                </div>
            @endif

            @error("items.$index.product_id")
                <div class="text-danger">{{ $message }}</div>
            @enderror


        @endforeach

        <div id="form-buttons">
            <button id="add-item-btn" type="button" wire:click="addItem" class="btn btn-secondary mb-3">+ Ajouter un produit</button>
            <button type="submit" class="btn btn-primary mb-3">Enregistrer la vente</button>
            <a href="{{ route('sales.index') }}" class="btn btn-secondary mb-3">Annuler</a>
        </div>



    </form>

    <script>

        function scrollToBottom(delay = 500) {
                setTimeout(() => {
                    const cards = document.querySelectorAll('[id^="sale-item-"]');

                    if (cards.length > 0) {
                        window.scrollTo({
                            top: document.body.scrollHeight,
                            behavior: 'smooth'
                        });
                    }
                }, delay);
            }

        // Premier chargement
        scrollToBottom(1000);

        // Après ajout d’un produit
        document.getElementById('add-item-btn').addEventListener('click', () => {
            scrollToBottom(500);
        });


    </script>

</div>
